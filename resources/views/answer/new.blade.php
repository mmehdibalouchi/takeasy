<div class="answer">
	<form class="answer-class" id="question-{!!$question->id!!}" enctype="multipart/form-data">
		{!! csrf_field(); !!}
		<textarea id="answer-content" class="form-control" rows="5" name="content"></textarea>
		<input type="hidden" name="question_id" value="{{$question->id}}">
        <label for="upload_file">Upload file</label>
        <input class = "form-control" type="file" name="upload_file" value="{!! old('upload_file') !!}">
	<input class="btn btn-primary" type="submit" value="Answer" onclick="return answerAjaxHandler(this.form.id)">
	</form>
</div>
