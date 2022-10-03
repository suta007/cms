<?php

namespace App\Http\Controllers\Admin;

use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ViewerController extends Controller
{
    public function login()
    {
        return view('admin.viewer.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'ต้องกรอกข้อมูลนี้',
            'password.required' => 'ต้องกรอกข้อมูลนี้',
        ]);
        if (Auth::guard('viewer')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $data = Auth::guard('viewer')->user();
            $data->last_login = date('Y-m-d H:i:s');
            $data->save();
            return redirect('/');
        }
        return back()->withInput($request->only('username'))->with("error", "กรุณาตรวจสอบ Username และ Password อีกครั้ง");
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = Viewer::where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $datas = Viewer::latest()->paginate($perPage);
        }
        return view('admin.viewer.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.viewer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:100',
            'password' => 'required|max:100',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
            'password.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $inputData["password"] = Hash::make($request->password);
        Viewer::create($inputData);
        return redirect()->route('admin.viewer.index')->with('success', 'สร้างผู้เยี่ยมชมเรียบร้อยแล้ว');
        /*
        $result = Viewer::create($inputData);
        return redirect()->route('admin.viewer.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = Viewer::findOrFail($id);
        return view('admin.viewer.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Viewer::findOrFail($id);
        return view('admin.viewer.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|max:100',
        ], [
            'username.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        //$inputData = $request->all();
        $inputData["username"] = $request->username;
        if (!empty($request->password)) {
            $inputData["password"] = $request->password;
        }
        $result = Viewer::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('admin.viewer.index')->with('success', 'แก้ไขผู้เยี่ยมชมเรียบร้อยแล้ว');

        //  return redirect()->route('admin.viewer.show', $result->id);

    }

    public function destroy($id)
    {
        Viewer::destroy($id);
        return redirect()->route('admin.viewer.index')->with('info', 'ลบผู้เยี่ยมชมเรียบร้อยแล้ว');
    }
}
