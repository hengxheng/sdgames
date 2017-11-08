
<?php
    include ("settings.php");
    $paged = $_POST["paged"];
    
    if($paged):
        $conn = new mysqli($db, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $offset = ((int)$paged-1)*$per_page;
        $sql = "SELECT * FROM {$table_name} ORDER BY id DESC LIMIT {$per_page} OFFSET {$offset}";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):?>
                <a href="<?php echo $base_url."/".$row['upload_file']; ?>" class="gallery-item" style="background: url(<?php echo $base_url."/".$row['upload_file']; ?>); background-size: cover;" alt="<?php echo $row['name']; ?>" data-lightbox="roadtrip">
                </a>  
<?php       endwhile;
        endif; 
        $conn->close();	
    endif;
?>