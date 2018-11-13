@extends('layouts/app')

@section('title', 'Create')

@section('content')
	<h1>Create New Thread</h1>

	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<form method="POST" action="/threads">
		@csrf

		<div class="form-group">
			<input placeholder="Title" type="text" name="title" class="form-control" value="{{ old('title') }}">
		</div>
		<div class="form-group">
			<textarea placeholder="Body" name="body" class="form-control">{{ old('body') }}</textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-primary">Create</button>
		</div>
	</form>
@endsection