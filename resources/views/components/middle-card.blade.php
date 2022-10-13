<div class="d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 70px);">
	<div {{ $attributes->merge(['style' => 'width:400px', 'class' => 'rounded bg-white p-4 shadow']) }}>
		{{ $slot }}
	</div>
</div>
