<?php require_once('core/init.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php require_once('core/includes/links.inc.php'); ?>
</head>
<body>
	<div class="container">
		<?php
			require_once('core/includes/header.inc.php');
			require_once('core/includes/aside.inc.php');	
		?>
		<main>
			<?php require_once('core/includes/jumbotron.inc.php'); ?>
