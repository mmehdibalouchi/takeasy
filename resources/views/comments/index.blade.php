<div class="comments">

					<!-- NEW COMMENT PART -->
	<div class="new_comment">
		<br>
		<span style="font-size:18px" class="label label-success">Comments</span>
		<br>

		<form id="comment-{!!$commentable[0].$commentable[1]!!}" autocomplete="off">
			{!! csrf_field(); !!}
			<input class="form-control" id="new-comment" type="text" name="content" onkeydown="commentAjaxHandler(event, this.form.id)">
			<input type="hidden" name="commentable_type" value="{!!$commentable[0]!!}">
			<input type="hidden" name="commentable_id" value="{!!$commentable[1]!!}">
		</form>

	</div>
					<!-- ALL COMMENT PART -->
	<div id="comment-{!!$commentable[0].$commentable[1]!!}-list" style="background-color:#79BAEC"class="show-comments well">
		@foreach($commentableOb->comments as $comment)
			<p style="font-size:12px">{!!$comment->user->name!!}: {!!$comment->content!!}</p>
		@endforeach
	</div>
</div>
