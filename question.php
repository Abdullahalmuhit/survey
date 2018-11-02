<?php
session_start();
require_once 'config.php';

// Sanitize if you want
$qid = filter_input(INPUT_GET, 'qid', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $qid = filter_input(INPUT_GET, 'qid', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    $db->where('qid',$qid);
    $stat = $db->update('questions', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Transport updated successfully!";
        //Redirect to the listing page,
        header('location: index.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('qid', $qid);
    //Get data to pre-populate the form.
    $question = $db->getOne("questions");
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
<div id="page-wrapper">
    <div class="row">
        <h2 style="text-align: center;"" class="page-header"><?php echo $question['qtitle']?></h2>
        <h3 style="text-align: center;"" class="page-header"><?php echo $question['qarea']?></h3>
        <h3 style="text-align: center;"" class="page-header">Rating:<?php echo $question['qrating']/$question['ratedby']?></h2>
        <h4 style="text-align: center;"" class="page-header">Rated by:<?php echo $question['ratedby']?></h2>
    </div>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
        <fieldset>
    <div class="form-group">
         <textarea name="comment" class="form-control" rows="5" id="comment"></textarea>
    </div> 
    
    
    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Comment <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
    </form>
</div>