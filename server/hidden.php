<?php
	// Start the session
	session_start();

	include("settings.php");
?>
<!doctype html>
<html>
	<head>
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" href="admin.css" type="text/css">
		 <script src="https://code.jquery.com/jquery-2.1.1.js"></script>
	</head>
	<body class="admin">
	

	<?php 
		if(isset($_POST['username']) && isset($_POST['pass'])){

			if($_POST['username'] == "admin" && $_POST['pass'] == "hidden1234"){
				$admin = 1;
				$_SESSION['admin'] = 1;
			}
			else{
				$not_admin = 1;
			}
		} 
	?>

	<?php if (!isset($admin)&& !isset($_SESSION['admin'])){  ?>
		<div class="site-inner">
			<form class="login-form" action="<?php echo $base_url; ?>/hidden.php" method="post">
				<?php if(isset($not_admin)) echo "<p style='text-align: center;'>Incorrect username or password</p>"; ?>
				<div style="margin-bottom: 15px;">
					<label for="username">Username: </label><br/>
					<input type="text" name="username">
				</div>
				<div style="margin-bottom: 15px;">
					<label for="pass">Password: </label><br/>
					<input type="password" name="pass">
				</div>
				<div>
					<input type="submit" value="submit">
				</div>
			</form>
		</div>
	<?php } elseif( isset($_SESSION['admin'])){

		$per_page = 15;

		// Create connection
		$conn = new mysqli($db, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 


		$sql = "SELECT * FROM {$table_name}";


		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$total = $result->num_rows;
			$total_pages = ceil($result->num_rows / $per_page);

			if (isset($_GET['page'])) {
					$show_page = $_GET['page']; 
					if ($show_page > 0 && $show_page <= $total_pages) {
						$start = ($show_page - 1) * $per_page;
						$end = $start + $per_page;
					} else {
						$start = 0;              
						$end = $per_page;
					}
				} else {
					$show_page = 1;
					$start = 0;
					$end = $per_page;
				}
				if(isset($_GET['page'])){
					$page = intval($_GET['page']);			
				}
				else{
					$page = 1;
				}

				$tpages=$total_pages;

				if ($page <= 0) $page = 1;

		?>
		<div class="site-inner">
			<br/>
			<p>Total entries: <?php echo $result->num_rows; ?></p>
			<p><a href="<?php echo $base_url; ?>/genXML.php" class="btn">Generate XML files</a></p>
			<?php
				// pagination
				$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
				if ($total_pages > 1) {
					echo paginate($reload, $show_page, $total_pages);
				}
			
				// store db data to array
				$records = array();
				while($row = $result->fetch_assoc()) {
					$records[] = $row;
				}
			?>
			
			<table>
				<tr>
					<?php foreach ($records[0] as $k => $r): ?>
						<th id="<?php echo $k; ?>"><?php echo str_replace("_", " ", $k) ?></th>
					<?php endforeach; ?>
				</tr>
				<?php 
					for($i=$start; $i<$end ; $i++){
						if($i == $total) break;
				?>	
					<tr>
						<?php foreach ($records[$i] as $rk => $rv): ?>
							<td class="<?php echo $rk; ?>"><?php echo $records[$i][$rk]; ?></td>
						<?php endforeach; ?>
					</tr>    
				<?php } ?>
			</table>
			<?php
				// pagination
				if ($total_pages > 1) {
					echo paginate($reload, $show_page, $total_pages);
				}
			?>

		</div>
		<?php 

		} else {
			echo "0 results";
		}

		$conn->close();

	}
	?>
</body>
</html>