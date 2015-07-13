<?php
	$title = 'EduApp - Log Out';
	require_once('core/includes/overall/header.inc.php');
	restricted();
?>
<div class="titleBar">
	<h3>Loggin Out</h3>
</div>
<?php	
	session_start();
	session_destroy();
	header("Location: index.php");

	require_once('core/includes/overall/footer.inc.php'); 

?>