@extends('app')

@section('content')
	<br>
	<span style ="font-size:30px" class="label label-default">Tag List</span>
	<hr>
	<!-- <form method="LINK" action="/tags/create" style ="display:inline">
		<input class="btn btn-primary" type="submit" value="Add">
	</form>
	<br><br> -->

		<form method="POST" action="/tags">
	{!! csrf_field() !!}
	<div class="form-group">
		<span class="label label-default">new tag</span>
		<input class=""type="text" name="name">
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Add Tag">
	</div>
	
	</form>
	<hr>
	@foreach ($qtags as $tag)

	<div class="row">
	    
	    <div class="col-sm-4" style="background-color:lavender;">
			<span style="font-size:25px" class="label label-info">{!! $tag->name !!}</span>
		</div>
		
		<div class="col-sm-8" style="background-color:lavenderblush;">
			
			<form method="POST" action="{!! route('tags.destroy',$tag->id) !!}" style ="display:inline">
				{!! csrf_field(); !!}
				<input type="hidden" name="_method" value="DELETE">
				<input style ="display:inline" class="btn btn-danger" type="submit" value="Delete">
			</form>

			<form method="LINK" action="/tags/{!! $tag->id !!}/edit" style ="display:inline">
				<input class="btn btn-warning" type="submit" value="Edit">
			</form>
		
		</div>
	</div>

	<br><br>
	@endforeach
@stop