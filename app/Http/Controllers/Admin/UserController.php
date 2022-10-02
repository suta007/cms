<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = User::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $datas = User::paginate($perPage);
        }
        return view('admin.user.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'type' => 'required',
        ], [
            'username.required' => 'ต้องกรอก Username',
            'username.unique' => 'Username ' . $request->username . ' ซ้ำไม่สามารถใช้งานได้',
            'name.required' => 'ต้องกรอกชื่อของผู้ใช้งาน',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'email.unique' => 'อีเมล์นี้ถูกใช้แล้ว กรุณาใช้อีเมล์อื่น',
            'password.min' => 'รหัสผ่านต้องไม่น้องกว่า 8 ตัวอักษร',
            'type.required' => 'ต้องกำหนดประเภทผู้ใช้งาน',
        ]);

        $inputData = $request->all();
        $inputData['password'] = Hash::make($request->password);
        User::create($inputData);
        return redirect()->route('admin.user.index')->with('success', 'สร้างข้อมูลผู้ใช้งานเรียบร้อยแล้ว');
        /*
    $result = User::create($inputData);
    return redirect()->route('admin.user.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.show', compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'type' => 'required',
        ], [
            'name.required' => 'ต้องกรอกชื่อขอผู้ใช้งาน',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'email.unique' => 'อีเมล์นี้ถูกใช้แล้ว กรุณาใช้อีเมล์อื่น',
            'password.min' => 'รหัสผ่านต้องไม่น้องกว่า 8 ตัวอักษร',
            'type.required' => 'ต้องกำหนดประเภทผู้ใช้งาน',
        ]);

        $inputData = $request->all();
        if (!empty($request->password)) {
            $inputData['password'] = Hash::make($request->password);
        } else {
            unset($inputData['password']);
        }

        $result = User::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('admin.user.index')->with('success', 'แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว');

        //  return redirect()->route('admin.user.show', $result->id);

    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with('info', 'ลบข้อมูลผู้ใช้งานเรียบร้อยแล้ว');
    }
}
