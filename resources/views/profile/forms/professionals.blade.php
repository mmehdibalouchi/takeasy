{--
<form method="POST" action="{!! action('ProfileController@postSyncProfessionals') !!}">
	
	{!! csrf_field() !!}

	<div class="form-group">
	
		<label for="ptags">Professionals: </label>	
	
		<select class="form-control" name="ptags[]" id="ptags" multiple>
			<?php foreach($qtags as $qtag => $value)
				echo '<option value='.$qtag.' '.\Auth::user()->shouldSelectProTag($qtag).'>'.$value.'</option>';
			?>				
		</select>
	
	</div>

	<input type="submit" class="btn btn-primary">

</form>
--}