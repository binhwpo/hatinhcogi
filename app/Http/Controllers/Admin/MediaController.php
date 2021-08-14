<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Media;
use App\Models\FTP;
use App\Models\Icon;

class MediaController extends Controller
{
    public function index()
    {
        if (isset($_GET['serveri']) && $_GET['serveri'] != '') {
            $media = Media::where('fpt_id', $_GET['serveri'])->orderBy('id', 'DESC')->get();
            $img = Media::where('fpt_id', $_GET['serveri'])->where('type', 'img')->orderBy('id', 'DESC')->get();
            $video = Media::where('fpt_id', $_GET['serveri'])->where('type', 'video')->orderBy('id', 'DESC')->get();
            $doc = Media::where('fpt_id', $_GET['serveri'])->where('type', 'docx')->orderBy('id', 'DESC')->get();
            $other = Media::where('fpt_id', $_GET['serveri'])->where('type', 'other')->orderBy('id', 'DESC')->get();
        } else {
            $media = Media::orderBy('id', 'DESC')->get();
            $img = Media::where('type', 'img')->orderBy('id', 'DESC')->get();
            $video = Media::where('type', 'video')->orderBy('id', 'DESC')->get();
            $doc = Media::where('type', 'docx')->orderBy('id', 'DESC')->get();
            $other = Media::where('type', 'other')->orderBy('id', 'DESC')->get();
        }
        
        return view('admin.media.index', compact('media', 'img', 'video', 'doc', 'other'));
    }

    function uploadFTP($server, $username, $password, $local_file, $remote_file, $port){
        $connection = ftp_connect($server, $port);
        if (@ftp_login($connection, $username, $password)){
            ftp_put($connection, $remote_file, $local_file, FTP_BINARY);
            ftp_close($connection);
            return true;
        }else{
            return false;
        }
    }

    function deleteFTP($server, $username, $password, $path_fileremove, $port){
        $connection = ftp_connect($server, $port);
        if (@ftp_login($connection, $username, $password)){
            $file_size = ftp_size($connection, $path_fileremove);
    
            if ($file_size != -1) {
                ftp_delete($connection, $path_fileremove);
            } 
        }
    }

