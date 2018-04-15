<?php use App\CategoryModel; ?>
<div class="more-menu" id="more-menu">
	<div class="block">
		<div class="ttl-ctr">
			Top Choice
		</div>
		<div class="column">
			<div class="frame-more-menu">
				<div class="fm-side">
					<a href="{{ url('/timelines') }}">
						<div class="icn btn-circle btn-main-color">
							<span class="fas fa-lg fa-newspaper"></span>
						</div>
					</a>
				</div>
				<div class="fm-main">
					<div class="ttl">Timelines</div>
				</div>
			</div>
			
			<div class="frame-more-menu">
				<div class="fm-side">
					<a href="{{ url('/fresh') }}">
						<div class="icn btn-circle btn-main-color">
							<span class="fas fa-lg fa-clock"></span>
						</div>
					</a>
				</div>
				<div class="fm-main">
					<div class="ttl">Fresh</div>
				</div>
			</div>
			
			<div class="frame-more-menu">
				<div class="fm-side">
					<a href="{{ url('/popular') }}">
						<div class="icn btn-circle btn-main-color">
							<span class="fas fa-lg fa-fire"></span>
						</div>
					</a>
				</div>
				<div class="fm-main">
					<div class="ttl">Popular</div>
				</div>
			</div>
			
			<div class="frame-more-menu">
				<div class="fm-side">
					<a href="{{ url('/trending') }}">
						<div class="icn btn-circle btn-main-color">
							<span class="fas fa-lg fa-bolt"></span>
						</div>
					</a>
				</div>
				<div class="fm-main">
					<div class="ttl">Trending</div>
				</div>
			</div>
		</div>
	</div>
	<div class="block">
		<div class="ttl-ctr">
			All Categories
		</div>
		<div class="column">
			@foreach (CategoryModel::GetCtr() as $ctr)
			<div class="frame-more-menu">
				<div class="fm-side">
					<a href="{{ url('/category/'.$ctr->title) }}">
						<div class="icn btn-circle btn-main-color">
							<span class="{{ $ctr->code }}"></span>
						</div>
					</a>
				</div>
				<div class="fm-main">
					<div class="ttl">{{ $ctr->title }}</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>