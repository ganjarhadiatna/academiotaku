<div class="frame frame-post-list">
	<div class="main">
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $story->title); 
		?>
		<div class="sd-right">
			<div class="mid">
				<div>
					<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
						{{ $story->title }}
					</a>
				</div>
				<div class="date">
					<span class="ttl-views">{{ $story->views }} Views</span>
					<span class="fas fa-lw fa-circle"></span>
					<span class="ttl-views">{{ $story->loves }} Loves</span>
					<span class="fas fa-lw fa-circle"></span>
					<span class="ttl-views">{{ $story->ttl_comment }} Comments</span>
				</div>
				<div class="date">
					<span class="ttl-views">{{ date('F d, Y h:i:sa', strtotime($story->created)) }}</span>
				</div>
			</div>
			<div class="bot">
				<div class="info">
					<a href="{{ url('/u/'.$story->id) }}">
						<div class="name">{{ $story->name }}</div>
					</a>
				</div>
			</div>
		</div>
		<div class="sd-left">
			<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
				<div class="top" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})">
					<div class="fp-post-ctr">
						{{ $story->ctrttl }}
					</div>
				</div>
			</a>
		</div>
	</div>
</div>