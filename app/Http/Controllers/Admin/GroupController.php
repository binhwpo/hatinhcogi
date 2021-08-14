<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Group_User;
use App\Models\Group_Has_Permissions;
use App\Models\User_Has_Permissions;
use App\Models\Permissions;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group_User::all();
        return view('admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permissions::all();
        return view('admin.group.add', compact('permissions'));
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
            $maxid = DB::table('Group_User')->max('id') + 1;
            $newgr = new Group_User();
            $newgr->id = $maxid;
            $newgr->group_name = $request->group_name;
            $newgr->slug = $request->slug;
            $newgr->save();

            if (isset($request->permissions) && $request->permissions != null) {
                foreach ($request->permissions as $key => $value) {
                    $new = new Group_Has_Permissions();
                    $new->group_id = $maxid;
                    $new->permission_id = $value;
                    $new->save();
                }
            }
            
            DB::commit();
            return redirect()->route('group.index')->with('success', 'Thêm nhóm mới thành công!');
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
        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permissions::all();
        $group = Group_User::find($id);
        return view('admin.group.edit', compact('permissions', 'group'));
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
            $update = Group_User::where('id', $id)->update([
                'group_name' => $request->group_name,
                'slug' => $request->slug,
            ]);            

            Group_Has_Permissions::where('group_id', $id)->delete();
            if (isset($request->permissions) && $request->permissions != null) {
                foreach ($request->permissions as $key => $value) {
                    $new = new Group_Has_Permissions();
                    $new->group_id = $id;
                    $new->permission_id = $value;
                    $new->save();
                }
            }
            
            DB::commit();
            return redirect()->route('group.index')->with('success', 'Sửa thành công!');
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
        return 1;
        // try {
        //     DB::beginTransaction();
        //     $delete = Group_User::find($id)->delete();
        //     DB::commit();
        //     return redirect()->route('group.index')->with('success', 'Xóa thành công!');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('group.index')->with('warning', 'Lỗi hệ thống vui lòng thử lại!');
        // }
    }
}
