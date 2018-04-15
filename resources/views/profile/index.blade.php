@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#post-nav ol li').each(function(index, el) {
			$(this).removeClass('active');
			$('#{{ $nav }}').addClass('active');
		});
	});
</script>
@foreach ($profile as $p)
<div class="sc-header">
	<div class="sc-place pos-fix">
		<div class="col-small">
			<div class="sc-grid sc-grid-2x">
				<div class="sc-col-1">
					<h2 class="ttl-head ttl-sekunder-color">Profile</h2>
				</div>
				<div class="sc-col-2 txt-right">
					@if (Auth::id() == $p->id)
						<a href="{{ url('/me/setting') }}">
							<button class="btn-circle btn-primary-color">
								<span class="fas fa-lg fa-cog"></span>
							</button>
						</a>
						<a href="{{ url('/me/setting/profile') }}">
							<button class="btn-circle btn-primary-color">
								<span class="fas fa-lg fa-pencil-alt"></span>
							</button>
						</a>
					@endif
					@if (Auth::id() == $p->id)
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
						<a href="{{ route('logout') }}" 
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							<button class="btn-circle btn-primary-color">
								<span class="fas fa-lg fa-power-off"></span>
							</button>
						</a>
					@else
						@if (!is_int($statusFolow))
							<input type="button" name="edit" class="btn btn-main2-color" id="add-follow-{{ $p->id }}" value="Follow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
						@else
							<input type="button" name="edit" class="btn btn-main-color" id="add-follow-{{ $p->id }}" value="Unfollow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<div class="frame-home frame-profile">
	<div class="block pp-top">
			<div class="profile">
				<div class="foto" id="place-picture" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});">
					<div id="change">
						<input type="file" name="change-picture" id="change-picture" onchange="loadFoto()">
						<label for="change-picture">
							<div class="btn btn-primary-color" id="btn-save-foto">
								<span class="fa fa-lg fa-camera"></span>
							</div>
						</label>
					</div>
				</div>
				<div class="info">
					<h1 id="edit-name">{{ $p->name }}</h1>
					<div>
						<p id="edit-about">{{ $p->about }}</p>
					</div>
					<div class="other">
						<a href="{{ $p->website }}" target="_blank">{{ $p->website }}</a>
					</div>
					<div class="">
						<div class="padding-15px other mrg-bottom">
							<ul>
								<li>
									<a href="{{ url('/user/'.$p->id.'/story') }}">
										<div class="val">{{ $p->ttl_story }}</div>
										<div class="ttl">Stories</div>
									</a>
								</li>
								<li>
									<a href="{{ url('/user/'.$p->id.'/following') }}">
										<div class="val">{{ $p->ttl_following }}</div>
										<div class="ttl">Following</div>
									</a>
								</li>
								<li>
									<a href="{{ url('/user/'.$p->id.'/followers') }}">
										<div class="val">{{ $p->ttl_followers }}</div>
										<div class="ttl">Followers</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="post-nav width-small" id="post-nav">
		<ol>
			<a href="{{ url('/user/'.$p->id.'/story') }}"><li class="active" id="story">All Stories</li></a>
		    <a href="{{ url('/user/'.$p->id.'/bookmark') }}"><li id="bookmark">Bookmarks</li></a>
		</ol>
	</div>
	<div class="block pp-bot col-full">
		<div class="padding-5px"></div>
		<div class="post">
			@if (count($userStory) == 0)
				@include('main.post-empty')	
			@else
				@foreach ($userStory as $story)
					<a href="#">
						@include('main.post')
					</a>
				@endforeach
				{{ $userStory->links() }}
			@endif
		</div>
	</div>
</div>
@endforeach
@endsection