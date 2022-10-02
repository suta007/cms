@extends('layouts.app')

@section('content')
	<x-div class="fw-bold fs-5 col-12 text-web mx-auto mb-2">
		เปลี่ยนรหัสผ่าน
	</x-div>
	<div class="clearfix"></div>
	<x-div class="col-12 mx-auto px-5">
		@include('layouts.message')
		<div class="col-md-8 mx-auto">
			<form method="POST" action="{{ route('user.main.updatepass') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="row mb-3">
					<div class="col-md-4 text-md-end">ชื่อผู้ใช้งาน</div>
					<div class="col-md-6">{{ $data->username }}</div>
				</div>

				<div class="row mb-3">
					<label for="current_password" class="col-md-4 col-form-label text-md-end">รหัสผ่านปัจจุบัน</label>

					<div class="col-md-6">
						<input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

						@error('current_password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="password" class="col-md-4 col-form-label text-md-end">รหัสผ่านใหม่</label>

					<div class="col-md-6">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" required>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="password_confirmation" class="col-md-4 col-form-label text-md-end">ยืนยันรหัสผ่านใหม่</label>

					<div class="col-md-6">
						<input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" minlength="8" required>
					</div>
				</div>

				<div class="row col-6 mx-auto">
					<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
				</div>

			</form>
		</div>
	</x-div>
@endsection
