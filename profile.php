<?php
	$title = 'EduApp - Profile';
	require_once('core/includes/overall/header.inc.php');
	
	require_once('core/includes/login.inc.php');
	
	$userID = $_GET['user'];
	$imageURL = getImage($userID, 'users', 'user.gif');
	$user = getUserInfo($userID);
	if($user['firstname'] == ""){
		header("Location: index.php");
	}
?>
<div class="titleBar">
	<?php
		if($_GET['user'] === $_SESSION['user']){
			echo "<h3>Your Profile</h3>";
		}
		else {
			echo "<h3>" . $user['firstname'] . " " . $user['lastname'] . "'s Profile</h3>"; 
		}
	?>
</div>
<section>
	<form>
		<figure>
			<img src="<?php echo $imageURL ?>" alt="Image">
		</figure>
		<div class="right">
			<h4><?php echo $user['firstname'] . " " . $user['lastname']; ?> </h4>
			<br>
			<br>
			<h4>Member since <?php echo date('d/m/Y', strtotime($user['created'])); ?></h4>
		</div>
	</form>
<?php
	$getAll = mysql_query("SELECT * FROM apps WHERE uploadedBy = $userID AND moderated=1");
?>
	<?php
		if($_GET['user'] === $_SESSION['user']){
			echo "<h3>Applications uploaded by you</h3>";
		}
		else {
			echo "<h3>Applications uploaded by " . $user['firstname'] . "</h3>"; 
		}
	?>
	
</section>
<?php require_once('core/includes/generateGrid.inc.php'); ?>
<?php require_once('core/includes/overall/footer.inc.php'); ?>