<?php
//*Credentials for Admin Account: Username=admin Password=adminpass*

// Initialize the session
session_start();
 
// Check if the user or admin is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
	echo '<script>window.location.href = "index2.php";</script>';
	exit;
	
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	echo '<script>window.location.href = "index.php";</script>';
	exit;
}

// Include config file
require_once "server.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, needs, savings, wants FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $needs, $savings, $wants);
                    if(mysqli_stmt_fetch($stmt)){
						//Verifies account based on password and only executes if the username does not equal admin
                        if(password_verify($password, $hashed_password) && $username !== "admin"){
                            
							session_start();
							// Password is correct so start a new sesstion
							$_SESSION["logged"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
							
 							// Redirect user to welcome page
							 echo '<script>window.location.href = "index2.php";</script>';
	
							//Verifies account based on password and only executes if the username does equals admin
						   } elseif(password_verify($password, $hashed_password)&& $username=="admin"){
							                            // Password is correct so start a new sesstion
							session_start();

							$_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
 							// Redirect user to welcome page
                        	 echo '<script>window.location.href = "index.php";</script>';
							
							} else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
					}
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
		$pageTitle = "Login";//change for each page
		include_once("Head.php");
	?>
   <br><br>
	<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
		
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label >Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div id="form-group">
                <input  type="submit" name="button" class="btn btn-primary" value="Login">
            </div>
			
			<br>
            <p class="next">Don't have an account? <a href="registration.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>