<script>

		$(document).ready(function() {
			$('#new-comment').keydown(function(e) {
			if (event.keyCode == 13) {
				e.preventDefault();
				var content = $("input[name=content]").val()
				var user_id = $("input[name=user_id]").val()
				var question_id = $("input[name=question_id]").val()
				var token = $("input[name=_token]").val()
				var dataString = 'content=' + content + '&user_id=' + user_id + '&question_id=' + question_id + '&_token=' + token;
				$.ajax({
					type: "POST",
					url: "/comments",
					data: dataString,
					dataType: "json",
					success: function(data)
					{
						document.getElementById("new-comment").value = '';
						$('#comments-list').append(data)
					}
				})
			}
		})
	})
</script>