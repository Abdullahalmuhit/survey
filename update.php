<?php
session_start();
require_once 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = $_POST['qrating'];
    $qid = filter_input(INPUT_GET, 'qid', FILTER_SANITIZE_STRING);
    $db = getDbInstance();
    $query = "UPDATE questions
              SET qrating =qrating+$data_to_store, ratedby=ratedby+1 where qid=$qid";
    $result = $db->query($query);
    
    if($result)
    {
        $_SESSION['success'] = "Rating added successfully!";
        header('location: home.php');
        exit();
    }  
}
    ?>
    <!DOCTYPE html>
<html>
 <head>
  <title>Crime Rating</title>
  <script src="js/ajax.js"></script>
  <link rel="stylesheet" href="style.css">
  <script src="js/script.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Crime Rating</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
    </ul>
     <ul class="nav navbar-nav">
                        <li class="dropdown">
                                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                        </li>
                    </ul>
  </div>
</nav>
    <div>
        
        <h1 style="text-align:center;">Rating added successfully!</h1>
    </div>