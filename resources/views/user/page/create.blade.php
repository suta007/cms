@extends('layouts.app')

@section('content')
	<x-div class="mx-auto fw-bold fs-5 mb-2 col-12 text-web">
		{{ __('sutamsg.addwebpage') }}

		<a href="{{ route('user.page.index') }}" class="btn btn-outline-web btn-sm float-end"><i class="fa-solid fa-arrow-left me-2"></i>{{ __('sutamsg.back') }}</a>
	</x-div>
	<div class="clearfix"></div>
	<x-div class="mx-auto px-5 col-12">
		@include('layouts.message')
		<form method="POST" action="{{ route('user.page.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
			@csrf
			<div class="row mb-2">
				<label for="name" class="col-form-label form-required">ชื่อหน้าเว็บ</label>
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus>
				@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="row mb-2">
				<label for="content" class="col-form-label">เนื้อหา</label>
				<textarea name="content" id="content"></textarea>
			</div>

			<div class="row col-6 mx-auto">
				<button type="submit" class="btn btn-web py-3"><i class="fa-solid fa-floppy-disk me-2"></i>บันทึก</button>
			</div>
		</form>
	</x-div>
	<script>
		var token = '{{ csrf_token() }}';
	</script>
@endsection

@section('scriptfile')
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('js/mytunymce.js') }}"></script>
@endsection
