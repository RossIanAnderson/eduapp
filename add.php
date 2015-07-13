<?php
	$title = 'EduApp - Add New App';
	require_once('core/includes/overall/header.inc.php');
	restricted();
	require_once('core/includes/add.inc.php');
?>
<div class="titleBar">
	<h3>Add New App</h3>
</div>
<section>
	<?php if(!isset($_GET['added'])){ ?>
	<form class="add" method="post" action="" enctype="multipart/form-data" autocomplete="off">
		<figure>
			<img src="images/placeholders/addImage.gif">
			<figcaption>
				<a href="#" id="imageUpload">Add Image</a>
				<input type="file" name="file">
			</figcaption>
		</figure>
		<div class="right">
			<input type="text" placeholder="Enter the applications' name here" name="name" <?php if(isset($_POST['name'])){ echo 'value="' . $_POST["name"] . '"'; } ?>>
			<div class="select">
				<select name="category">
					<option selected="selected" value="0">Category</option>
					<?php
						$getAllCats = mysql_query("SELECT * FROM categories");
						$noCats = mysql_num_rows($getAllCats);
						for($c = 0; $c < $noCats; $c++){
							$catRow = mysql_fetch_assoc($getAllCats);
							echo "
								<option value='" . $catRow['catID'] . "'>" . $catRow['category'] . "</option>
							";
						}
					?>
				</select>
			</div>
			<textarea name="description" placeholder="Enter a description for the application"><?php if(isset($_POST['description'])){ echo $_POST["description"]; } ?></textarea>
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
		<button type="submit" name="submit">Submit</button>
	</form>
	<?php
		} else {
	?>
		<h3>Thank you for adding a new application.</h3>
		<p>The application will not be visible until it has been moderated by an admin.</p>
	<?php } ?>
</section>
<?php require_once('core/includes/overall/footer.inc.php'); ?>