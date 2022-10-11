<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["logged3"]) || $_SESSION["logged3"] !== true){
    header("login.php");
    exit;
}
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
    	<h1 class="hello">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Here is your budget.</h1>
    		<div class="row1">
  				<div class="column left" style="background-color:#aaa;">
    				<h2 class="acct">Account</h2>
    				<a href="myplan.php" class="my1">My Plan</a><br>
					<a href="mybudget.php" class="my1">My Budget</a><br>
					<a href="myhistory.php" class="my1">My History</a>
  				</div>
  					<div class="column right" style="background-color:#bbb;">
    					<h2 class="month">This Month</h2>
    					<p>Some text..</p>
  					</div>
			</div>
</body>
</html>