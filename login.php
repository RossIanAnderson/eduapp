<?php
	$title = 'EduApp - Login';
	require_once('core/includes/overall/header.inc.php');
	if(isset($_SESSION['user'])){
		header('Location: index.php');
	}
	require_once('core/includes/login.inc.php');

?>
<div class="titleBar">
	<h3>Login</h3>
</div>
<section>
	<form method="post" action=""  autocomplete="off">
		<input type="text" placeholder="Enter your email" name="email" <?php if(isset($_POST['email'])){ echo 'value="' . $_POST["email"] . '"'; } ?>>
		<input type="password" placeholder="Enter your password" name="password">
		<?php
			if(!empty($error)){
				echo "
					<div class='errors'>
						<p>" . $error . "</p>
					</div>
				";
			}
		?>
		<button type="submit" name="submit">Login</button>
	</form>
</section>
<?php require_once('core/includes/overall/footer.inc.php'); ?>