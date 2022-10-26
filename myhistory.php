<?
// Initialize the session
session_start();

// Include config file
require_once "server.php";


?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="myhistory.css">
	<style>
	@media screen and (max-width: 600px) {
  .history {
    width: 100%;
	 text-align: center;
  }
}
	</style>
<title>My Plan</title>
</head>

<body>

<div class="logout">
	<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>
<div class="back">
	<a href="login.php" class="btn btn-danger ml-3">Back</a>
</div><br><br>
	
<div class="card">
	<div class="card-body">
	<h2 class="history"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>'s History</h2>

	<? 	$username = $_SESSION["username"];
		$sql= "SELECT * FROM list WHERE username = '" . $username . "'";
		$query_run = mysqli_query($link, $sql);
	?>
			<table id="table" class="table table-dark">
				<thead>
					<tr>
						<th scope="col">Item Name</th>
						<th scope="col">Item Cost</th>
						<th scope="col">Item Type</th>
						<th scope="col">Buy Date</th>
					</tr>
				</thead>
	<?php
		if($query_run){
		foreach($query_run as $row){
	?>
				<tbody>
					<tr>
						<td><?php echo $row['buy']; ?></td>
						<td><?php echo $row['pay']; ?></td>
						<td><?php echo $row['type']; ?></td>
						<td><?php echo $row['created_at']; ?></td>
					</tr>
					</tbody>
	<?php
		}
		} else{
		echo "No Record Found";
		}
	?>
</table>
</div>
</div>	
	
</body>
</html>