<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\RepositoryController;

use App\Models\Places;
use App\Models\Media;
use App\Models\Posts;
use App\Models\Tags;
use App\Models\Slug;
use App\Models\Place_Tags;
use App\Models\Category_Places;
use App\Models\Categories;
use App\Models\Service;

class PlaceController extends Controller
{

    public function __construct(RepositoryController $repositoryController)
    {
        $this->repositoryController = $repositoryController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Places::all();
        return view('admin.place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::where('slug','dia-diem')->get();
        $categories = Categories::find($categories[0]->id);
        $services = Service::all();
        return view('admin.place.add',compact('categories', 'services'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $maxid = DB::table('places')->max('id') + 1;
            $data = $request->only(['place_name', 'slug', 'cover_image', 'description']);
            $place = new Places($data);
            $place->id = $maxid;
            $place->status = $request->status;
            
            if ($request->infor != null) {
                $arrinfor = ($request->infor != null) ? explode(',',$request->infor) : array();
                $infors = array();
                foreach ($arrinfor as $key => $value) {
                    $ok = explode('+', $value);
                    if (!array_key_exists($ok[1], $infors)) {
                        $infors[$ok[1]] = array($ok[2]);
                    } else {
                        $infors[$ok[1]][] = $ok[2];
                    }
                }
                $place->information = $infors;
            }

            if ($request->schedule != null) {
                $arrtime = ($request->schedule != null) ? explode(',',$request->schedule) : array();
                $schedules = array();
                foreach ($arrtime as $key => $value) {
                    $ok = explode('+', $value);
                    $schedules[$ok[0]] = array (
                        'open' => $ok[1],
                        'close' => $ok[2],
                    );
                }
                $place->schedule = $schedules;
            }

            $arrmedia = ($request->media_place != null) ? explode(',',$request->media_place) : array();
            $services = ($request->services != null) ? explode(',',$request->services) : array();

            $place->media = $arrmedia;
            $place->service = $services;
            if (Auth::check()) {
                $place->user_created = Auth::user()->id;
            }
            $place->save();

            foreach ($request->category as $key => $value) {
                $newcategory = new Category_Places();
                $newcategory->place_id = $maxid;
                $newcategory->category_id = $value;
                $newcategory->save();
            }

            if ($request->tags != null ) {
                Place_Tags::where('place_id', $maxid)->delete();
                $tag = explode(',',  trim($request->tags));
                foreach ($tag as $key => $value) {
                    if(Tags::where('tag_name', trim($value))->exists()){
                        $tagid = Tags::where('tag_name', trim($value))->first();
                        $tagid = $tagid->id;
                    }else{                                                                    
                        $tagid = DB::table('tags')->max('id') + 1;

                        $newtag = new Tags();
                        $newtag->id = $tagid;
                        $newtag->tag_name = trim($value);
                        $newtag->save();
                    }

                    $newtag = new Place_Tags();
                    $newtag->place_id = $maxid;
                    $newtag->tag_id = $tagid;
                    $newtag->save();
                }
            }
            
            DB::commit();
            return redirect()->route('place.index')->with('success','Thêm địa điểm thành công');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('place.index')->with('error','Thêm địa điểm không thành công vui lòng thử lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Places::find($id);

        $medias = Media::whereIn('id', $place->media)->get();
        $myservices = Service::whereIn('id', $place->service)->get();

        $categories = Categories::where('slug','dia-diem')->get();
        $categories = Categories::find($categories[0]->id);
        $services = Service::all();
        return view('admin.place.edit', compact('place','medias','categories','myservices','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $arrinfor = ($request->infor != null) ? explode(',',$request->infor) : array();
            $infors = array();
            foreach ($arrinfor as $key => $value) {
                $ok = explode('+', $value);
                if (!array_key_exists($ok[1], $infors)) {
                    $infors[$ok[1]] = array($ok[2]);
                } else {
                    $infors[$ok[1]][] = $ok[2];
                }
            }

            $arrtime = ($request->schedule != null) ? explode(',',$request->schedule) : array();
            $schedules = array();
            foreach ($arrtime as $key => $value) {
                $ok = explode('+', $value);
                $schedules[$ok[0]] = array (
                    'open' => $ok[1],
                    'close' => $ok[2],
                );
            }

            $arrmedia = ($request->media_place != null) ? explode(',',$request->media_place) : array();

            $update = Places::where('id', $id)->update([
                'place_name' => $request->place_name,
                'slug' => $request->slug,
                'cover_image' => $request->cover_image,
                'description' => $request->description,
                'information' => $infors,
                'media' => $arrmedia,
                'service' => ($request->services != null) ? $request->services : array(),
                'schedule' => $schedules,
                'status' => $request->status,
            ]);

            $delete = Category_Places::where('place_id', $id)->delete();
            foreach ($request->category as $key => $value) {
                $newcategory = new Category_Places();
                $newcategory->place_id = $id;
                $newcategory->category_id = $value;
                $newcategory->save();
            }

            if ($request->tags != null ) {
                Place_Tags::where('place_id', $id)->delete();
                $tag = explode(',',  trim($request->tags));
                foreach ($tag as $key => $value) {
                    if(Tags::where('tag_name', trim($value))->exists()){
                        $tagid = Tags::where('tag_name', trim($value))->first();
                        $tagid = $tagid->id;
                    }else{                                                                    
                        $tagid = DB::table('tags')->max('id') + 1;

                        $newtag = new Tags();
                        $newtag->id = $tagid;
                        $newtag->tag_name = trim($value);
                        $newtag->save();
                    }

                    $newtag = new Place_Tags();
                    $newtag->place_id = $id;
                    $newtag->tag_id = $tagid;
                    $newtag->save();
                }
            }
            DB::commit();
            
            return redirect()->route('place.index')->with('success','Sửa địa điểm thành công');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('place.index')->with('error','Sửa địa điểm không thành công vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}