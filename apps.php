<?php
	$title = 'EduApp';
	require_once('core/includes/overall/header.inc.php');
?>

<?php
	if(isset($_GET['fullApp'])){
		$appInfo = getAppInfo($_GET['fullApp']);
		$imageURL = getImage($appInfo['id'], 'apps', 'appThumb.gif');
		
		$userID = $appInfo['uploadedBy'];
		$getUser = mysql_query("SELECT * FROM users WHERE id = $userID");
		$users = mysql_fetch_assoc($getUser);

		
		if(($appInfo['name'] == "") || ($appInfo['description'] == "")){
			header('Location: index.php');
		}
		else {
			echo '
			<div class="titleBar">
				<h3>' . $appInfo['name'] . ' Details <span class="right">Uploaded by <a href="profile.php?user=' . $user['id'] . '">' . $user['firstname'] . ' ' . $user['lastname'] . '</a></h3>
			</div>
			';
			require_once('core/includes/fullAppInfo.inc.php');
		}
	}
	elseif(isset($_GET['catID'])){
		$catID = (int)$_GET['catID'];
		$getCategoryName = mysql_query("SELECT * FROM categories WHERE catID = $catID");
		$category = mysql_fetch_assoc($getCategoryName);
		echo '
			<div class="titleBar">
				<h3>Filtering by "' . $category['category'] . '"</h3>
			</div>
		';
		$getAll = mysql_query("SELECT * FROM apps WHERE moderated=1 AND catID=$catID");
		require_once('core/includes/generateGrid.inc.php');
	}
	elseif(isset($_GET['q'])){
		echo '
			<div class="titleBar">
				<h3>Showing results for "' . $_GET['q'] . '"</h3>
			</div>
		';
		$q = $_GET['q'];
		$getAll = mysql_query("SELECT * FROM apps WHERE moderated=1 AND name LIKE '%$q%' OR description LIKE '%$q%'");
		require_once('core/includes/generateGrid.inc.php');
	}
	else {
	  $perPage = 8;
            	
    	$pagesQuery = mysql_query("SELECT COUNT(id) FROM apps");
    	$pages = ceil(mysql_result($pagesQuery, 0) / $perPage);
          	
    	$page = (isset($_GET['pageNum'])) ? (int)$_GET['pageNum'] : 1;
    $start = ($page - 1) * $perPage;
        
    $getAll = mysql_query("SELECT * FROM apps WHERE moderated=1 LIMIT $start, $perPage");
				
		echo '
			<div class="titleBar">
				<h3>All Applications</h3>
			</div>
		';
		require_once('core/includes/generateGrid.inc.php');
	}
?>
<?php require_once('core/includes/overall/footer.inc.php'); ?>