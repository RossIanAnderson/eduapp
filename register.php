<?php
	$title = 'EduApp - Register';
	require_once('core/includes/overall/header.inc.php');
	
	require_once('core/includes/register.inc.php');

?>
<div class="titleBar">
	<h3>Register</h3>
</div>
<section>
	<form method="post" action="" enctype="multipart/form-data" autocomplete="off">
		<figure>
			<img src="images/placeholders/addImage.gif">
			<figcaption>
				<a href="#" id="imageUpload">Add Image</a>
				<input type="file" name="file">
			</figcaption>
		</figure>
		<div class="right">
			<input type="text" placeholder="Enter your first name" name="firstname" <?php if(isset($_POST['firstname'])){ echo 'value="' . $_POST["firstname"] . '"'; } ?>>
			<input type="text" placeholder="Enter your last name" name="lastname" <?php if(isset($_POST['lastname'])){ echo 'value="' . $_POST["lastname"] . '"'; } ?>>
			<input type="password" placeholder="Enter a password" name="password1">
			<input type="password" placeholder="Re-enter password" name="password2">
			<input type="text" placeholder="Enter your email address" name="email" <?php if(isset($_POST['email'])){ echo 'value="' . $_POST["email"] . '"'; } ?>>
		</div>
		<?php
			if(!empty($error)){
				echo "
					<div class='errors'>
						<p>" . $error . "</p>
					</div>
				";
			}
		?>
		<button type="submit" name="submit">Register</button>
	</form>
</section>
<?php require_once('core/includes/overall/footer.inc.php'); ?>