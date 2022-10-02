<?php

namespace App\Http\Controllers\User;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = Page::where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $datas = Page::latest()->paginate($perPage);
        }
        return view('user.page.index', compact('datas'));
    }

    public function create()
    {
        return view('user.page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();

        Page::create($inputData);
        return redirect()->route('user.page.index')->with('success', 'สร้างข้อมูลPageเรียบร้อยแล้ว');
    /*
        $result = Page::create($inputData);
        return redirect()->route('user.page.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = Page::findOrFail($id);
        return view('user.page.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Page::findOrFail($id);
        return view('user.page.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $result = Page::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('user.page.index')->with('success', 'แก้ไขข้อมูลPageเรียบร้อยแล้ว');

    //  return redirect()->route('user.page.show', $result->id);

    }

    public function destroy($id)
    {
        Page::destroy($id);
        return redirect()->route('user.page.index')->with('info', 'ลบข้อมูลPageเรียบร้อยแล้ว');
    }
}
