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
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 col-xl-10 text-web">
		ผู้เยี่ยมชม
		<a href="{{ route('admin.viewer.create') }}" class="btn btn-web float-end mb-2">
			<i class="fa fa-plus me-2" aria-hidden="true"></i> เพิ่มผู้เยี่ยมชม
		</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12 col-xl-10">
		<form method="GET" action="{{ route('admin.viewer.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-start me-2" role="perPage">
			<div class="input-group">
				<label for="perPage" class="col-form-label me-2">จำนวน</label>
				<select name="perPage" id="perPage" class="form-select ">
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
		<form method="GET" action="{{ route('admin.viewer.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-end" role="search">
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
					<th>#</th>
					<th>Username</th>
					<th>Last Login</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datas as $item)
					<tr>
						<td class="text-nowrap text-center" style="width: 1%;">{{ $start + $loop->iteration }}</td>
						<td>{{ $item->username }}</td>
						<td>{{ $item->last_login }}</td>
						<td class="text-nowrap" style="width: 1%;">
							<a href="{{ route('admin.viewer.edit', $item->id) }}" data-tooltip="แก้ไข{{ $item->name }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
							<form method="POST" action="{{ route('admin.viewer.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
