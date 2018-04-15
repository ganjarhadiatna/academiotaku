@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="col-full">
		<div class="block">
			<div class="post-grid">
				<div class="lef">
					@foreach ($allStory as $story)
					@include('main.post-list')
					@endforeach
				</div>
				<div class="rig">
					<div class="follow mg-bottom place-follow">
						<h3>Who to Follows</h3>
						<ul>
							@foreach($topUsers as $usr)
							<li>
								<a href="{{ url('/user/'.$usr->id) }}">
									<span style="background-image: url({{ asset('/profile/thumbnails/'.$usr->foto) }});" class="foto"></span>
								</a>
								<span class="info">
									<a href="{{ url('/user/'.$usr->id) }}">
										{{ $usr->name }}
									</a>
								</span>
								<div class="flw-btn">
									@if ($usr->id != Auth::id())
										@if (is_int($usr->is_following))
											<input type="button" name="follow" class="btn btn-main2-color" id="add-follow-{{ $usr->id }}" value="Unfollow" onclick="opFollow('{{ $usr->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
										@else
											<input type="button" name="follow" class="btn btn-main2-color" id="add-follow-{{ $usr->id }}" value="Follow" onclick="opFollow('{{ $usr->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
										@endif
									@endif
								</div>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="padding-5px"></div>
					<div class="follow place-tranding">
						<h3>Tranding Nows</h3>
						<ul>
							@foreach($topTags as $tag)
							<?php 
								$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
								$title = str_replace($replace, '', $tag->tag); 
							?>
							<li class="tag">

								<div class="ttl-head">
									<a href="{{ url('/tags/'.$title) }}">
										{{ $tag->tag }}
									</a>
								</div>
								<div class="ttl-ctn">{{ $tag->ttl_tag }} Stories</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="post">
				@foreach ($allStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<h2>Top 9 Stories</h2>
			<div class="post">
				@foreach ($topStory9 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<h2>Popular</h2>
			<div class="post post-2">
				@foreach ($popularStory as $story)
				@include('main.post-list')
				@endforeach
			</div>
			<div class="post">
				@foreach ($popularStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<h2>Most Views</h2>
			<div class="post post-2">
				@foreach ($trendingStory as $story)
				@include('main.post-list')
				@endforeach
			</div>
			<div class="post">
				@foreach ($trendingStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection