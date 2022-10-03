@extends('layouts.app')

@section('content')
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 col-xl-10 text-web">
		เพิ่มผู้เยี่ยมชม

		<a href="{{ route('admin.viewer.index') }}" class="btn btn-outline-web btn-sm float-end"><i class="fa-solid fa-arrow-left me-2"></i>กลับ</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12 col-xl-10">
		@include('layouts.message')
		<form method="POST" action="{{ route('admin.viewer.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label for="username" class="col-3 col-form-label text-md-end form-required">Username</label>
				<div class="col-6">
					<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="off" required autofocus>

					@error('username')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="row mb-3">
				<label for="password" class="col-3 col-form-label text-md-end form-required">Password</label>
				<div class="col-6">
					<input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="off" required>

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="row col-3 mx-auto">
				<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
			</div>

		</form>
	</x-div>
@endsection
