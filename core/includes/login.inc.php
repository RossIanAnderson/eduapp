<?php
	@$submit = $_POST['submit'];
	@$email = $_POST['email'];
	@$password = md5($_POST['password']);
		
	if(isset($submit)){
		if($email && $password){
			$query = mysql_query("SELECT * FROM users WHERE email='$email' and password='$password'");
			$num_rows = mysql_num_rows($query);
			if($num_rows == 1){
				while ($row = mysql_fetch_assoc($query)){
					$ID = $row['id'];
					$dbemail = $row['email'];
					$dbpassword = $row['password'];
					$blocked = $row['blocked'];
				}
				if(($email===$dbemail) && ($password===$dbpassword)){
					if($blocked == 0) {
						$_SESSION['user'] = $ID;
						header("Location: profile.php?user=" . $ID );
					}
					else {
						header("Location: suspended.php");
					}
				}
				
			}
			else {
				$error = "The username, password or both are incorrect!";
			}
		}
		else {
			$error = "Please fill in both fields!";
		}
	}
?>

