<?php

//fetch.php

$connect = new PDO('mysql:host=localhost;dbname=survey_rating', 'root', '');

if(isset($_POST["index"], $_POST["question_id"]))
{
 $query = "INSERT INTO rating(question_id, rating) VALUES (:question_id, :rating)";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':question_id'  => $_POST["question_id"],
   ':rating'   => $_POST["index"]
  )
 );
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'done';
 }
}


?>