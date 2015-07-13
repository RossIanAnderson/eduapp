<?php
	if($appInfo['moderated'] == 0){
		header("Location: apps.php");
	}

	$catID = $appInfo['catID'];
	$getCat = mysql_query("SELECT * FROM categories WHERE catID = $catID");
	$categories = mysql_fetch_assoc($getCat);
?>

<section>
	<form>
		<figure>
			<img src="<?php echo $imageURL ?>" alt="Image">
		</figure>
		<div class="right">
			<h4 class="name"><?php echo $appInfo['name']; ?></h4>
			<h4 class="category"><?php echo $categories['category']; ?></h4>
			<p><?php echo $appInfo['description']; ?></p>
		</div>
	</form>
	<div class="mainContent clear">
		<div class="clear">
			<div class="column">
				<h4>Average User Rating</h4>
				<div class="userRating">
					<?php
						$rating = getAppRating($appInfo['id']);
						if($rating == 0){
							echo "No ratings yet";	
						}
						else {
							echo "<div class='inner' data-rating='" . substr($rating, 0, 3) . "'></div>";
						}
					?>
				</div> 
			</div>
			<div class="column">
				<?php 
					require_once('core/includes/ratings.inc.php');
				?>
			</div>
		</div>
		<?php
			require_once('core/includes/reviews.inc.php');
		?>
	</div>
</section>