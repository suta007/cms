<div class="sidebar col bg-white p-2 shadow-md" id="sidebar">
	<a href="/" class="d-flex align-items-center mb-md-0 me-md-auto text-decoration-none text-web ms-3 mb-3">
		<img src="{{ asset('images/logo.png') }}" style="height: 48px;">
		<span class="ms-3 fs-5 fw-bold">{{ config('app.name', 'Laravel') }}</span>
	</a>
	<hr>

	<ul class="list-unstyled ps-0">
		<li class="mb-1">
			<button class="btn btn-toggle align-items-center collapsed rounded text-start d-block" data-bs-toggle="collapse" data-bs-target="#collapse-user" aria-expanded="false">
				<i class="fa-solid fa-user-circle me-2"></i>
				{{ Auth::user()->name }}<i class="fa-solid fa-caret-down mt-1 me-1 float-end"></i>
			</button>
			<div class="collapse" id="collapse-user">
				<ul class="btn-toggle-nav list-unstyled fw-normal small pb-1">
					<li>
						<a class="navlink ps-4 mb-1 rounded py-2" href="{{ route('user.main.edit') }}"><i class="fa-solid fa-user me-2"></i>แก้ไขข้อมูลส่วนตัว</a>
					</li>
					<li>
						<a class="navlink ps-4 mb-1 rounded py-2" href="{{ route('user.main.editpass') }}"><i class="fa-solid fa-key me-2"></i>เปลี่ยนรหัสผ่าน</a>
					</li>
					<li>
						<a class="navlink ps-4 mb-1 rounded py-2" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-to-bracket me-2"></i>ออกจากระบบ</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</li>

				</ul>
			</div>
		</li>
		<?php
		$menu = SutaMenu();
		?>
		@foreach ($menu as $item)
			<?php
			if (empty($item->guard)) {
			    $guardcheck = true;
			} else {
			    $guardcheck = Role($item->guard);
			}
			?>

			@if ($guardcheck)
				<li class="mb-1">
					@if (empty($item->route))
						<button class="btn btn-toggle align-items-center collapsed rounded text-start d-block" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
							@if ($item->icon)
								<i class="{{ $item->icon }} me-2"></i>
							@endif
							{{ $item->name }}<i class="fa-solid fa-caret-down mt-1 me-1 float-end"></i>
						</button>
						@if (isset($item->childs))
							<div class="collapse" id="collapse-{{ $item->id }}">
								<ul class="btn-toggle-nav list-unstyled fw-normal small pb-1">
									@foreach ($item->childs as $item2)
										<li><a href="{{ route($item2->route) }}" class="link-dark rounded align-items-center">
												@if ($item2->icon)
													<i class="{{ $item2->icon }} me-2"></i>
												@endif
												{{ $item2->name }}
											</a></li>
									@endforeach
								</ul>
							</div>
						@endif
					@else
				<li>
					<a href="{{ route($item->route) }}" class="navlink mb-1 rounded align-items-center">
						@if ($item->icon)
							<i class="{{ $item->icon }} me-2"></i>
						@endif
						{{ $item->name }}
					</a>
				</li>
			@endif
			</li>
		@endif
		@endforeach

	</ul>
</div>
