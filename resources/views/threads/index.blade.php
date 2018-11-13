@extends('layouts/app')

@section('content')
	<h1>Threads</h1>

	@foreach($threads as $thread)
		<div class="card mb-4">
		  <div class="card-body">
		    <h5 class="card-title d-flex justify-content-between">
		    	<a href="{{ $thread->path() }}">
					{{ $thread->title }}
				</a>

				<div>
					@can('update', $thread)
						<a class="btn" href="/threads/{{ $thread->id }}/edit">Edit</a>

						<form method="POST" action="{{ $thread->path() }}">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger">Delete</button>
						</form>
					@endcan
				</div>
		    </h5>
		    <h6 class="card-subtitle mb-2 text-muted">
		    	<a href="/threads/user/{{ $thread->user->id }}">{{ $thread->user->name }}</a>
		    </h6>
		    <p class="card-text">
		    	{{ $thread->body }}
		    </p>
		  </div>
		</div>
	@endforeach
@endsection