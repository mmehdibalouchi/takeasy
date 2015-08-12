// ----------------------ANSWER-AJAX HANDLER-----------------------------

	function answerAjaxHandler(formId){
		$("#"+formId).submit(function(e){
			e.preventDefault();
			var content = e.target.elements.namedItem("content").value
			var question_id = e.target.elements.namedItem("question_id").value
			var token = e.target.elements.namedItem("_token").value
			var dataString = 'content='+ content + '&_token=' + token;
			var action = "/question/" + question_id + "/answers" 
			// shouldAdd = true;
			// alert(action);
			$.ajax({
				type: "POST",
				url: action,
				data : dataString,
				dataType : "json",
				success: function(data)
				{
					$('#answers-list').append(data)
					e.target.elements.namedItem("content").value = ""
				}

			});
		});
	}

// ----------------------COMMENT-AJAX HANDLER-----------------------------

function commentAjaxHandler(event, formId)
{
		if (event.keyCode == 13) {
			event.preventDefault()
			var myForm = $("#"+formId)[0]
			var content = myForm.elements.namedItem("content").value
			var commentable_type = myForm.elements.namedItem("commentable_type").value
			var commentable_id = myForm.elements.namedItem("commentable_id").value
			var token = myForm.elements.namedItem("_token").value
			var dataString = 'content=' + content + '&_token=' + token;
			var action = "/" + commentable_type + "/" + commentable_id + "/comments"
			// alert(action)
			$.ajax({
				type: "POST",
				url: action,
				data: dataString,
				dataType: "json",
				success: function(data)
				{
					myForm.elements.namedItem("content").value = '';
					$("#"+formId+'-list').append(data)
				}
			});
		}
	}

// ----------------------LIKE-AJAX HANDLER-----------------------------

		function likeAjaxHandler(formId){
			$("#"+formId).unbind('submit').submit(function(e){
			e.preventDefault()
			var likeableType = e.target.elements.namedItem("likeable_type").value
			var likeableId = e.target.elements.namedItem("likeable_id").value

			var token = e.target.elements.namedItem("_token").value
			var dataString = '_token=' + token
			var action = "/" + likeableType + "/" + likeableId + "/likes"
			// alert(action)
			$.ajax({
				type: "POST",
				url: action,
				data : dataString,
				dataType : "json",
				success: function(data)
				{
					if(data[0] == true)
					{
						 e.target.elements.namedItem("submit-btn").value = "Liked"
					}
					else
					{
						e.target.elements.namedItem("submit-btn").value = "Like"
					}

					// $("#like-number").text(data[1])		
						var likeNum_id = "like-num " + formId
						document.getElementById(likeNum_id).innerHTML = data[1]
				}

			});
		});
	}
	