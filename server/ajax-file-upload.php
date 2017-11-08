<?php 
	// Upload files
    date_default_timezone_set("Australia/Sydney");
	$temp = explode(".", $_FILES["uploadfile"]["name"]);
	$extension = end($temp);

    $photo_dir = "../upload/";
    
    $photo_name = md5(date('Y-m-d H:i:s:u'));
    $photo = $photo_name.".".$extension;
	$theFile = $photo_dir.$photo;
	
	if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $theFile)) {
    } else {
        echo "Sorry, there was an error uploading your photo.";
    }

    echo $theFile;
?>