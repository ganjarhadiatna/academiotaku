<?php use App\ProfileModel; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Academiotaku - @yield('title')</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('/img/ao4.png') }}" rel='SHORTCUT ICON'/>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/fontawesome-all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/assets.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/story.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/create.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sign.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/notifications.css') }}">

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
	<script type="text/javascript">
		var iduser = '{{ Auth::id() }}';

		function setScroll(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll');
			} else {
				$('html').removeClass('set-scroll');
			}
		}
		function opSearch(stt) {
			if (stt === 'open') {
				$('#search').fadeIn();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search').fadeOut();
				setScroll('show');
			}
		}
		function opCreateStory(stt) {
			if (stt === 'open') {
				$('#create').fadeIn();
				setScroll('hide');
			} else {
				$('#create').fadeOut();
				setScroll('show');
			}
		}
		function opToggle(stt) {
			var tr = $('#'+stt).attr('class');
			if (tr === 'toggle fa fa-lg fa-toggle-off') {
				$('#'+stt).attr('class', 'toggle tgl-active fa fa-lg fa-toggle-on');
			} else {
				$('#'+stt).attr('class', 'toggle fa fa-lg fa-toggle-off');
			}
		}
		function addBookmark(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can save this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/bookmark") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'bookmark') {
						opAlert('open', 'Story has been saved to bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fas fa-lg fa-bookmark');
					} else if (data === 'unbookmark') {
						opAlert('open', 'Story removed from bookmark.');
						$('#bookmark-'+idstory).attr('class', 'far fa-lg fa-bookmark');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to save story to bookmark.');
						$('#bookmark-'+idstory).attr('class', 'far fa-lg fa-bookmark');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to remove story from bookmark.');
						$('#bookmark-'+idstory).attr('class', 'fas fa-lg fa-bookmark');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
				})
				.fail(function(data) {
					//console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}
		function toLink(path) {
			window.location = path;
		}
		function cekNotif() {
			$.get('{{ url("/notif/cek") }}', function(data) {
				//console.log('notif: '+data);
				if (data != 0) {
					$('#main-notif-sign').show();
				} else {
					$('#main-notif-sign').hide();
				}
			});
		}
		
		function goBack() {
			window.history.back();
		}

		function toLeft() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (sc >= 0) {
				$('#ctnTag').animate({scrollLeft: (sc - wd)}, 500);
			}
		}
		function toRight() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (true) {
				$('#ctnTag').animate({scrollLeft: (sc + wd)}, 500);
			}
		}

		window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click', function(event) {
			$('#more-menu').hide();
			$('#nav-more-target').removeClass('active');
		});
		$(document).ready(function() {
			var pth = "@yield('path')";

			if (iduser) {
				setInterval('cekNotif()', 3000);
			}

			$(window).scroll(function(event) {
				var hg = $('#header').height();
				var top = $(this).scrollTop();
				if (top > hg) {
					$('#main-search').addClass('hide');
				} else {
					$('#main-search').removeClass('hide');
				}
			});

			$('#main-menu a li').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});
			
			$('#header .place .menu .pos .btn-circle').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});

			$('#place-search').submit(function(event) {
				var ctr = $('#txt-search').val();
				window.location = "{{ url('/search/') }}"+'/'+ctr;
			});

			$('#nav-more-target').on('click', function(event) {
				var tr = $(this).attr('key');
				if (tr == 'hide') {
					event.stopPropagation();
					$('#more-menu').show();
					$('#notifications').hide();
					$(this).addClass('active');
					$(this).attr('key', 'open');
				} else {
					$('#more-menu').hide();
					$(this).removeClass('active');
					$(this).attr('key', 'hide');
				}
			});

			$('#more-menu *').on('click', function(event) {
				event.stopPropagation();
				$('#more-menu').show();
				$('#notifications').hide();
				$('#nav-more-target').addClass('active');
				$('#nav-more-target').attr('key', 'open');
			});
			
		});
	</script>
</head>
<body>
	<div id="header">
		<div class="place bdr-bottom">
			<div class="menu col-all">
				<div class="pos lef">
					<div class="logo" >
						<a href="{{ url('/') }}">
							<img src="{{ asset('/img/ao2.png') }}" alt="Acedmiotaku">
						</a>
					</div>
				</div>
				<div class="pos mid" id="main-search">
					<div class="main-search bdr-all">
						<form id="place-search" action="javascript:void(0)">
							<input type="text" name="q" class="txt txt-main-color" id="txt-search" placeholder="Search.." required="true">
							<button type="submit" class="btn btn-black2-color">
								<span class="fa fa-lg fa-search"></span>
							</button>
						</form>
					</div>
				</div>
				<div class="pos rig">
					<div class="main-menu" id="nav-more">
						<ul>
							<li class="more btn-radius" id="nav-more-target" key="hide">
								<span class="ttl">Explore</span>
								<span class="fa fa-lg fa-angle-down"></span>
							</li>
						</ul>
					</div>
					@if (is_null(Auth::id()))
						<a href="{{ url('/login') }}">
							<button class="btn btn-black2-color ctn-up" id="profile">
								<span>Login</span>
							</button>
						</a>
					@endif
					@if (Auth::id())
						<button class="btn-circle btn-black2-color" id="op-notif" key="hide">
							<div class="notif-icn absolute fas fa-lg fa-circle" id="main-notif-sign"></div>
							<span class="far fa-lg fa-bell"></span>
						</button>
						@foreach (ProfileModel::UserSmallData(Auth::id()) as $dt)
						<a href="{{ url('/user/'.$dt->id) }}">
							<button class="pp btn-circle btn-black2-color" id="profile">
								<div class="image image-30px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});" id="profile"></div>
							</button>
						</a>
						@endforeach
					@endif
					<a href="{{ url('/compose') }}">
						<button class="create btn btn-main-color" id="compose">
							<span class="fas fa-lg fa-pencil-alt"></span>
						</button>
					</a>
				</div>
				@include('main.category')
				@include('main.notifications')
			</div>
		</div>
	</div>
	<div id="body">
		@yield("content")
	</div>
	<div id="footer">
		<div class="footer-place col-full">
			<div class="fo-pos fo-lef">
				<h3>Who are We ?</h3>
				<p>Penatopia is a blog site for people whos want to be a different. This site is not social media, this is micro bloging site that let you more actractive, creatif and make your brain will be more used.</p>
				<p>Penatopia is a blog site for people whos want to be a different. This site is not social media, this is micro bloging site that let you more actractive, creatif and make your brain will be more used.</p>
			</div>
			<div class="fo-pos fo-mid">
				<h3>Find Us</h3>
				<ul>
					<a href="#">
						<li>
							<span class="fab fa-lg fa-facebook"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fab fa-lg fa-instagram"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fab fa-lg fa-google-plus"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fab fa-lg fa-pinterest"></span>
						</li>
					</a>
					<a href="#">
						<li>
							<span class="fab fa-lg fa-twitter"></span>
						</li>
					</a>
				</ul>
			</div>
			<div class="fo-pos fo-rig">
				<h3>Others</h3>
				<ul>
					<a href="#">
						<li>Home</li>
					</a>
					<a href="#">
						<li>About Us</li>
					</a>
					<a href="#">
						<li>Terms & Privace</li>
					</a>
					<a href="#">
						<li>Policy</li>
					</a>
				</ul>
			</div>
		</div>
	</div>

	@include('main.loading-bar')
	@include('main.post-menu')
	@include('main.question-menu')
	@include('main.alert-menu')

</body>
</html>
