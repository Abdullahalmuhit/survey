<?php 
require_once 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $uname = filter_input(INPUT_POST, 'uname');
    $upassword = filter_input(INPUT_POST, 'upassword');
    $upassword=  md5($upassword);
   	
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();

    $db->where ("uname", $uname);
    $db->where ("upassword", $upassword);
    $row = $db->get('users');
     
    if ($db->count >= 1) {
        $_SESSION['user_logged_in'] = TRUE;
        header('Location:home.php');
        exit;
    } else {
        $_SESSION['login_failure'] = "Invalid user name or password";
        header('Location:login.php');
        exit;
    }
  
}