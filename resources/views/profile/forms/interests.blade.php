<form method="POST" action="{!! action('ProfileController@postSyncInterests') !!}">
	
	{!! csrf_field() !!}
	
	<div class="form-group">

		<label for="itags">Interests: </label>	
	
		<select class="form-control" name="itags[]" id="itags" multiple>
			<?php foreach($qtags as $qtag => $value)
				echo '<option value='.$qtag.' '.\Auth::user()->shouldSelectInterestsTag($qtag).'>'.$value.'</option>';
			?>				
		</select>
	
	</div>

	<input type="submit" class="btn btn-primary">

</form>