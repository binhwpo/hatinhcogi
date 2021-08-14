<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\RepositoryController;

use App\Models\User;
use App\Models\Group_User;
use App\Models\Group_Has_Permissions;
use App\Models\User_Has_Permissions;
use App\Models\Permissions;

class UserController extends Controller
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
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group_User::all();
        $permissions = Permissions::all();
        return view('admin.user.add', compact('groups', 'permissions'));
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
            $maxid = DB::table('users')->max('id') + 1;
            $newuser = new User();
            $newuser->id = $maxid;
            $newuser->username = $request->username;
            $newuser->email = $request->email;
            $newuser->name = $request->name;
            $newuser->phone = $request->phone;
            $newuser->address = $request->address;
            $newuser->description = $request->description;
            $newuser->password = Hash::make($request->password);
            $newuser->group_id = $request->group_id;
            if ($request->img_profile != null) {
                $newuser->img_profile = $this->repositoryController->imgprofile($request->img_profile, 'assets/images/profile/');  
            }
            $newuser->save();

            if (isset($request->permissions) && $request->permissions != null) {
                foreach ($request->permissions as $key => $value) {
                    $new = new User_Has_Permissions();
                    $new->user_id = $maxid;
                    $new->permission_id = $value;
                    $new->save();
                }
            }
            
            DB::commit();
            return redirect()->route('user.index')->with('success', 'Thêm tài khoản mới thành công!');
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
    public function edit($id)
    {
        $groups = Group_User::all();
        $permissions = Permissions::all();
        $user = User::where('username', $id)->first();
        return view('admin.user.edit', compact('groups', 'permissions','user'));
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
            $user = User::find($id);
            $update = User::where('id', $id)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'description' => $request->description,
                'group_id' => $request->group_id,
            ]);

            if ($request->password != null ) {
                $update = User::where('id', $id)->update([
                    'password' => Hash::make($request->password),
                ]);    
            }

            if ($request->img_profile != null) {
                $update = User::where('id', $id)->update([
                    'img_profile' => $this->repositoryController->imgprofile($request->img_profile, 'assets/images/profile/'),
                ]);  
            }

            User_Has_Permissions::where('user_id', $id)->delete();
            if (isset($request->permissions) && $request->permissions != null) {
                foreach ($request->permissions as $key => $value) {
                    $new = new User_Has_Permissions();
                    $new->user_id = $id;
                    $new->permission_id = $value;
                    $new->save();
                }
            }

            DB::commit();
            return redirect()->route('user.index')->with('success', 'Sửa tài khoản thành công!');
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
        //
    }
}
