@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home col-full">
	<div class="post">
		@if (count($topStory) == 0)
			@include('main.post-empty')	
		@else
			@foreach ($topStory as $story)
				<a href="#">
					@include('main.post')
				</a>
			@endforeach
			{{ $topStory->links() }}
		@endif
	</div>
</div>
@endsection