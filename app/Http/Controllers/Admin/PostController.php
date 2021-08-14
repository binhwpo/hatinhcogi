<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Posts;
use App\Models\Tags;
use App\Models\Slug;
use App\Models\Post_Tag;
use App\Models\Category_Posts;
use App\Models\Categories;
use App\Models\Places;

use App\Http\Requests\Validate_Posts;
use App\Http\Requests\Validate_Post_place;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        if (isset($_GET['type']) && $_GET['type'] == '1' ) {
            $posts = Posts::where('type', 1)->get();
        } elseif (isset($_GET['type']) && $_GET['type'] == '2') {
            $posts = Posts::where('type', 2)->get();
        }
        
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::where('slug','bai-viet')->get();
        $categories = Categories::find($categories[0]->id);
        return view('admin.post.add',compact('categories'));   
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Validate_Posts $request)
    {
        try {
            DB::beginTransaction();
            $maxslug = DB::table('slug')->max('id') + 1;
            $db = new Slug();
            $db->id = $maxslug;
            $db->slug = $request->slug;
            $db->save();

            $maxid = DB::table('posts')->max('id') + 1;
            $data = $request->only(['title', 'contents', 'featured_image']);
            $db = new Posts($data);
            $db->id = $maxid;
            $db->slug_id = $maxslug;
            $db->user_create = Auth::user()->id;
            $db->status = $request->status;
            $db->save();

            foreach ($request->category as $key => $value) {
                $newpostcategory = new Category_Posts();
                $newpostcategory->post_id = $maxid;
                $newpostcategory->category_id = $value;
                $newpostcategory->save();
            }

            if ($request->tags != null ) {
                Post_Tag::where('post_id', $maxid)->delete();
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

                    $newposttag = new Post_Tag();
                    $newposttag->post_id = $maxid;
                    $newposttag->tag_id = $tagid;
                    $newposttag->save();
                }
            }
            
            DB::commit();
            return redirect()->route('post.index')->with('success', 'Thêm thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput()->with('warning', 'Lỗi hệ thống vui lòng thử lại!');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::where('slug','bai-viet')->first();
        $post = Posts::find($id);
        if (!$post || $post->type == 2) {
            return redirect()->route('post.index')->with('warning', 'Không tìm thấy bài viết cần chỉnh sửa');
        }
        return view('admin.post.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Validate_Posts $request, $id)
    {
        try {
            DB::beginTransaction();
            $postup = Posts::find($id);
            $post = Posts::where('id', $id)->update([
                'title' => $request->title,
                'featured_image' => $request->featured_image,
                'contents' => $request->contents,
                'status' => $request->status,
            ]);

            Slug::where('id', $postup->slug_id)->update([
                'slug' => $request->slug
            ]);

            if ($request->tag != null ) {
                Post_Tag::where('post_id', $id)->delete();
                $tag = explode(',',  trim($request->tags));
                foreach ($tags as $key => $value) {
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

                    $newposttag = new Post_Tag();
                    $newposttag->post_id = $id;
                    $newposttag->tag_id = $tagid;
                    $newposttag->save();
                }
            }

            Category_Posts::where('post_id',$id)->delete();
            foreach ($request->category as $key => $value) {
                $newpostcategory = new Category_Posts();
                $newpostcategory->post_id = $id;
                $newpostcategory->category_id = $value;
                $newpostcategory->save();
            }
            
            DB::commit();
            return redirect()->route('post.index')->with('success', 'Sửa thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('post.index')->with('warning', 'Lỗi hệ thống vui lòng thử lại!');
        }
    }


















    // Bài viết địa điểm
    public function addpostplace()
    {
        $places = Places::all();
        return view('admin.post.addpostplace',compact('places'));   
    }

    public function storepostplace(Validate_Post_place $request)
    {
        try {
            DB::beginTransaction();
            $maxid = DB::table('posts')->max('id') + 1;
            $data = $request->only(['title', 'slug', 'contents', 'featured_image']);
            $db = new Posts($data);
            $db->id = $maxid;
            $db->user_create = Auth::user()->id;
            $db->type = 2;
            $db->place_id = $request->place_id;
            $db->status = $request->status;
            $db->status_display = $request->status_display;
            $db->save();

            if ($request->tag != null ) {
                Post_Tag::where('post_id', $id)->delete();
                $tag = explode(',',  trim($request->tag));
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

                    $newposttag = new Post_Tag();
                    $newposttag->post_id = $maxid;
                    $newposttag->tag_id = $tagid;
                    $newposttag->save();
                }
            }
            
            DB::commit();
            return redirect()->route('post.index')->with('success', 'Thêm thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput()->with('warning', 'Lỗi hệ thống vui lòng thử lại!');
        }
    }

    public function editpostplace($id)
    {
        $post = Posts::find($id);
        $places = Places::all();
        if (!$post || $post->type == 1) {
            return redirect()->route('post.index')->with('warning', 'Không tìm thấy bài viết cần chỉnh sửa');
        }
        return view('admin.post.editpostplace', compact('post','places'));
    }

    public function updatepostplace(Validate_Post_place $request, $id)
    {
        try {
            DB::beginTransaction();
            $post = Posts::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'featured_image' => $request->featured_image,
                'contents' => $request->contents,
                'status' => $request->status,
                'status_display' => $request->status_display,
                'place_id' => $request->place_id,
            ]);
        
            if ($request->tag != null ) {
                Post_Tag::where('post_id', $id)->delete();
                $tag = explode(',',  trim($request->tag));
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

                    $newposttag = new Post_Tag();
                    $newposttag->post_id = $id;
                    $newposttag->tag_id = $tagid;
                    $newposttag->save();
                }
            }

            DB::commit();
            return redirect()->route('post.index')->with('success', 'Sửa thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput()->with('warning', 'Lỗi hệ thống vui lòng thử lại!');
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
        
    }

    public function trash()
    {
        
    }

    public function deletetrash($id)
    {
        
    }
}