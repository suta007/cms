<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
        if (!empty($keyword)) {
            $datas = Setting::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $datas = Setting::paginate($perPage);
        }
        return view('admin.setting.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.setting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
            'value.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();

        Setting::create($inputData);
        return redirect()->route('admin.setting.index')->with('success', 'ตั้งค่าเว็บเรียบร้อยแล้ว');
        /*
        $result = Setting::create($inputData);
        return redirect()->route('admin.setting.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = Setting::findOrFail($id);
        return view('admin.setting.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Setting::findOrFail($id);
        return view('admin.setting.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'value' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
            'value.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $result = Setting::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('admin.setting.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');

        //  return redirect()->route('admin.setting.show', $result->id);

    }

    public function destroy($id)
    {
        Setting::destroy($id);
        return redirect()->route('admin.setting.index')->with('info', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
