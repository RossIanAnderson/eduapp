<?php
	session_start();
	ob_start();
	
	//mysql_connect('localhost', 'root', 'root') or die('Cannot connect to database');
	//mysql_select_db('eduapp') or die('Cannot select appropriate database');
	
	function isLoggedIn(){
		if(isset($_SESSION['user'])){
			return true;
		}
		else {
			return false;
		}
	}
	
	function getUserInfo($ID){
		return mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE id = $ID"));
	}
	
	function getAppInfo($ID){
		return mysql_fetch_assoc(mysql_query("SELECT * FROM apps WHERE id = $ID"));
	}
	
	function restricted(){
		if(!isset($_SESSION['user'])){
			header('Location: index.php');
		}
	}
	
	function getAppRating($appID){
		$query = mysql_query("SELECT * FROM ratings WHERE appID = $appID");
		$numRatings = mysql_num_rows($query);
		
		if($numRatings == 0){
			return 0; 
		}
		else {
			$totalRating = 0;
			for($i = 0; $i < $numRatings; $i++){
				$row = mysql_fetch_assoc($query);
				$currentRating = $row['value']; 
				$totalRating = $totalRating + $currentRating;
			}
			return $totalRating / $numRatings;
		}
	}
		
	function hasUserRated($appID, $userID){
		return mysql_num_rows(mysql_query("SELECT * FROM `ratings` WHERE appID = $appID AND userID = $userID"));
	}
	
	function hasUserReviewed($appID, $userID){
		return mysql_num_rows(mysql_query("SELECT * FROM `reviews` WHERE appID = $appID AND userID = $userID"));
	}

		
	function getImage($what, $folder, $placeholder){
		if(file_exists("images/" . $folder . "/" . $what . ".gif")){
			return "images/" . $folder . "/" . $what . ".gif";
		}
		elseif(file_exists("images/" . $folder . "/" . $what . ".png")){
			return "images/" . $folder . "/" . $what . ".png";
		}
		elseif(file_exists("images/" . $folder . "/" . $what . ".jpg")){
			return "images/" . $folder . "/" . $what . ".jpg";
		}
		elseif(file_exists("images/" . $folder . "/" . $what . ".jpeg")){
			return "images/" . $folder . "/" . $what . ".jpeg";
		}
		else {
			return "images/placeholders/" . $placeholder;
		}
	}
?>