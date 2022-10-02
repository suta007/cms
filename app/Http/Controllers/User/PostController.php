<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = Post::where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $datas = Post::latest()->paginate($perPage);
        }
        return view('user.post.index', compact('datas'));
    }

    public function create()
    {
        return view('user.post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();

        Post::create($inputData);
        return redirect()->route('user.post.index')->with('success', 'สร้างข้อมูลPostเรียบร้อยแล้ว');
    /*
        $result = Post::create($inputData);
        return redirect()->route('user.post.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = Post::findOrFail($id);
        return view('user.post.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        return view('user.post.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $result = Post::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('user.post.index')->with('success', 'แก้ไขข้อมูลPostเรียบร้อยแล้ว');

    //  return redirect()->route('user.post.show', $result->id);

    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('user.post.index')->with('info', 'ลบข้อมูลPostเรียบร้อยแล้ว');
    }
}
