<?php
session_start();
session_destroy();

if(isset($_COOKIE['uname']) && isset($_COOKIE['upassword'])){
	unset($_COOKIE['uname']);
    unset($_COOKIE['upassword']);
    setcookie('uname', null, -1, '/');
    setcookie('upassword', null, -1, '/');
}
header('Location:index.php');

 ?>