@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<p class="text-center"><strong>RSS Feed</strong></p>
						<span>
						@foreach($wordStats as $word => $counter)
							<strong>{{ $word }}</strong><small>({{ $counter }})</small> |
						@endforeach
						</span>
					</div>

					<div class="card-body">
						@foreach($feeds as $feed)
							<div class="rss-element">
								<h3><a href="{{ $feed['link'] }}">{{ $feed['title'] }}</a></h3>
								<h5>by {{ $feed['author'] }}</h5>
								<p>{{ $feed['summary'] }}</p>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
