<div class="lr">
	<?php if (isLoggedIn()){ ?>
	
	<span class="avatar"><i class="fa fa-user"></i></span>
	<div class="panel">
		<?php 
			$user = getUserInfo($_SESSION['user']);
			echo "<p>Hello, " . $user['firstname'] . "!</p>"; 
		?>
		<a href="profile.php?user=<?php echo $_SESSION['user']; ?>">Profile</a>
		<a href="add.php">Add New App</a>
		<a href="logout.php">Logout</a>
	</div>
	
	<?php } else { ?>
	
	<a href="login.php" class="first">login</a>
	<a href="register.php">register</a>
	
	<?php } ?>
</div>