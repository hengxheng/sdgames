<?php 
	
	include("settings.php");


	// Create connection
	$conn = new mysqli($db, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$serialNo = mysqli_real_escape_string($conn, $_POST['serialNo']);
	$product = mysqli_real_escape_string($conn, $_POST['product']);
	$date = mysqli_real_escape_string($conn, $_POST['date']);
	$address1 = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
	$color = mysqli_real_escape_string($conn, $_POST['color']);
	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$file = mysqli_real_escape_string($conn, $_POST['file']);
	$newsletter = mysqli_real_escape_string($conn, $_POST['newsletter']);
	if($newsletter=="true"){
		$newsletter = "on";
	}
	else{
		$newsletter = "off";
	}

	$sql = "INSERT INTO {$table_name} (firstname, lastname, email, phone, serialNo, purchased_product, purchased_date, address1, city, state, postcode, country, color, upload_file, newsletter) VALUES 
	('{$firstname}', '{$lastname}', '{$email}', '{$phone}', '{$serialNo}', '{$product}', '{$date}', '{$address1}', '{$city}', '{$state}', '{$postcode}', '{$country}', '{$color}', '{$file}', '{$newsletter}')";

	if ($conn->query($sql) === TRUE) {
	    
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>