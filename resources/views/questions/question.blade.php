<div>
	{!!$question->user->avatarImg(50,50)!!}
	<span style="font-size:25px" class="label label-default"><a style="color:white" href="/questions/{!! $question->id !!}">{!! $question->title !!}</a></span>
	<div style="background-color:#E56717"class="well">
		<div class="title">
			<!-- <span style="font-size:20px" class="label label-info">{!! $question->title !!}</span> -->
			<span class="label label-danger">{!! $question->isUrgent !!}</span>
			<span class="label label-warning">{!! $question->anonymous !!}</span>
			<span class="label label-info">{!! $question->created_at !!}</span>
		</div>

		<br>
		<div style="width:500px;background-color:" class="jumbotron">
			<!-- <span style="font-size:15px" class="label label-default">{!! $question->content !!}</span> -->
			{!! $question->content !!}
		</div>

		<div class="options">
			@foreach($question->qtags as $tag)
				<span class="label label-default">{!! $tag->name !!}</span>
			@endforeach
		</div>
		@include ('like.index' , ['likeable' => ['question', $question->id], 'likeableOb' => $question])
	</div>
</div>