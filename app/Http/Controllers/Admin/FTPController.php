<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\FTP;

class FTPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ftps = FTP::all();
        return view('admin.ftp.index', compact('ftps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $insertData = $request->only(['name', 'host', 'username', 'password', 'port', 'storage']);
            $newftp = new FTP($insertData);
            if ($request->status != 'on') {
                $newftp->status = 0;
            }
            $newftp->user_id = Auth::user()->id;
            $newftp->save();
            DB::commit();
            return redirect()->route('accountftp.index')->with('success', 'Thêm thành công!');;
        } catch (\Exception $e) {
            DB::rollBack();
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
        $ftp = FTP::find($_GET['id']);
        return view('admin.ftp.edit',compact('ftp'));
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
            $ftp = FTP::where('id', $id)->update([
                'name' => $request->name,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'storage' => $request->storage,
            ]);

            if ($request->status == 'on') {
                $ftp = FTP::where('id', $id)->update([
                    'status' => 1,
                ]);
            }else {
                $ftp = FTP::where('id', $id)->update([
                    'status' => 0,
                ]);
            }

            DB::commit();
            return redirect()->route('accountftp.index')->with('success', 'Sửa thành công!');
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
        $ftp = FTP::find($id);
        if (!$ftp) {
            return redirect()->route('accountftp.index')->with('warning', 'Không tìm thấy tài khoản cần xóa');
        }
        $ftp->delete();
        return redirect()->route('accountftp.index')->with('success', 'Xóa tài khoản thành công');
    }
}
