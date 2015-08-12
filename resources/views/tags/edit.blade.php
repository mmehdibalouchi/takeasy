@extends('app')

@section('content')

	<h3>Creaete New Tag</h3>
	<form method="POST" action="/tags/{!! $tag->id !!}">

		{!! csrf_field(); !!}
		<input type="hidden" name="_method" value="PUT">
		<div class="form-group">
			<label for="name">Name</label>
			<input class="form-control "type="text" value="{!! $tag->name !!}" name="name">
		</div>

		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Edit Tag">
		</div>
	
	</form>

@stop