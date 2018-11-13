@extends('layouts/app')

@section('content')
	<h1>
		{{ $thread->title }}
	</h1>
	<p>
		{{ $thread->body }}
	</p>
@endsection