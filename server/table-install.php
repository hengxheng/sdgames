<?php 
    include("settings.php"); 

    $conn = new mysqli($db, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            firstname VARCHAR(50),
            lastname VARCHAR(50),
            phone VARCHAR(50),
            email VARCHAR(50),
            serialNo VARCHAR(10),
            purchased_product VARCHAR(50),
            purchased_date VARCHAR(50),
            address1 VARCHAR(150),
            city VARCHAR(50),
            state VARCHAR(50),
            postcode VARCHAR(50),
            country VARCHAR(10),
            color VARCHAR(50),
            upload_file VARCHAR(100),
            newsletter VARCHAR(10)
        )";
    if ($conn->query($sql) === TRUE) {
        echo "Table {$table_name} created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
?>