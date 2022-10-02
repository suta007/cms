<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use TitasGailius\Terminal\Terminal;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = User::where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $datas = User::latest()->paginate($perPage);
        }
        return view('admin.setup.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.setup.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('admin.setup.show', compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.setup.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $result = User::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('admin.setup.index')->with('success', 'แก้ไขข้อมูลSetupเรียบร้อยแล้ว');

        //  return redirect()->route('admin.setup.show', $result->id);

    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.setup.index')->with('info', 'ลบข้อมูลSetupเรียบร้อยแล้ว');
    }
}
