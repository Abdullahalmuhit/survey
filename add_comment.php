<?php
$connect = new PDO('mysql:host=localhost;dbname=survey_rating', 'root', '');

$error='';

comment_content='';
if(empty($_POST["comment_content"]))
{
	$error.='<p>Message is require.</p>';
}
else
{
	$comment_content=$_POST["comment_content"];
}
if($error=='')
{
	$query="
	
	insert into comment
	(cid,comment) values (:cid, :comment)
	
	";
	$statement=$connect->prepare($query);
	$statement->execute(
	
	array(
	
	          ':cid'=> '0',
			  ':comment' => $comment_content
	)
	
	);
	$error='<p>comment added</p>';
}
else{
	echo "not added";
}

$data=array(
'error'=>$error
);

echo json_encode($data);



 ?>