<aside>
	<form id="globalSearch" action="apps.php" method="get">
		<input type="search" name="q" placeholder="Search..." <?php if(isset($_GET['q'])){ echo 'value="' . $_GET['q'] . '"';} ?> >
		<i class="fa fa-search"></i>
	</form>
	<div class="all">
		<h4>Categories</h4>
		<ul>
			<?php
				$getAllCategories = mysql_query('SELECT * FROM categories');
				$numCategories = mysql_num_rows($getAllCategories);
				
				for($i = 0; $i < $numCategories; $i++){
					$category = mysql_fetch_assoc($getAllCategories);
					echo "
						<li>
							<a href='apps.php?catID=" . $category['catID'] . "'>" . $category['category'] . "</a>
						</li>
					";
				}
			
			?>	
		</ul>
		<div class="seperator"></div>
	</div>
</aside>