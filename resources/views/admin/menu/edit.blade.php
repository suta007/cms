@extends('layouts.app')

@section('content')
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 text-web">
		แก้ไขMenu

		<a href="{{ route('admin.menu.index') }}" class="btn btn-outline-web btn-sm float-end"><i class="fa-solid fa-arrow-left me-2"></i>กลับ</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12">
		<div class="mx-auto col-xl-6 col-md-8">
			@include('layouts.message')
			<form method="POST" action="{{ route('admin.menu.update', $data->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="row mb-3">
					<label for="ordering" class="col-sm-4 col-form-label text-md-end form-required">ลำดับ</label>
					<div class="col-sm-8">
						<input type="number" name="ordering" id="ordering" value="{{ old('ordering', $data->ordering) }}" class="form-control @error('ordering') is-invalid @enderror" required min="1" step="1">
						@error('ordering')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="parent_id" class="col-sm-4 col-form-label text-md-end form-required">เมนูหลัก</label>
					<div class="col-sm-8">
						<select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required>
							<option value="0">ไม่มีเมนูหลัก</option>
							@foreach ($datas as $item)
								<option value="{{ $item->id }}" @selected(old('parent_id', $data->parent_id) == $item->id)>{{ $item->name }}</option>
							@endforeach
						</select>
						@error('parent_id')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="name" class="col-sm-4 col-form-label text-md-end form-required">ชื่อเมนู</label>
					<div class="col-sm-8">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" autocomplete="name" required autofocus>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="route" class="col-sm-4 col-form-label text-md-end">Route</label>
					<div class="col-sm-8">
						<input type="text" name="route" id="route" value="{{ old('route', $data->route) }}" class="form-control @error('route') is-invalid @enderror">
						@error('route')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="icon" class="col-sm-4 col-form-label text-md-end">Icon</label>
					<div class="col-sm-8">
						<input type="text" name="icon" id="icon" value="{{ old('icon', $data->icon) }}" class="form-control @error('icon') is-invalid @enderror">
						@error('icon')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="guard" class="col-sm-4 col-form-label text-md-end form-required">กลุ่มผู้ใช้งาน</label>
					<div class="col-sm-8">
						<select name="guard" id="guard" class="form-select @error('guard') is-invalid @enderror">
							<option value="" @selected(old('guard', $data->guard) == '')>ทั้งหมด</option>
							<option value="admin" @selected(old('guard', $data->guard) == 'admin')>ผู้ดูแลระบบ</option>
							<option value="user" @selected(old('guard', $data->guard) == 'user')>ผู้ใช้งาน</option>
						</select>
						@error('guard')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
						@enderror
					</div>
				</div>
				<div class="row col-6 mx-auto">
					<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
				</div>
			</form>
		</div>
	</x-div>
@endsection
