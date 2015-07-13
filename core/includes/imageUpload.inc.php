<?php
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["file"]["error"] > 0) {
	  		$error = $_FILES["file"]["error"];
	  }
	  else {	
		  	$filename  = basename($_FILES['file']['name']);
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			$new       = $ID . '.' . $extension;
			
			move_uploaded_file($_FILES['file']['tmp_name'], "images/users/" . $new);
    }
	}
	else {
	  $error = "Invalid file";
	}
?>