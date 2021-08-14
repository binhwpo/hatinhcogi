<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 

use App\Models\Categories;
use App\Models\Posts;

class RepositoryController extends Controller
{
    public function imgprofile($file, $path)
    {
        $name = $file->getClientOriginalName();
        $name = explode('.',$name);
        $imageNames = $name[0].'_'.time().'.'.$name[1];
        if(File::exists($path.$imageNames)) {
            $rand = rand(0,100);
            $imageNames = $name[0].'_'.time().$rand.'.'.$name[1];
        }
        $file->move(public_path($path), $imageNames);
        return $path.$imageNames;
    }
}
