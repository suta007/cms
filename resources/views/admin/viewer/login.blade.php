@extends('layouts.guest')

@section('content')
	<x-middle-card>
		<div class="text-center">
			<img src="{{ asset('images/logo.png') }}" style="height:150px;">
			<div class="h4 fw-bold mt-3">
				{{ __('Log in') }}
			</div>
			<div class="h6 fw-bold mt-1">
				เพื่อเข้าถึงแฟ้มสะสมงานออนไลน์<br>
				กฤษฎาพงษ์ สุตะ
			</div>
		</div>
		@if ($message = Session::get('error'))
			<div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
				<small>{{ $message }}</small>
				<button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		<div class="mt-4 px-5">
			<form method="POST" action="{{ route('viewer.auth') }}">
				@csrf
				<div class="mb-3">
					<label for="username" class="form-label">{{ __('Username') }}</label>
					<input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}" autocomplete="username" required autofocus>
					@error('username')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">{{ __('Password') }}</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" value="{{ old('password') }}" autocomplete="password" required autofocus>
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="mb-0 text-center">
					<button type="submit" class="btn btn-dark py-2 px-4 ">
						{{ __('Log in') }}
					</button>
				</div>
			</form>
		</div>
	</x-middle-card>
@endsection
