<?php 
    include("settings.php"); 

    $conn = new mysqli($db, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            fullname VARCHAR(50),
            email VARCHAR(50),
        )";
    if ($conn->query($sql) === TRUE) {
        echo "Table {$table_name} created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
?>