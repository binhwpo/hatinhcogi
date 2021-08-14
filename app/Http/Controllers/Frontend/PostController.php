<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Posts;
use App\Models\Categories;
use App\Models\User;
use App\Models\Slug;
use App\Models\Page;

class PostController extends Controller
{
    public function allpost()
    {
        $posts = Posts::where('status', 1)->paginate(6);
        return view('frontend.post.list-post', compact('posts'));
    }

    public function detailpost($slug)
    {
       
        if (isset($slug) && $slug != '') {
            $slugid = Slug::where('slug', $slug)->first();
            if ($slugid->page_id != null) {
                $page = Page::find($slugid->page_id);
                return view('frontend.page.page', compact('page'));
            }
            $post = Posts::where('slug_id', $slugid->id)->where('status', 1)->first();

            if (!$post) {
                return redirect()->route('page');
            }
            $postnew = Posts::where('status', 1)->orderby('id', 'DESC')->limit(12)->get();
            return view('frontend.post.postdetail', compact('post', 'postnew'));
        } else {
            return redirect()->route('allpost');
        }
        
    }

    public function detailcategory($slug)
    {
        if (isset($slug) && $slug != '') {
            $array = array();
            $id = $this->getCategoriesIds(Categories::where('slug', $slug)->first());
            if (!$id) {
                return redirect()->route('allpost');
            }
            $poststest = Posts::join('category_posts', 'posts.id', '=', 'category_posts.post_id')->select('id')->whereIn('category_id',$id)->get();
            foreach ($poststest as $post) {
                $check = 1;
                foreach ($array as $item) {
                    if ($post->id == $item) {
                        $check = 0;
                    }
                }

                if ($check == 1) {
                    array_push($array, $post->id);
                }
            }
            $posts = Posts::whereIn('id',$array)->orderby('id', 'DESC')->paginate(12);
            $categoriespost = Categories::where('slug', $slug)->first();
            return view('frontend.post.list-post',compact('posts', 'categoriespost'));
        } else {
            return redirect()->route('allpost');
        }
    }

    public function detailauthor($username)
    {
        if (isset($username) && $username != '') {
            $author = User::where('username', $username)->first();
            if (!$author) {
                return redirect()->route('allpost');
            }
            $posts = Posts::where('user_create', $author->id)->where('status', 1)->paginate(12);
            return view('frontend.post.list-post',compact('posts', 'author'));
        } else {
            return redirect()->route('allpost');
        }
    }

    public function getCategoriesIds($category)
    {
        if(!empty($category))
        {
            $array = array($category->id);
            if(count($category->childrenCategories) == 0){
                return $array;
            }else {
                return array_merge($array, $this->getChildrenIds($category->childrenCategories));
            } 
        }else {
            return null;
        }
    }

    public function getChildrenIds($subcategories)
    {
        $array = array();
        foreach ($subcategories as $subcategory)
        {
            array_push($array, $subcategory->id);
            if(count($subcategory->childrenCategories) > 0){
               $array = array_merge($array, $this->getChildrenIds($subcategory->childrenCategories));
            }
        }
        return $array;
    }
}
