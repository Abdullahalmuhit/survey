<?php
session_start();
require_once 'config.php';
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) {
    header('Location:home.php');
}
if(isset($_COOKIE['uname']) && isset($_COOKIE['upassword'])){
	$username = filter_var($_COOKIE['uname']);
	$passwd = filter_var($_COOKIE['upassword']);
	$db->where ("uname", $uname);
	$db->where ("upassword", $upassword);
    $row = $db->get('users');
    if ($db->count >= 1) {
        $_SESSION['user_logged_in'] = TRUE;
        header('Location:index.php');
        exit;
    }
    else //Username Or password might be changed. Unset cookie
    {
    unset($_COOKIE['uname']);
    unset($_COOKIE['upassword']);
    setcookie('uname', null, -1, '/');
    setcookie('upassword', null, -1, '/');
    header('Location:login.php');
    exit;
    }
}

include 'header.php';		
?>	
<!DOCTYPE html>
<html>
<head>
<title>login</title>
</style>
</head>
<body>
	<div id="main-wrapper">
		<center><h2>Login Form</h2></center>
		<div class="imgcontainer">
			<img src="imgs/avatar.png" alt="Avatar" class="avatar">
		</div>
		<form aclass="form loginform" method="POST" action="authenticate.php">
			<div class="inner_container">
				<input bgcolor="black" type="text" placeholder="Enter Username" name="uname">
				<input type="password" placeholder="Enter Password" name="upassword">
				<?php
				if(isset($_SESSION['login_failure'])){ ?>
				<div class="alert alert-danger alert-dismissable fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
				</div>
				<?php } ?>
				<button type="submit" class="login_button" >Login</button>
			</div>
		</form>
	</div>
</body>
</html>