<?
// Initialize the session
session_start();

// Include config file
require_once "server.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (isset($_POST['type'])) {
    	if ($_POST['type'] == '1') {
        	echo "got em";
    } 	elseif ($_POST['type'] == '2') {
        	echo "got em2";
    } 	elseif ($_POST['value'] == '3'){
        	echo "got em3";
    }

    //header("Location: " . $url);

	}
	
	
	//	this is the code for switching plans to the "loose budget plan"
	
if(isset($_POST['loose']))
    {    

        $username = ($_SESSION["username"]);
        $needs = "50";
        $savings = "20";
        $wants = "30";

        $sql = "UPDATE users SET, needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'  ";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Plan Updated"); </script>';
            header("Location:myacct.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
	
//this is the code to swich plan to the savings budget plan
	if(isset($_POST['savings']))
    {    

        $username = ($_SESSION["username"]);
        $needs = "50";
        $savings = "40";
        $wants = "10";

        $sql = "UPDATE users SET, needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'  ";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Plan Updated"); </script>';
            header("Location:myacct.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
	
//this is the code to change plans to the tight budget plan
	if(isset($_POST['tight']))
    {    

        $username = ($_SESSION["username"]);
        $needs = "70";
        $savings = "20";
        $wants = "10";

        $sql = "UPDATE users SET, needs='$needs', savings='$savings', wants='$wants' WHERE username='$username'  ";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Plan Updated"); </script>';
            header("Location:myacct.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
	
	
}


?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    		<li class="header">Loose Budget</li>
			<li class="grey">For the ones who have a more expendable income.</li>
    		<li class="grey">50%-20%-30% Split</li>
    		<li>50% of income goes to needs</li>
    		<li>20% of income goes to savings</li>
    		<li>30% of income goes to wants</li>
			<li><button type="button" class="btn btn-success" name="loose">Switch</button></li>
  		</ul>
	</div>
	
	<!--	this is the second table "Savings Budget" -->
	
	<div class="columns">
		<ul class="price">
			<li class="header" style="background-color:#04AA6D">Savings Budget</li>
			<li class="grey">For the ones who want to save more for the future.</li>
			<li class="grey">50%-40%-10% Split</li>
			<li>50% of income goes to needs</li>
			<li>40% of income goes to savings</li>
			<li>10% of income goes to wants</li>
			<li><button type="button" class="btn btn-success" name="savings">Switch</button></li>
		</ul>
	</div>
<!--	this is the thrid table "tight budget" -->
	<div class="columns">
	  	<ul class="price">
			<li class="header">Tight Budget</li>
			<li class="grey">For the ones who maybe living paycheck to paycheck.</li>
			<li class="grey">70%-20%-10% Split</li>
			<li>70% of income goes to needs</li>
			<li>20% of income goes to savings</li>
			<li>10% of income goes to wants</li>
				<li><button type="button" class="btn btn-success" name="tight">Switch</button></li>
				
<!--                <input  type="submit" id="button" class="btn btn-success" value="Login">-->
            </div></li>
	  	</ul>
	</div>
</body>
</html>