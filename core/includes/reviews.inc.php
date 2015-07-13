<div class="reviews">
	<h4>User Reviews</h4>
	<?php
		$appID = $appInfo['id'];
		$getAllReviews = mysql_query("SELECT r.reviewID, r.appID, r.title, r.body, r.uploadedBy, u.firstname, u.lastname, r.date FROM reviews r, users u WHERE u.id = r.uploadedBy AND appID=$appID AND moderated = 1");
		$numReviews = mysql_num_rows($getAllReviews);
		
		if($numReviews == 0){
			echo "
				<p>This application has no reviews yet...</p>
			";
			if(isLoggedIn()){
				echo "<button type='button' class='show'>Be the First</button>";
			}
			else {
				echo "<a class='show' href='login.php'>Log in and be the first</a>";
			}
		}
		else {
			for($i = 0; $i < $numReviews; $i++){
				$review = mysql_fetch_assoc($getAllReviews);
				
				echo "
					<article>
						<h5>" . $review['title'] . " <small> - Posted <time>" . date('d/m/Y', strtotime($review['date'])) . "</time> by <a href='profile.php?user=" . $review['uploadedBy'] . "'>" . $review['firstname'] . " " . $review['lastname'] . "</a></small></h5>
						<p>" . $review['body'] . "</p>
					</article>
				";
			}
			if(isLoggedIn()){
				if(!isset($_POST['submit'])){
					echo "<button type='button' class='show'>Review this application</button>";
				}
			}
			else {
				echo "<a class='show' href='login.php'>Log in to review this application</a>";
			}
		}
	
		if(isLoggedIn()){
		?>
			<form action="" method="post" 
			<?php
				if(isset($_POST['submit'])){
					echo 'style="display: block"';
				}
				else {
					echo 'style="display: none"';
				}
			?>
			class="reviewFields">
				<input type="text" name="title" placeholder="Title"
				<?php
					if(isset($_POST['submit'])){
						echo 'value="' . $_POST['title'] . '"';
					}
				?>
				>
				<textarea name="review" placeholder="Review"><?php
					if(isset($_POST['submit'])){
						echo $_POST['revi ew'];
					}
				?></textarea>
				<button type="submit" name="submit">Submit Review</button>
			</form>
		
		<?php

			if(!empty($error)){
				echo "
					<div class='errors'>
						<p>" . $error . "</p>
					</div>
				";
			}
			if(isset($_POST['submit'])){
				if(isset($_POST['title']) && isset($_POST['review'])){
					$title = $_POST['title'];
					$body = $_POST['review'];
					$uploadedBy = $_SESSION['user'];
					if(strlen($body) < 250){
						$insertReview = mysql_query("INSERT INTO reviews VALUES('', '$appID', '$title', '$body', '$uploadedBy', NOW(), '')");
						
						header('Location: apps.php?fullApp=' . $appID . '#main');
					}
					else {
						$error = "Your review cannot exceed 250 charcters!";
					}
				}
				else {
					$error = "Please fill in both fields!";
				}
			}
		}
	?>
</div>