    public function uploadmediaadmin()
    {
        $extsimg = array('gif', 'png', 'jpg', 'jpge'); 
        $extsdoc = array('doc', 'docx', 'xlsx', 'xls', 'txt'); 
        $extsvideo = array('mp3', 'mp4', 'avi', 'flv', 'mkv');
        $data['view1'] = '';
        $data['view2'] = '';

        $numberfile = $_POST['numberfile'];
        if ($numberfile > 0) {
            $ftp = FTP::where('status', 1)->first(); 

            if (!$ftp) {
                $data['check'] = 'false';
                $data['error'] = 'Không tìm thấy ftp sever nào vui lòng kiểm tra lại!';
                return $data;
            }

            try {
                for ($i=0; $i < $numberfile; $i++) { 
                    $maxid = DB::table('media')->max('id') + 1;
                    // $file = $_FILES['mediaupload']['tmp_name'];
                    // $name = $_FILES['mediaupload']["name"];

                    $file = $_FILES['file-'.$i]['tmp_name'];
                    $name = $_FILES['file-'.$i]["name"];
                    $imageNames = $maxid.'_'.time().'_'.$name;

                    $pathcheck = '/public_html/images/'.Auth::user()->id;
                    $pathimg = '/public_html/images/'.Auth::user()->id.'/';
                    $pathdb = '/images/'.Auth::user()->id.'/';

                    if (1 == 2) {
                        ftp_mkdir($conn_id, $pathcheck);
                    }
                
                    $this->uploadFTP($ftp->host, $ftp->username, $ftp->password, $file, $pathimg.$imageNames, $ftp->port);
                                        
                    $urldb = $pathdb.$imageNames;

                    $newmedia = new Media();
                    $newmedia->user_id = Auth::user()->id;
                    $newmedia->id = $maxid;
                    $newmedia->image_url = $urldb;
                    $newmedia->fpt_id = 1;

                    if (in_array(pathinfo($name, PATHINFO_EXTENSION), $extsimg)) {
                        $newmedia->type = 'img';
                        $data['checkview'] = 'img';
                    } elseif (in_array(pathinfo($name, PATHINFO_EXTENSION), $extsvideo)) {
                        $newmedia->type = 'video';
                        $data['checkview'] = 'video';
                    } elseif (in_array(pathinfo($name, PATHINFO_EXTENSION), $extsdoc)) {
                        $newmedia->type = 'docx';
                        $data['checkview'] = 'docx';
                    } else {
                        $newmedia->type = 'other';
                        $data['checkview'] = 'other';
                    }
                    $newmedia->save();

                    $data['view1'] = $data['view1'].'<div id="listmedia'.$maxid.'" class="col-xl-3 col-md-4 col-sm-6">';
                    $data['view2'] = $data['view2'].'<div id="list'.$data['checkview'].$maxid.'" class="col-xl-3 col-md-4 col-sm-6">';

                    $text = '<div class="card border p-0 shadow-none">
                                            <div class="d-flex align-items-center px-4 pt-4">
                                                <div class="float-right ml-auto">
                                                    <div class="btn-group ml-3 mb-0">
                                                        <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i class="fe fe-share mr-2"></i> Chia sẻ</a>
                                                            <a class="dropdown-item" href="#"><i class="fe fe-download mr-2"></i> Tải xuống</a>
                                                            <span style="cursor: pointer" onclick="return removeelement('.$maxid.')" class="dropdown-item" href="#"><i class="fe fe-trash mr-2"></i> Xóa</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 text-center">
                                                <div class="file-manger-icon">';

                    if ($data['checkview'] == 'img') {
                        $icon = '<img src="http://'.$ftp->host.$urldb.'" alt="img" class="br-7">';
                    } elseif ($data['checkview'] == 'video') {
                        $icon = '<i class="fas fa-video"></i>';
                    } elseif ($data['checkview'] == 'docx') {
                        $icon = '<i class="fal fa-file-alt"></i>';
                    } else {
                        $icon = '<i class="fal fa-file"></i>';
                    }
                    
                    $footer = '</div><h6 class="mb-1 font-weight-semibold mt-4"><a target="_blank" href="http://'.$ftp->host.$urldb.'">'.$name.'</a></h6></div></div></div>';

                    $data['view1'] = $data['view1'].$text.$icon.$footer;
                    $data['view2'] = $data['view2'].$text.$icon.$footer;
                    
                    $data['check'] = 'true';
                }
            } catch (\Throwable $th) {
                $data['check'] = 'false';
                $data['error'] = 'Lỗi không xác định!';
            }
        }
        return $data;
    }

    public function delete()
    {
        $media = Media::find($_POST['idelement']);
        if (!$media) {
            $data['iddelete'] = 0;
            $data['notif'] = 'Lỗi 1 khi xóa ảnh!';
            return $data;
        }

        $ftp = FTP::find($media->fpt_id);

        if (!$ftp) {
            $data['iddelete'] = 0;
            $data['notif'] = 'Lỗi không tìm thấy ftp server!';
            return $data;
        }

        $data['iddelete'] = $media->id;
        $data['type']  = $media->type;
        $this->deleteFTP($ftp->host, $ftp->username, $ftp->password, $media->image_url, $ftp->port);
        $media->delete();
        return $data;
    }

    public function loadmedia()
    {
        $media = Media::where('type', 'img')->orderBy('id', 'DESC')->get();
        return view('admin.media.list',compact('media'));
    }

    public function loadicon()
    {
        $icon = Media::orderBy('id', 'DESC')->get();
        return view('admin.media.listicon',compact('icon'));
    }

    public function saveicon()
    {
        $icon = trim($_POST['icon']);
        $check = Icon::where('icon', $icon)->first();
        if ($check) {
            return 0;
        } else {
            $newicon = new Icon();
            $newicon->icon = $icon;
            $newicon->save();
            return 1;
        }
        
    }




















    
    public function loaddetailmedia()
    {
        $media = Media::find($_POST['id']);
        return view('admin.media.detail',compact('media'));
    }

