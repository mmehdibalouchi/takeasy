@extends ('app')

@section('content')
	<br>
	{{-- @include('profile.forms.professionals') --}}
	@include('profile.forms.interests')
@stop

@section('footer')
	<script>
		$('#ptags').select2({
			//no need to ; 
			//ajax : { dataType url delay}
			placeholder: 'Choose a tag',
			// tags: true
		});
		$('#itags').select2({
			//no need to ; 
			//ajax : { dataType url delay}
			placeholder: 'Choose a tag',
			// tags: true
		});
	</script>
@stop