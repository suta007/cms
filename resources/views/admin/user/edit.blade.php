@extends('layouts.app')

@section('content')
	<x-div class="fw-bold fs-5 col-12 text-web mx-auto mb-2">
		{{ __('sutamsg.edituser') }}

		<a href="{{ route('admin.user.index') }}" class="btn btn-outline-web btn-sm float-end"><i class="fa-solid fa-arrow-left me-2"></i>{{ __('sutamsg.back') }}</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="col-12 mx-auto px-5">
		@include('layouts.message')
		<form method="POST" action="{{ route('admin.user.update', $data->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<div class="row mb-3">
				<label for="name" class="col-sm-3 col-form-label text-md-end form-required">ชื่อ</label>
				<div class="col-sm-6">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" autocomplete="name" required autofocus>
					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="row mb-3">
				<label for="email" class="col-sm-3 col-form-label text-md-end">อีเมล์</label>
				<div class="col-sm-6">
					<input type="text" name="email" id="email" value="{{ old('email', $data->email) }}" class="form-control @error('email') is-invalid @enderror">
					@error('email')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>
			</div>

			<div class="row mb-3">
				<label for="type" class="col-sm-3 col-form-label text-md-end form-required">ประเภทผู้ใช้งาน</label>
				<div class="col-sm-6">
					<select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
						<option value="" selected hidden>เลือกประเภทผู้ใช้งาน</option>
						<option value="admin" @selected(old('type', $data->type) == 'admin')>ผู้ดูแลระบบ</option>
						<option value="user" @selected(old('type', $data->type) == 'user')>ผู้ใช้งาน</option>
					</select>
					@error('type')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>
			</div>

			<div class="row mb-3">
				<label for="password" class="col-sm-3 col-form-label text-md-end">Password</label>
				<div class="col-sm-6">
					<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="หากไม่ต้องการเปลี่ยนให้ว่างไว้" autocomplete="off">
					@error('password')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>
			</div>

			<div class="row col-6 mx-auto">
				<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>{{ __('sutamsg.save') }}</button>
			</div>

		</form>
	</x-div>
@endsection