    public function filtermedia()
    {
        $media = Media::orderBy('id', 'DESC')->get();
        if (isset($_POST['imgfilter']) && isset($_POST['imgdate'])) {
            if ($_POST['imgfilter'] == 'all' && $_POST['imgdate'] == 'all' && $_POST['q'] == '') {
                $media = Media::orderBy('id', 'DESC')->get();
            }elseif($_POST['imgfilter'] != 'all'){

                if ($_POST['imgdate'] == 'all' && $_POST['q'] != '') {
                    $q = $_POST['q'];
                    $media = Media::where('user_id',Auth::user()->id)
                                    ->where('image_url','LIKE',"%$q%")
                                    ->OrderBy('id','DESC')
                                    ->get(); 
                }elseif($_POST['imgdate'] != 'all' && $_POST['q'] == '') {
                    $media = Media::where('user_id',Auth::user()->id)
                                    ->whereMonth('created_at', $_POST['imgdate'])
                                    ->OrderBy('id','DESC')
                                    ->get(); 
                }elseif($_POST['imgdate'] == 'all' && $_POST['q'] == '') {
                    $media = Media::where('user_id',Auth::user()->id)
                                    ->OrderBy('id','DESC')
                                    ->get(); 
                }else {
                    $q = $_POST['q'];
                    $media = Media::where('user_id',Auth::user()->id)
                                    ->where('image_url','LIKE',"%$q%")
                                    ->whereMonth('created_at', $_POST['imgdate'])
                                    ->OrderBy('id','DESC')
                                    ->get();
                }
                
            }elseif($_POST['imgdate'] != 'all' && $_POST['imgfilter'] == 'all'){

                if ($_POST['q'] != '') {
                    $q = $_POST['q'];
                    $media = Media::whereMonth('created_at', $_POST['imgdate'])
                                    ->where('image_url','LIKE',"%$q%")
                                    ->OrderBy('id','DESC')
                                    ->get(); 
                }elseif($_POST['q'] == '') {
                    $media = Media::whereMonth('created_at', $_POST['imgdate'])
                                    ->OrderBy('id','DESC')
                                    ->get(); 
                }
                
            }elseif($_POST['q'] != '' && $_POST['imgfilter'] == 'all' && $_POST['imgdate'] == 'all'){
                $q = $_POST['q'];
                $media = Media::where('image_url','LIKE',"%$q%")
                                    ->OrderBy('id','DESC')
                                    ->get(); 
            }
        }else {   
            $media = Media::orderBy('id', 'DESC')->get();
        }
        return view('admin.media.list',compact('media'));
    }

    public function uploadmedia()
    {
        $data = array();
        $numberfile = $_POST['numberfile'];
        if ($numberfile > 0) {

            $ftp_server = "img.hatinhcogi.com";
            $conn_id = ftp_connect($ftp_server);

            $data['view'] = '';
            $data['checkbox'] = '';
            $data['id'] = '';
            $data['numfile'] = 0;

            if (@ftp_login($conn_id, 'admin_dev', 'admin_dev')) {
                $data['check'] = 'true';
                try {
                    for ($i=0; $i < $numberfile; $i++) { 
                        $file = $_FILES['file-'.$i]['tmp_name'];
                        $fp = fopen($file, 'r');
                        $maxid = DB::table('media')->max('id') + 1;
                        $name = $_FILES['file-'.$i]["name"];
                        $imageNames = $maxid.'_'.time().'_'.$name;

                        $pathcheck = '/public_html/images/'.Auth::user()->id;
                        $pathimg = '/public_html/images/'.Auth::user()->id.'/';
                        $pathdb = '/images/'.Auth::user()->id.'/';
                        if (ftp_nlist($conn_id, $pathcheck) == false) {
                            ftp_mkdir($conn_id, $pathcheck);
                        }

                        ftp_fput($conn_id, $pathimg.$imageNames, $fp, FTP_ASCII); 
                                          
                        $urldb = 'http://'.$ftp_server.$pathdb.$imageNames;

                        $newmedia = new Media();
                        $newmedia->user_id = Auth::user()->id;
                        $newmedia->image_url = $urldb;
                        $newmedia->type = 1;
                        $newmedia->save();

                        if($data['id'] == ''){
                            $data['id'] = $maxid;
                        }else {
                            $data['id'] = $data['id'].','.$maxid;
                        }

                        $data['numfile']++;

                        $previewimg = '<div style="margin-top: 4px" class="col-md-2">
                                        <label for="'.$maxid.'">
                                        <img id="img'.$maxid.'" onclick="return selectimage('.$maxid.')" class="imagedisplay" src="'.$urldb.'" alt="">
                                        </label>
                                    </div>';

                        $data['checkbox'] = '<input name="imgselect[]" style="display: none" type="checkbox" value="'.$maxid.'" id="'.$maxid.'">'.$data['checkbox'];

                        $data['view'] = $previewimg.$data['view'];

                    }
                } catch (\Throwable $th) {
                    $data['check'] = 'false';
                    $data['error'] = 'Lỗi không xác định!';
                }
            }else {
                $data['check'] = 'false';
                $data['error'] = 'Lỗi không thể kết nối với server vui lòng làm mới lại trang và thử lại!';
            }
        }
        return $data;
    }

