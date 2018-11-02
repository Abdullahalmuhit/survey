<?php
	include_once 'config.php';
    $db = getDbInstance();
	if(!$db){
		echo "database error";
	}
	$uname=$ufullname=$uphone=$uaddress=$upassword="";
	$name=$fullname=$phone=$address=$password="";
	$errors="";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(empty($_POST["uname"])){
			$name="user name is required";
			$errors=1;
		}
		else{
			$uname=$_POST['uname'];
         	if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
      			$name = "Only letters and white space allowed"; 
			}
		}
		if(empty($_POST['upassword'])){
			$password="password is required";
			$errors=1;
		}
		else{
			$upassword=md5($_POST['upassword']);
		}
		if(empty($_POST['ufullname'])){
		   	$fullname="Full name is required";
			$errors=1;
		}
		else{
			$ufullname=$_POST['ufullname'];
			
		}
		if(empty($_POST['uphone'])){
			$phone="phone no is required";
			$errors=1;
		}
		else{
			$uphone=$_POST['uphone'];
		}
		if(!$db){
			echo "database error";
		}
		if(isset($_POST['register'])){
			if($errors ==0){
				$query="select uname from users where uname='$uname'";
				$result = $db->query($query);
				if($result==$uname){
						echo "Username already exist";
				}
				else{
					$query="INSERT INTO users(uid,uname,ufullname,uphone,uaddress,upassword) VALUES ('','$uname','$ufullname','$uphone','$uaddress','$upassword')";
					$result = $db->query($query);
						$_SESSION['uname'] = $uname;
						$_SESSION['upassword'] = $upassword;
						header("location: login.php");	
				}
			}
		}
	}
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>	  
</head>
<body>
	<div id="main-wrapper">
	<center><h2>Sign Up Form</h2></center>
		<form  method="post" action="<?php
		echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<span class="error">All field is required</span></br></br>
 				<input type="text" name="uname" placeholder="User name" autocomplete="on"/> <br>
 				<span class="error">
 				<?php
				  	if(isset($_POST['uname'])){
						echo "$name"; 
				  }
 				?>
 				</span>
 				</br>
				<input type="text" name="ufullname" placeholder="Full name" autocomplete="on"/> <br>
				<span class="error">
				<?php
				  	if(isset($_POST['ufullname'])){
					  echo "$fullname";  
				  	}
				?>
				</span>
				</br>
				<input type="text" name="uphone" placeholder="0177695276" autocomplete="off"  autocomplete="on" /> <br>
				<span class="error">
				<?php
					if(isset($_POST['uphone'])){
						echo "$phone";  
				  	}
				?>
				</span>
				</br>
				<input type="text" name="uaddress" placeholder="Dhanmondi" autocomplete="off"  autocomplete="on" /> <br>
				<span class="error">
				<?php
					if(isset($_POST['uaddress'])){
						echo "$address";  
				  	}
				?>
				</span>
				</br>
				<input type="Password" name="upassword" placeholder="*******" autocomplete="on"/> <br>
				<span class="error">
				<?php
					if(isset($_POST['upassword'])){
					  echo "$password";  
				  	}
				 ?>
				</span>
				</br>
				<button name="register" class="sign_up_btn" type="submit">Sign Up</button>
			</div>
		</form>			
	</div>
</body>
</html>