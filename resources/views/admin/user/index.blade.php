<?php
if (request()->page) {
    $page = request()->page;
} else {
    $page = 1;
}

if (request()->perPage) {
    $perPage = request()->perPage;
} else {
    $perPage = 25;
}

//DESC
//$start = $datas->total() - $page * $perPage;

//ASC
$start = ($page - 1) * $perPage;

?>

@extends('layouts.app')
@section('content')
	<x-div class="fw-bold fs-5 col-12 text-web mx-auto mb-2">
		<i class="fa-solid fa-user-gear me-2"></i>ผู้ใช้งาน
		<a href="{{ route('admin.user.create') }}" class="btn btn-web float-end mb-2">
			<i class="fa fa-plus me-2" aria-hidden="true"></i> เพิ่มผู้ใช้งาน
		</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="col-12 mx-auto px-5">
		<form method="GET" action="{{ route('admin.user.index') }}" accept-charset="UTF-8" class="form-inline my-lg-0 float-start me-2 my-2" role="perPage">
			<div class="input-group">
				<label for="perPage" class="col-form-label me-2">จำนวน</label>
				<select name="perPage" id="perPage" class="form-select">
					<option value="25" @selected(request('perPage') == 25)>25</option>
					<option value="50" @selected(request('perPage') == 50)>50</option>
					<option value="75" @selected(request('perPage') == 75)>75</option>
					<option value="100" @selected(request('perPage') == 100)>100</option>
				</select>
				<input type="hidden" name="search" value="{{ request('search') }}">
				<span class="input-group-append">
					<button class="btn btn-web" type="submit">
						<i class="fa-solid fa-check"></i>
					</button>
				</span>
			</div>
		</form>
		<form method="GET" action="{{ route('admin.user.index') }}" accept-charset="UTF-8" class="form-inline my-lg-0 float-end my-2" role="search">
			<div class="input-group">
				<input type="hidden" name="perPage" value="{{ request('perPage') }}">
				<label for="search" class="col-form-label me-2">ค้นหา</label>
				<input type="text" class="form-control rounded" name="search" placeholder="ค้นหา..." value="{{ request('search') }}">
				<span class="input-group-append">
					<button class="btn btn-web" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>

		<div class="clearfix"></div>
		@include('layouts.message')
		<table class="table-bordered table-hover table" id="dataTable">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">ชื่อ</th>
					<th class="text-center">username</th>
					<th class="text-center">e Mail</th>
					<th class="text-center">Last Login</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datas as $item)
					<tr>
						<td class="text-nowrap text-center" style="width: 1%;">{{ $start + $loop->iteration }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->username }}</td>
						<td>{{ $item->email }}</td>
						<td>{{ $item->last_login }}</td>
						<td class="text-nowrap" style="width: 1%;">
							<a href="{{ route('admin.user.show', $item->id) }}" data-tooltip="ดู{{ $item->name }}" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>
							<a href="{{ route('admin.user.edit', $item->id) }}" data-tooltip="แก้ไข{{ $item->name }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>

							<form method="POST" action="{{ route('admin.user.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm del-btn" data-tooltip="ลบ{{ $item->name }}"><i class="fa-solid fa-trash-can"></i></button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-center mt-3">
			{{ $datas->withQueryString()->links() }}
		</div>
	</x-div>
@endsection
