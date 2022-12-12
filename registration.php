<?php
// Include database connection file
require_once "server.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $plan = $needs = $savings = $wants = "";
$username_err = $password_err = $confirm_password_err = $plan_err = $needs_err = $savings_err = $wants_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
   	// Validate plan 
   	if(empty(trim($_POST["needs"]))){
		$needs_err = "Please enter a number";
	} elseif(!preg_match('/^[0-9_]+$/', trim($_POST["needs"]))){
		$needs_err = "Needs can only contain numbers";
	} else{
		$needs = trim($_POST["needs"]);
	}
	
	if(empty(trim($_POST["savings"]))){
		$savings_err = "Please enter a number";
	} elseif(!preg_match('/^[0-9_]+$/', trim($_POST["savings"]))){
		$savings_err = "Savings can only contain numbers";
	} else{
		$savings = trim($_POST["savings"]);
	}
	
	if(empty(trim($_POST["wants"]))){
		$wants_err = "Please enter a number";
	} elseif(!preg_match('/^[0-9_]+$/', trim($_POST["wants"]))){
		$wants_err = "wants can only contain numbers";
	} else{
		$wants = trim($_POST["wants"]);
	}
	
	if($needs + $savings + $wants > 100){
		$needs_err= "Total Exceeds 100%";
		$savings_err= "Total Exceeds 100%";
		$wants_err= "Total Exceeds 100%";
	}
	
	if($needs + $savings + $wants < 100){
		$needs_err= "Total falls below 100%";
		$savings_err= "Total falls below 100%";
		$wants_err= "Total falls below 100%";
	}	
	
	
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($needs_err) && empty($savings_err) && empty($wants_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, needs, savings, wants) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_needs, $param_savings, $param_wants);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
			$param_needs = $needs;
			$param_savings = $savings;
			$param_wants = $wants;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
				echo '<script> alert("Registration Complete"); </script>';
                echo '<script>window.location.href = "login.php";</script>';
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="login.css">

 	<?
		$pageTitle = "Registration";//change for each page
		include_once("Head.php");
	?>
<br><br>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
				<p>Choose Your Plan:</p>
				<p>(Note*: Here you will insert what percent of your income will go into the categories listed below.)</p>
			<div class="form-group">
                <label>Needs%</label>
                <input type="text" name="needs" class="form-control <?php echo (!empty($needs_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $needs; ?>">
                <span class="invalid-feedback"><?php echo $needs_err; ?></span>
            </div>
			<div class="form-group">
                <label>Savings%</label>
                <input type="text" name="savings" class="form-control <?php echo (!empty($savings_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $savings; ?>">
                <span class="invalid-feedback"><?php echo $savings_err; ?></span>
            </div>
		    <div class="form-group">
                <label>Wants%</label>
                <input type="text" name="wants" class="form-control <?php echo (!empty($wants_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $wants; ?>">
                <span class="invalid-feedback"><?php echo $wants_err; ?></span>
            </div>	

			<div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>