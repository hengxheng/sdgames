<?php 
	// Start the session
	session_start();
    include("settings.php"); 
    if (isset($_SESSION['admin'])){  

    $conn = new mysqli($db, $username, $password, $dbname);

    $select = "SELECT * FROM {$table_name}";
    $result = $conn->query($select);
    $records = array();
    while($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    $header = "";
    foreach ($records[0] as $k => $r){
        if($k != "id"){
            $n = ucfirst(str_replace("_", " ", $k));
            $header .= $n."\t";
        }
    }
    
    $line = '';
    foreach ($records as $r) {
        foreach ($r as $k => $v){
            if($k != "id"){
                $line .= $v."\t";
            }
        }
        $line .= "\n";
    }
    $data = trim( $line );
    $data = str_replace( "\r" , "" , $data );
    if ( $data == "" ){
        $data = "\n(0) Records Found!\n";                        
    }

    header("Content-Type: application/force-download");
    header("Content-type: application/octet-stream");
    header("Content-Type: application/download");
    
    header("Content-Disposition: attachment; filename=c_results.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$data";
}
else{
    echo "Login to export data";
}
?>