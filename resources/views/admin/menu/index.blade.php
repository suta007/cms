<?php
/* if (request()->page) {
    $page = request()->page;
} else {
    $page = 1;
}

if (request()->perPage) {
    $perPage = request()->perPage;
} else {
    $perPage = 25;
} */

//DESC
//$start = $datas->total() - $page * $perPage;

//ASC
//$start = ($page - 1) * $perPage;
?>

@extends('layouts.app')
@section('content')
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 text-web">
		จัดการเมนู
		<a href="{{ route('admin.menu.create') }}" class="btn btn-web float-end mb-2">
			<i class="fa fa-plus me-2" aria-hidden="true"></i> เพิ่มเมนู
		</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12">
		<div class="clearfix"></div>
		@include('layouts.message')
		<table class="table-bordered table-hover table" id="menuTable">
			<thead>
				<tr>
					<th class="text-nowrap text-center" style="width: 1%;">Order</th>
					<th class="text-nowrap text-center" style="width: 1%;">ID</th>
					<th class="text-nowrap text-center" style="width: 1%;">Parent ID</th>

					<th>Name</th>
					<th>Route</th>
					<th class="text-nowrap text-center" style="width: 1%;">Icon</th>
					<th>Guard</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datas as $item)
					<tr>
						<td class="text-center">{{ $item->ordering }}</td>
						<td class="text-center">{{ $item->id }}</td>
						<td class="text-center">{{ $item->parent_id }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->route }}</td>
						<td class="text-center"><i class="{{ $item->icon }}"></i></td>
						<td>{{ $item->guard }}</td>
						<td class="text-nowrap" style="width: 1%;">
							<a href="{{ route('admin.menu.edit', $item->id) }}" data-tooltip="แก้ไข{{ $item->name }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>

							<form method="POST" action="{{ route('admin.menu.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm del-btn" data-tooltip="ลบ{{ $item->name }}"><i class="fa-solid fa-trash-can"></i></button>
							</form>
						</td>
					</tr>
					@if (isset($item->childs))
						@foreach ($item->childs as $item2)
							<tr>
								<td class="text-center">{{ $item2->ordering }}</td>
								<td class="text-center">{{ $item2->id }}</td>
								<td class="text-center">{{ $item2->parent_id }}</td>
								<td>{{ $item2->name }}</td>
								<td>{{ $item2->route }}</td>
								<td class="text-center"><i class="{{ $item2->icon }}"></i></td>
								<td>{{ $item2->guard }}</td>
								<td class="text-nowrap" style="width: 1%;">
									<a href="{{ route('admin.menu.edit', $item2->id) }}" data-tooltip="แก้ไข{{ $item2->name }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>

									<form method="POST" action="{{ route('admin.menu.destroy', $item2->id) }}" accept-charset="UTF-8" style="display:inline">
										@method('DELETE')
										@csrf
										<button type="submit" class="btn btn-danger btn-sm del-btn" data-tooltip="ลบ{{ $item2->name }}"><i class="fa-solid fa-trash-can"></i></button>
									</form>
								</td>
							</tr>
						@endforeach
					@endif
				@endforeach
			</tbody>
		</table>
		<div class="d-flex justify-content-center mt-3">
			{{-- $datas->withQueryString()->links() --}}
		</div>
	</x-div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			$('#menuTable').DataTable({
				"order": [
					[2, 'asc'],
					[0, 'asc']
				],
				"pageLength": 100,
			});
		});
	</script>
@endsection
