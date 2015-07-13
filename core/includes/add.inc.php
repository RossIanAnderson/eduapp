<?php
	@$submit      = $_POST['submit'];
	@$name        = $_POST['name'];
	@$description = $_POST['description'];
	@$category    = (int)$_POST['category'];
	@$file        = $_POST['file'];
	
	if(isset($submit)){
		
		if(isset($name) && isset($description) && isset($category)){
		
			$checkName = mysql_query("SELECT name FROM apps WHERE name='$name'");
			$countName = mysql_num_rows($checkName);
			
			if ($countName != 0){
				$error = "There is already an app with that name!";
			}
			elseif (strlen($description) > 500){
				$error = "The description can only be 500 characters or less!";
			}
			elseif ($category < 0 || $category > 8){
				$error = "It must be a valid category!";
			}
			else {
				$user = $_SESSION['user'];
				$add = mysql_query("INSERT INTO apps VALUES('', '$name', '$description', '$category', '$user', '', '')");

				if(isset($file)){
					require_once('core/includes/imageUpload.inc.php');
				}	
	
				header('Location: add.php?added');
			}
		}
		else {
			$error = "You must fill out all fields!";
		}
	}
?>