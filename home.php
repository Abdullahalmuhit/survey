<?php
require_once 'config.php';
session_start();
$db = getDbInstance();
    $query = "select * from questions";
    $result = $db->query($query);

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
<div class="col-md-12">
    <div class="container">
        <div class="row">    
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Question</th>
                        <th>Chances</th>
                        <th>Rated By</th>
                        <th>Please rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><a <a href="question.php?qid=<?php echo $row['qid']?>&operation=edit"><?php echo htmlspecialchars($row['qtitle']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['qrating']/$row['ratedby']) ?> </td>
                            <td><?php echo htmlspecialchars($row['ratedby']) ?> </td>
                            <td>
                                <form method="POST" action="update.php?qid=<?php echo $row['qid']?>&operation=edit>">
                                     <input type="text" name="qrating" v placeholder="" class="form-control" required="required" id="qrating">
                                     <button>Rate</button>

                                </form>
                               
                            </td>
                        </tr>
                    <?php endforeach; ?>  
                </tbody>
            </table>
        </div>
    </div>
</div>