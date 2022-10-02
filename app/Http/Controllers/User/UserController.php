<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit()
    {
        $id = Auth::id();
        $data = User::findOrFail($id);
        return view('user.main.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = Auth::id();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
        ], [
            'name.required' => 'ต้องกรอกชื่อของผู้ใช้งาน',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'email.unique' => 'อีเมล์นี้ถูกใช้แล้ว กรุณาใช้อีเมล์อื่น',
        ]);

        $inputData = $request->all();
        $result = User::findOrFail($id);
        $result->update($inputData);

        return redirect()->back()->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');

        //  return redirect()->route('user.main.show', $result->id);

    }

    public function editpass()
    {
        $data = Auth::user(); // Member::findOrFail($id);
        return view('user.main.editpass', compact('data'));
    }

    public function updatepass(Request $request)
    {
        ///$id = Auth::id();
        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'ต้องกรอกรหัสผ่านปัจจุบัน',
            'password.confirmed' => 'ยืนยันรหัสผ่านไม่ตรงกับรหัสผ่านใหม่',
        ]);

        //$inputData = $request->all();
        // $result = User::findOrFail($id);
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'เปลี่ยนรหัสผ่านแล้ว');
    }
}
