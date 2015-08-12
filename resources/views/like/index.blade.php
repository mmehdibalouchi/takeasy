<div>
	<form class="like-class" id="{!! $likeable[0].$likeable[1] !!}">
		{!!csrf_field()!!}
		<input type="hidden" name="likeable_type" value="{!!$likeable[0]!!}">
		<input type="hidden" name="likeable_id" value="{!!$likeable[1]!!}">
		<input type="submit" name="submit-btn" style="display:inline" class="btn btn-primary" value="{!!$likeableOb->isLiked(\Auth::user()->id,true)!!}" onclick ="return likeAjaxHandler(this.form.id)">
		<span id="like-num {!! $likeable[0].$likeable[1] !!}" class="label label-warning" name="like-number" style="display:inline">{!!$likeableOb->likesNumber()!!}</span>
	</form>
</div>