    public function ajaxuploadmedia()
    {
        // $data = array();
        // $numberfile = $_POST['numberfile'];
        // if ($numberfile > 0) {

        //     $ftp_server = "img.hatinhcogi.com";
        //     $conn_id = ftp_connect($ftp_server);

        //     $data['view'] = '';
        //     $data['checkbox'] = '';
        //     $data['id'] = '';
        //     $data['numfile'] = 0;

        //     if (@ftp_login($conn_id, 'admin_dev', 'admin@123')) {
        //         $data['check'] = 'true';
        //         try {
        //             for ($i=0; $i < $numberfile; $i++) { 
        //                 $file = $_FILES['file-'.$i]['tmp_name'];
        //                 $fp = fopen($file, 'r');
        //                 $maxid = DB::table('media')->max('id') + 1;
        //                 $name = $_FILES['file-'.$i]["name"];
        //                 $imageNames = $maxid.'_'.time().'_'.$name;

        //                 $pathcheck = '/public_html/images/'.Auth::user()->id;
        //                 $pathimg = '/public_html/images/'.Auth::user()->id.'/';
        //                 $pathdb = '/images/'.Auth::user()->id.'/';
        //                 if (ftp_nlist($conn_id, $pathcheck) == false) {
        //                     ftp_mkdir($conn_id, $pathcheck);
        //                 }

        //                 ftp_fput($conn_id, $pathimg.$imageNames, $fp, FTP_ASCII); 
                                          
        //                 $urldb = 'http://'.$ftp_server.$pathdb.$imageNames;

        //                 $newmedia = new Media();
        //                 $newmedia->user_id = Auth::user()->id;
        //                 $newmedia->image_url = $urldb;
        //                 $newmedia->type = 1;
        //                 $newmedia->save();

        //                 if($data['id'] == ''){
        //                     $data['id'] = $maxid;
        //                 }else {
        //                     $data['id'] = $data['id'].','.$maxid;
        //                 }

        //                 $data['numfile']++;

        //                 $previewimg = '<div style="margin-top: 4px" class="col-md-2">
        //                                 <label for="'.$maxid.'">
        //                                 <img id="img'.$maxid.'" onclick="return selectimage('.$maxid.')" class="imagedisplay" src="'.$urldb.'" alt="">
        //                                 </label>
        //                             </div>';

        //                 $data['checkbox'] = '<input name="imgselect[]" style="display: none" type="checkbox" value="'.$maxid.'" id="'.$maxid.'">'.$data['checkbox'];

        //                 $data['view'] = $previewimg.$data['view'];

        //             }
        //         } catch (\Throwable $th) {
        //             $data['check'] = 'false';
        //             $data['error'] = 'Lỗi không xác định!';
        //         }
        //     }else {
        //         $data['check'] = 'false';
        //         $data['error'] = 'Lỗi không thể kết nối với server vui lòng làm mới lại trang và thử lại!';
        //     }
        // }
        // return $data;
    }
}