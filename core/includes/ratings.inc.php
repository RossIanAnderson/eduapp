<h4>Rate this Application</h4>	
<?php
	if(isLoggedIn()){
		if(isset($_GET['rating']) && $_GET['rating'] >= 0 && $_GET['rating'] <= 5){			
			
			$app = (int)$_GET['fullApp'];
			$user = (int)$_SESSION['user'];
			$value = (int)$_GET['rating'];
			
			if(hasUserRated($_GET['fullApp'], $_SESSION['user']) != 0){
				$query = mysql_query("UPDATE ratings SET value = $value WHERE appID = $app AND userID = $user");
			}
			else {
				$query = mysql_query("INSERT INTO ratings VALUES('','$app','$user','$value')");
			}
			
			header('Location: apps.php?fullApp=' . $app);
		}
		else {
			echo "
			<p class='rating clear'> 
				<a href='?fullApp=" . $appInfo['id'] . "&rating=5'>5</a>
				<a href='?fullApp=" . $appInfo['id'] . "&rating=4'>4</a>
				<a href='?fullApp=" . $appInfo['id'] . "&rating=3'>3</a>
				<a href='?fullApp=" . $appInfo['id'] . "&rating=2'>2</a>
				<a href='?fullApp=" . $appInfo['id'] . "&rating=1'>1</a>
			</p>
		";
		}
	}
	else {
		echo "<p>Please <a href='login.php'>Login</a> to do so.";
	}
?>
