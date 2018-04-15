@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div>
	<div class="top-banner grid grid-2x">
		<div class="tb-main grid-1">
			@foreach ($topStory as $story)
				<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
					<div class="frame-image" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})">
						<div class="cover">
							<div class="padding-bottom-10px">
								<label class="tag btn-main-color">{{ $story->ctrttl }}</label>
							</div>
							<div class="mn-title ctn ctn-sans-serif">{{ $story->title }}</div>
						</div>
					</div>
				</a>
			@endforeach
		</div>

		<?php $i = 1; ?>
		<div class="tb-side grid-2">
			@foreach ($topAllStory as $story)
				<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
					<div class="frame-image" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})">
						<div class="cover">
							<div class="padding-bottom-10px">
								<label class="tag btn-main-color">{{ $story->ctrttl }}</label>
							</div>
							<div class="mn-title2 ctn ctn-sans-serif">{{ $story->title }}</div>
						</div>
					</div>
				</a>
				<?php $i += 1; ?>
			@endforeach
		</div>
	</div>
</div>
<div class="frame-home">
	<div class="col-full">
		<div id="home-primary-object">
			@if (!Auth::id())
			<div class="padding-20px">
				<div class="frame-adds center">
					<div class="padding-bottom-10px">
						<h3>Join with us and be Student at Academiotaku.</h3>
					</div>
					<div class="padding-20px">
						<a href="{{ url('/login') }}">
		                    <input type="button" name="signup" class="mrg-bottom btn btn-main-color" value="Login">
		                </a>
						<a href="{{ url('/register') }}">
		                    <input type="button" name="signup" class="btn btn-main2-color" value="Register">
		                </a>
		            </div>
				</div>
			</div>
			@else
				@if (count($timelinesStory) != 0)
					<div class="block">
						<div class="padding-20px">
							<div class="need-mrg-left ttl-main-color">
								<label class="ctn-up">Timelines</label>
							</div>
							<div class="post">
								<?php $i = 1; ?>
								@foreach ($timelinesStory as $story)
									@if ($i <= 4)
										@include('main.post-list')
									@else
										@include('main.post')
									@endif
									<?php $i += 1; ?>
								@endforeach
							</div>
						</div>
					</div>
				@endif
			@endif
			<div class="block">
				<div class="padding-20px">
					<div class="need-mrg-left ttl-main-color">
						<label class="ctn-up">Fresh</label>
					</div>
					<div class="post">
						<?php $i = 1; ?>
						@foreach ($newStory as $story)
							@if ($i <= 4)
								@include('main.post-list')
							@else
								@include('main.post')
							@endif
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
			<div class="block">
				<div class="padding-20px">
					<div class="need-mrg-left ttl-main-color">
						<label class="ctn-up">Populars</label>
					</div>
					<div class="post">
						<?php $i = 1; ?>
						@foreach ($popularStory as $story)
							@if ($i <= 4)
								@include('main.post-list')
							@else
								@include('main.post')
							@endif
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
			<div class="block">
				<div class="padding-20px">
					<div class="need-mrg-left ttl-main-color">
						<label class="ctn-up">Trandings</label>
					</div>
					<div class="post post-2">
						<?php $i = 1; ?>
						@foreach ($trendingStory as $story)
							@if ($i <= 4)
								@include('main.post-list')
							@else
								@include('main.post')
							@endif
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection