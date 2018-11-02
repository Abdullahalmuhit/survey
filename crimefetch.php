<?php

//fetch.php

$connect = new PDO('mysql:host=localhost;dbname=survey_rating', 'root', '');

$query = "
SELECT * FROM question ORDER BY id ASC
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $rating = count_rating($row['id'], $connect);
 $color = '';
 $output .= '
 <h3 class="text-primary">'.$row['question_name'].'</h3>
 <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
 ';
 
 for($count=1; $count<=5; $count++)
 {
  if($count <= $rating)
  {
   $color = 'color:#ffcc00;';
  }
  else
  {
   $color = 'color:#ccc;';
  }
  $output .= '<li title="'.$count.'" id="'.$row['id'].'-'.$count.'" data-index="'.$count.'"  data-question_id="'.$row['id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:16px;">&#9733;</li>';
 }
 
 $output .= '
<form method="POST" id="comment_form">
<input type="hidden" name="fid" value="">
comment: <textarea name="comment_content" id="comment_content" rows="5" cols="40"></textarea>
<input type="submit" name=-"submit" id="submit" value="submit">

</form>
<span id="comment_message"></span>
<div id="display_comment"></div>
.</ul><p style="color:green"><b>'.$row["comment"].'</b></p><hr />';
 
}
echo $output;

function count_rating($question_id, $connect)
{
 $output = 0;
 $query = "SELECT AVG(rating) as rating FROM rating WHERE question_id = '".$question_id."'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);
  }
 }
 return $output;
}


?>
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
