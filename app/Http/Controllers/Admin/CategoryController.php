<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Categories;
use App\Models\Posts;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::whereNull('parent_id')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($_GET['id'] == 0) {
            return view('admin.category.add');
        } else {
            $category = Categories::find($_GET['id']);
            return view('admin.category.add',compact('category'));
        }
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
            $data = $request->only(['category_name', 'description', 'slug', 'icon']);
            $db = new Categories($data);
            $db->user_id = Auth::user()->id;
            if ($request->checkcategory != 0 ) {
                $db->parent_id = $request->checkcategory;
            }
            if ($request->megamenu == 'on') {
                $db->megamenu = 1;
            }
            if ($request->status != 'on') {
                $db->megamenu = 0;
            }
            $db->save();
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Thêm thành công!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $category = Categories::find($_GET['id']);
        return view('admin.category.edit',compact('category'));
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
            $post = Categories::where('id', $id)->update([
                'category_name' => $request->category_name,
                'slug' => $request->slug,
                'description' => $request->description,
                'icon' => $request->icon,
            ]);

            if ($request->megamenu == 'on') {
                $post = Categories::where('id', $id)->update([
                    'megamenu' => 1,
                ]);
            }else {
                $post = Categories::where('id', $id)->update([
                    'megamenu' => 0,
                ]);
            }
            if ($request->status == 'on') {
                $post = Categories::where('id', $id)->update([
                    'status' => 1,
                ]);
            }else {
                $post = Categories::where('id', $id)->update([
                    'status' => 0,
                ]);
            }

            DB::commit();
            return redirect()->route('category.index')->with('success', 'Sửa thành công!');
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
        $category = Categories::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('warning', 'Không tìm thấy danh mục cần xóa');
        }
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }
}
