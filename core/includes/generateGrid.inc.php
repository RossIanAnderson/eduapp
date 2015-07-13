<?php

	$numRows = mysql_num_rows($getAll);
	$count = 0;
	$rowsNeeded = ceil($numRows / 4);	
	if($numRows == 0){
		echo "
			<div class='noApps'>
				<h4>No apps to show</h4>
			</div>
		";
	}
	else {
		echo "<table class='appList'>";
		for($i = 0; $i < $rowsNeeded; $i++){
			echo "<tr>";
				for($j = 0; $j < 4; $j++){
					if($count < $numRows){
						echo "<td>";
						$row = mysql_fetch_assoc($getAll);
						$appID = $row['id']; 
						$name = $row['name'];
						$imageURL = getImage($appID, 'apps', 'appThumb.gif');
						echo "
							<a href='?fullApp=" . $appID . "'>
								<img src='" . $imageURL . "' alt='Thumbnail for " . $name . "'>
								" . $name . "
							</a>
						";
					echo "</td>";
					$count++;
					}
				}
			echo "</tr>";
 		}
 		echo "</table>";
	}
	
	if($pages > 1 && $page <= $pages){
		echo "
			<div class='pagination'>
		";
		if($page == $pages){
			$prev = $page - 1;
			echo "<a class='left' href='?pageNum=" . $prev . "'><i class='fa fa-angle-left'></i></a>";
		}
		else {
			echo "<a class='left no' href='#'><i class='fa fa-angle-left'></i></a>";
		}
		for ($x=1; $x<=$pages; $x++){
			echo ($x == $page) ? "<a class='active' href='?pageNum=" . $x . "'>" . $x . "</a> ":"<a href='?pageNum=" . $x . "'>" . $x . "</a> ";
		}
		if($page != $pages){
			$next = $page + 1;
			echo "<a class='right' href='?pageNum=" . $next . "'><i class='fa fa-angle-right'></i></a>";
		}
		else {
		  echo "<a class='right no' href='#'><i class='fa fa-angle-right'></i></a>";
		}
		echo "
			</div>
		";
	}
?>