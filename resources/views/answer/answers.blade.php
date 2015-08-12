<span style="font-size:25px" class="label label-default">Answers</span>

<br><br>
@foreach($question->answers as $answer)
	<div style="background-color:#FF2400" class="jumbotron">

		<div style="background-color:#79BAEC" class="jumbotron">
			{!! $answer->user->avatarImg(40,40) !!}
			<span style="font-size:20px" class="label label-info">{!! $answer->user->name !!} {!! $answer->user->family !!} at {!! $answer->created_at !!}</span><br>
			{!! $answer->content !!}
		</div>

		@include ('like.index' , ['likeable' => ['answer', $answer->id], 'likeableOb' => $answer])

		@include('comments.index', ['commentable' => ['answer', $answer->id], 'commentableOb' => $answer])

	</div>
	<hr>
@endforeach
