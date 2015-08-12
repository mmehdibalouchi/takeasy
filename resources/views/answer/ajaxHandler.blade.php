<script>

	$("document").ready(function(){
		$("#answer_form").submit(function(e){
			e.preventDefault();
			var content = $("textarea[name=content]").val();
			var question_id = $("input[name=question_id]").val();
			var token = $("input[name=_token]").val();
			var dataString = 'content='+ content + '&question_id=' + question_id + '&_token=' + token;

			$.ajax({
				type: "POST",
				url: "/answer/add-answer",
				data : dataString,
				dataType : "json",
				success: function(data)
				{
					document.getElementById("answer-content").value = ''
					$('#answers-list').append(data)
				}

			});
		});
	});
$("#comment").keyup(function(event){
	if(event.keyCode == 13){
		alert('I love java script');
	}
});
</script>