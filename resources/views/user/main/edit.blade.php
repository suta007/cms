@extends('layouts.app')

@section('content')
	<x-div class="fw-bold fs-5 col-12 text-web mx-auto mb-2">
		<i class="fa-solid fa-user me-2"></i>แก้ไขข้อมูลส่วนตัว
	</x-div>
	<div class="clearfix"></div>
	<x-div class="col-12 mx-auto px-5">
		@include('layouts.message')
		<div class="col-md-8 mx-auto">
			<form method="POST" action="{{ route('user.main.update', $data->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
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

				<div class="row col-6 mx-auto">
					<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
				</div>

			</form>
		</div>
	</x-div>
@endsection
