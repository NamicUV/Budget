<?
// Initialize the session
session_start();

// Include config file
require_once "server.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['editplan'])){    
        $username = ($_SESSION["username"]);
        $needs = $_POST['needs'];
		$savings = $_POST['savings'];
		$wants = $_POST['wants'];
	
		if($needs + $savings + $wants > 100){
			echo '<script> alert("Total Exceeds 100%"); </script>';
		}elseif($needs + $savings + $wants <100){
			echo '<script> alert("Total Does Not Equal 100%"); </script>';
		} elseif($needs + $savings + $wants == 100){
			$sql = "UPDATE users SET needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'  ";
			$query_run = mysqli_query($link, $sql);
		} else{
			
		}

		if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header("Location:myacct.php");
			}
			else
			{
				echo '<script> alert("Data Not Updated"); </script>';
			}}
	if(isset($_POST['1'])){
		$username= ($_SESSION['username']);
		$needs= 50;
		$savings= 20;
		$wants= 30;
		$sql= "UPDATE users SET needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'";
		$query_run = mysqli_query($link,$sql);
	 		if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header("Location:myacct.php");
			}
			else
			{
				echo '<script> alert("Data Not Updated"); </script>';
			}}
		if(isset($_POST['2'])){
		$username= ($_SESSION['username']);
		$needs= 50;
		$savings= 40;
		$wants= 10;
		$sql= "UPDATE users SET needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'";
		$query_run = mysqli_query($link,$sql);
	 		if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header("Location:myacct.php");
			}
			else
			{
				echo '<script> alert("Data Not Updated"); </script>';
			}}
		if(isset($_POST['3'])){
		$username= ($_SESSION['username']);
		$needs= 70;
		$savings= 20;
		$wants= 10;
		$sql= "UPDATE users SET needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'";
		$query_run = mysqli_query($link,$sql);
	 		if($query_run)
			{
				echo '<script> alert("Data Updated"); </script>';
				header("Location:myacct.php");
			}
			else
			{
				echo '<script> alert("Data Not Updated"); </script>';
			}}
}


?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="myplan.css">
	<title>My Plan</title>
</head>

<body>
	
<div class="logout">
	<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>
<div class="back">
	<a href="login.php" class="btn btn-danger ml-3">Back</a>
</div>
	
		<h1 class="header">Our Recommended Plans</h1>

<!--	this is the first table "loose budget" -->
	
	<div class="columns">
  		<ul class="price">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    		<li class="header">Loose Budget</li>
			<li class="grey">For the ones who have a more expendable income.</li>
    		<li class="grey">50%-20%-30% Split</li>
    		<li>50% of income goes to needs</li>
    		<li>20% of income goes to savings</li>
    		<li>30% of income goes to wants</li>
			<li><button type="submit" class="btn btn-success" name="1">Switch</button></li>
			</form>
  		</ul>
	</div>
	
	<!--	this is the second table "Savings Budget" -->
	
	<div class="columns">
		<ul class="price">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<li class="header" style="background-color:#04AA6D">Savings Budget</li>
			<li class="grey">For the ones who want to save more for the future.</li>
			<li class="grey">50%-40%-10% Split</li>
			<li>50% of income goes to needs</li>
			<li>40% of income goes to savings</li>
			<li>10% of income goes to wants</li>
			<li><button type="submit" class="btn btn-success" name="2">Switch</button></li>
			</form>
		</ul>
	</div>
<!--	this is the thrid table "tight budget" -->
	<div class="columns">
	  	<ul class="price">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<li class="header">Tight Budget</li>
			<li class="grey">For the ones who maybe living paycheck to paycheck.</li>
			<li class="grey">70%-20%-10% Split</li>
			<li>70% of income goes to needs</li>
			<li>20% of income goes to savings</li>
			<li>10% of income goes to wants</li>
			<li><button type="submit" class="btn btn-success" name="3">Switch</button></li>
			</form>
	  	</ul>
	</div>
	<div type="hidden">
	.</div>
	<h2 class="header">If you would like to do your own custom budget please click the "Custom" button below</h2><br>
	<div class="d-grid gap-2 d-md-flex justify-content-md-center">
	<button type="button"  class="btn btn-success" data-toggle="modal" data-target="#editplan" name="editplan" >
		Custom</button>
	</div><br><br>
	<!--Modal for Update Plan-->						
	<div class ="modal fade" id="editplan" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Custom Plan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
							<label for="exampleInputbuy">Needs</label>
							<input type="text" class="form-control" name="needs" id="needs" placeholder="Enter a number">
							</div>
							<div class="form-group">
							<label for="exampleInputpay">Savings (We recommend to have at least 10% in this field)</label>
							<input type="text" class="form-control" name="savings" id="savings" placeholder="Enter a number">
							</div>
							<div class="form-group">
							<label for="exampleInputbuy">Wants</label>
							<input type="text" class="form-control" name="wants" id="wants" placeholder="Enter a number">
							</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="editplan" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	
	
</body>
</html>