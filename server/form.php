<?php 
	
	include("settings.php");


	// Create connection
	$conn = new mysqli($db, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	$sql = "INSERT INTO {$table_name} (fullname, email) VALUES 
	('{$fullname}', '{$email}')";

	if ($conn->query($sql) === TRUE) {
	    
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>