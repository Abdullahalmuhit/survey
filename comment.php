<p>Please Give your opinion</p>
<form method="POST" id="comment_form">
<input type="hidden" name="fid" value="">
comment: <textarea name="comment_content" id="comment_content" rows="5" cols="40"></textarea>
<input type="submit" name=-"submit" id="submit" value="submit">

</form>
<span id="comment_message"></span>
<div id="display_comment"></div>

<script>
$(document).ready(function(){
	
	$('#comment_form').on('submit' , function(event){
		event.preventDefault();
		var form_data= $(this).serialize();
		$.ajax({
			url:"add_comment.php",
			method:"POST",
			data:form_data,
			dataType:"JSON",
			success:function(data)
			{
				if(data.error !='')
				{
					
					$('#comment_form')[0].reset();
					$('#comment_message').html(data.error);
				}
			}
		})
		
	});
	
});
</script>
