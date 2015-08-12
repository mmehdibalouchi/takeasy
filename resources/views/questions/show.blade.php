@extends ('app')

@section('content')

@include ('questions.question')

@include('comments.index', ['commentable' => ['question', $question->id], 'commentableOb' => $question])
						<!-- NEW ANSWER PART -->
<div style="background-color:#4CC417" class="well">
	<br>
	{!!Auth::user()->avatarImg(70,70)!!}
	<br><br>
	@include ('answer.new')
	<br>
</div>

						<!-- ALL ANSWER PART -->

<div id="answers-list" style="background-color:#6CC417" class="well">
	@include('answer.answers')
</div>
@stop