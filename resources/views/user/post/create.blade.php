@extends('layouts.app')

@section('content')
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 text-web">
		เพิ่มPost

		<a href="{{ route('user.post.index') }}" class="btn btn-outline-web btn-sm float-end"><i class="fa-solid fa-arrow-left me-2"></i>กลับ</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12">
		@include('layouts.message')
		<form method="POST" action="{{ route('user.post.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label for="name" class="col-3 col-form-label text-md-end form-required">ชื่อPost</label>
				<div class="col-9">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus>

					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="row col-6 mx-auto">
				<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
			</div>

		</form>
	</x-div>
@endsection
