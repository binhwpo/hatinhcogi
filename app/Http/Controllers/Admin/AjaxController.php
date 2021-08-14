<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\Permissions;
use App\Models\Group_User;
use App\Models\Group_Has_Permissions;
use App\Models\Service;
use App\Models\Icon;

class AjaxController extends Controller
{
    public function loadpermission()
    {
        $permissions = Permissions::all();
        if ($_POST['id'] == 0 || $_POST['id'] == null) {
            return view('admin.user.appendtest', compact('permissions'));
        } else {
            $group = Group_User::find($_POST['id']);
            return view('admin.user.appendtest', compact('permissions', 'group'));
        }
        
    }

    public function addfastcategorypost()
    {
        try {
            DB::beginTransaction();
            $categories = Categories::where('slug','bai-viet')->first();
            $category_name = $_POST['catename'];
            $parent_id = $_POST['parent_id'];
            $description = '';
            $icon = '';
            $data = ['category_name' => $category_name, 'description' => $description, 'icon' => $icon];
            $db = new Categories($data);
            $db->user_id = Auth::user()->id;
            $db->slug = Str::of($category_name)->slug('-');
            if ($parent_id != 0 ) {
                $db->parent_id = $parent_id;
            }else{
                $db->parent_id = $categories->id;
            }
            $db->save();
            DB::commit();

            $maxid = DB::table('categories')->max('id');
            if (isset($_POST['post_id']) && $_POST['post_id'] != 0) {
                $post = Posts::find($_POST['post_id']);
                return view('admin.category.viewcategorypost',compact('categories', 'post', 'maxid'));  
            } else {
                return view('admin.category.viewcategorypost',compact('categories', 'maxid'));  
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return 0;
        } 
    }

    public function addfastcategoryplace()
    {
        try {
            DB::beginTransaction();
            $categories = Categories::where('slug', 'dia-diem')->first();
            $category_name = $_POST['catename'];
            $parent_id = $_POST['parent_id'];
            $description = '';
            $icon = '';
            $data = ['category_name' => $category_name, 'description' => $description, 'icon' => $icon];
            $db = new Categories($data);
            $db->user_id = Auth::user()->id;
            $db->slug = Str::of($category_name)->slug('-');
            if ($parent_id != 0 ) {
                $db->parent_id = $parent_id;
            }else{
                $db->parent_id = $categories->id;
            }
            $db->save();
            DB::commit();

            $maxid = DB::table('categories')->max('id');
            if (isset($_POST['post_id']) && $_POST['post_id'] != 0) {
                $post = Posts::find($_POST['post_id']);
                return view('admin.category.viewcategoryplace',compact('categories', 'post', 'maxid'));  
            } else {
                return view('admin.category.viewcategoryplace',compact('categories', 'maxid'));  
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return 0;
        } 
    }

    public function addfastservices()
    {
        try {
            DB::beginTransaction();
            $icon = trim($_POST['icon']);
            $icondb = Icon::where('icon', $icon)->first();
            $name_services = $_POST['name_services'];
            $db = new Service();
            $db->icon_id = $icondb['id'];
            $db->name_services = $name_services;
            $db->save();
            DB::commit();
            $maxid = DB::table('services')->max('id');
            return '<li><input name="services[]" id="services" style="margin-right: 3px" value="'.$maxid.'" type="checkbox"><label for="'.$maxid.'">'.$icon.$name_services.'</label></li>';
        } catch (\Throwable $th) {
            DB::rollback();
            return 0;
        } 
    }
}