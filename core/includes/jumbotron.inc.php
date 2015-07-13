<?php
	$getNewestApplication = mysql_query("SELECT * FROM apps WHERE moderated = 1 ORDER BY date DESC LIMIT 1");
	$numNewestApplications = mysql_num_rows($getNewestApplication);
	if($numNewestApplications > 0){
		$data = mysql_fetch_assoc($getNewestApplication);
		$jumboImage = getImage($data['id'], 'apps', 'noJumbo.gif');
?>
<figure class="jumbotron">
	<span>Newest Application</span>
	<a href="apps.php?fullApp=<?php echo $data['id']; ?>">
		<img src="<?php echo $jumboImage; ?>" alt="Image for <?php echo $data['name'] ?>">
	</a>
	<figcaption>
		<h2><i class="fa fa-gamepad"></i><?php echo $data['name']; ?></h2>
		<?php
			$jumboRating = getAppRating($data['id']);
			if($jumboRating != 0){
				echo "<h2 class='right'>Rating - " . substr($jumboRating, 0, 3) . " / 5</h2>";
			}
			else {
				echo "<h2 class='right'>No ratings yet</h2>";
			}
		?>
	</figcaption>
</figure>
<?php
	}
?>