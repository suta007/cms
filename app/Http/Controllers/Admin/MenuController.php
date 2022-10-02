<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
/*         $keyword = $request->get('search');
$perPage = (!empty($request->get('perPage'))) ? $request->get('perPage') : 25;
if (!empty($keyword)) {
$datas = Menu::where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
} else {
$datas = Menu::latest()->paginate($perPage);
} */
        $datas = Menu::where('parent_id', '0')->with('childs')->get(); //->orderBy('ordering', 'asc');
        //dd($datas);
        return view('admin.menu.index', compact('datas'));
    }

    public function create()
    {
        $datas = Menu::where('parent_id', '0')->get();
        return view('admin.menu.create', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'required|integer',
            'ordering' => 'required|integer',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();

        Menu::create($inputData);
        return redirect()->route('admin.menu.index')->with('success', 'สร้างข้อมูลเมนูเรียบร้อยแล้ว');
        /*
    $result = Menu::create($inputData);
    return redirect()->route('admin.menu.show', $result->id);
     */
    }

    public function show($id)
    {
        $data = Menu::findOrFail($id);
        return view('admin.menu.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Menu::findOrFail($id);
        $datas = Menu::where('parent_id', '0')->get();
        return view('admin.menu.edit', compact('data', 'datas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'ต้องกรอกข้อมูลนี้',
        ]);

        $inputData = $request->all();
        $result = Menu::findOrFail($id);
        $result->update($inputData);

        return redirect()->route('admin.menu.index')->with('success', 'แก้ไขข้อมูลเมนูเรียบร้อยแล้ว');

        //  return redirect()->route('admin.menu.show', $result->id);

    }

    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect()->route('admin.menu.index')->with('info', 'ลบข้อมูลเมนูเรียบร้อยแล้ว');
    }
}
