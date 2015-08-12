@extends('app')

@section('content')

	<form method="POST" action="/questions" enctype="multipart/form-data">
		
		{!! csrf_field() !!}
		<h3>Ask new Question</h3>
		<div class="form-group">
			<label for="title">Title</label>
			<input class="form-control" type="text" name="title">
		</div>

		<div class="form-group">
			<label for="content">Question: </label>
			<textarea class="form-control" rows="10" name="content"></textarea>
		</div>

		<div class="form-group">
			<label for="qtags">Tags: </label>	
			<select class="form-control" name="qtags[]" id="qtags" multiple>

				<?php foreach($qtags as $qtag => $value)
					echo '<option value='.$qtag.'>'.$value.'</option>';
				?>
				
			</select>
		</div>
		
		<div class="form-group">
            <label for="Anonymous">Anonymous</label>
            <input class="form" type="checkbox" name="anonymous"  value=1>
        </div>

        <div class="form-group">
            <label for="isUrgent">Urgent</label>
            <input class="form" type="checkbox" name="isUrgent"  value=1>
        </div>

        <div class="form-group">
            <label for="upload_file">Upload file</label>
            <input class = "form-control" type="file" name="upload_file" value="{!! old('upload_file') !!}">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Ask Question">
        </div>

	</form>

	@include('errors.list')

@stop

@section('footer')
	<script>
		$('#qtags').select2({
			//no need to ; 
			//ajax : { dataType url delay}
			placeholder: 'Choose a tag',
			// tags: true
		});
	</script>
@stop