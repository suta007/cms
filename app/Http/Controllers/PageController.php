<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;

class PageController extends Controller
{
    public function index()
    {
        $index = getsetting('index');
        if ($index == "page") {
            $id = getsetting('page_id');
            $data = Page::where('id', $id)->first();
            return view('page', compact('data'));
        }
        /*          else if ($index == "post") {
            $id = getsetting('post_id');
            $data = Post::where('id', $id)->first();
            return view('post', compact('data'));
        } */
    }
    public function view($slug)
    {
        $data = Page::WHERE("slug", $slug)->first();
        return view('page', compact('data'));
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('pictures');
            $url = asset($path);
            return response()->json(['location' => "$url"]);
        }
    }
}
