<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("login.php");
}

// Include config file
require_once "server.php";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<p class="logout">
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
	<h1 class="text-center">Admin View</h1>
	<div class="card">
		<div class="card-body">
			<h3>Users</h3>
			<? 	$username = $_SESSION["username"];
				$sql= "SELECT * FROM users";
				$query_run = mysqli_query($link, $sql);
			?>
					<table id="table" class="table table-dark">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Needs</th>
								<th scope="col">Savings</th>
								<th scope="col">Wants</th>
								<th>
								</th>
							</tr>
						</thead>
			<?php
				if($query_run){
				foreach($query_run as $row){
			?>
						<tbody>
							<tr>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['needs']; ?></td>
								<td><?php echo $row['savings']; ?></td>
								<td><?php echo $row['wants']; ?></td>
							</tr>
							</tbody>
			<?php
				}
				} else{
				echo "No Record Found";
				}
			?>
</table>
			<h3>Budget Data</h3>
			<? 	$username = $_SESSION["username"];
				$sql= "SELECT * FROM list";
				$query_run = mysqli_query($link, $sql);
			?>
					<table id="table" class="table table-dark">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Item Name</th>
								<th scope="col">Item Cost</th>
								<th scope="col">Item Type</th>
								<th>
								</th>
							</tr>
						</thead>
			<?php
				if($query_run){
				foreach($query_run as $row){
			?>
						<tbody>
							<tr>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['buy']; ?></td>
								<td><?php echo $row['pay']; ?></td>
								<td><?php echo $row['type']; ?></td>
							</tr>
							</tbody>
			<?php
				}
				} else{
				echo "No Record Found";
				}
			?>
</table>
			<h3>Income</h3>
			<? 	$username = $_SESSION["username"];
				$sql= "SELECT * FROM income";
				$query_run = mysqli_query($link, $sql);
			?>
					<table id="table" class="table table-dark">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Income</th>
								<th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
							</tr>
						</thead>
			<?php
				if($query_run){
				foreach($query_run as $row){
			?>
						<tbody>
							<tr>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['income']; ?></td>
								<td>
                                    <button type="button" class="btn btn-warning editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
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