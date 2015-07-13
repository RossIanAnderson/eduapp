<?php

@$submit    = $_POST['submit'];
@$firstname = $_POST['firstname'];
@$lastname  = $_POST['lastname'];
@$password1 = $_POST['password1'];
@$password2 = $_POST['password2'];
@$email     = $_POST['email'];

if(isset($submit)){

	if(isset($firstname) && isset($lastname) && isset($password1) && isset($password2) && isset($email)){
	
		$checkemail = mysql_query("SELECT email FROM users WHERE email='$email'");
		$countemail = mysql_num_rows($checkemail);
		
		if ($countemail != 0){
			$error = "That email is already in use!";
		}
		else if (strlen($password1) > 15 || (strlen($password1) < 8)){
			$error = "Your password must be between 8 and 15 characters!";
		}
		else if ($password1 != $password2){
			$error = "Your passwords do not match";
		}
		else {
			$password = md5($password1);
						
			$register = mysql_query("INSERT INTO users VALUES('', '$firstname', '$lastname', '$password', '$email', now(), '')");
			
			require_once('core/includes/imageUpload.inc.php');

			header('Location: login.php');
		}
	}
	else {
		$error = "You must fill out all fields!";
	}
}
?>