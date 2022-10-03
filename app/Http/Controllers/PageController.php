<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function view($slug)
    {
        $data = Page::WHERE("slug", $slug)->first();
        return view('page', compact('data'));
    }
}
