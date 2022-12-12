<?php
//*Credentials for Admin Account: Username=admin Password=adminpass*

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("login.php");
}

// Include config file
require_once "server.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(isset($_POST['edituser'])){
	$user=$_POST['userid'];
	$username=$_POST['username'];
	$needs = $_POST['needs'];
    $savings = $_POST['savings'];
    $wants = $_POST['wants'];	
		
	$sql = "UPDATE users SET username='$username', needs='$needs', savings='$savings', wants='$wants' WHERE id='$user' ";
	$query_run = mysqli_query($link, $sql);
	
	        if($query_run)
        {
            echo '<script> alert("User Data Updated"); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }}

	    if(isset($_POST['updatebudget']))
    {    

        $ide = $_POST['update_id'];
        $buy = $_POST['buy'];
        $pay = $_POST['pay'];
        $type = $_POST['type'];

        $sql = "UPDATE list SET buy='$buy', pay='$pay', type='$type' WHERE id='$ide'  ";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
	
		if(isset($_POST['deletedata']))
	{
		$ide = $_POST['delete_id'];

		$sql = "DELETE FROM list WHERE id='$ide'";
		$query_run = mysqli_query($link, $sql);

		if($query_run)
		{
			echo '<script> alert("Data Deleted"); </script>';
			header("Location:index.php");
		}
		else
		{
			echo '<script> alert("Data Not Deleted"); </script>';
		}
	}
		    if(isset($_POST['updateincome']))
    {    

        $ide = $_POST['update_income'];
        $income = $_POST['income'];

        $sql = "UPDATE income SET income='$income' WHERE username='$ide'";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Income Updated"); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
	
		if(isset($_POST['delete3']))
	{
		$ide = $_POST['delete_income'];
		

		$sql = "DELETE FROM income WHERE username='$ide'";
		$query_run = mysqli_query($link, $sql);

		if($query_run)
		{
			echo '<script> alert("Data Deleted"); </script>';
			header("Location:index.php");
		}
		else
		{
			echo '<script> alert("Data Not Deleted"); </script>';
		}
	}
		if(isset($_POST['updatepassword']))
    {    

        $ide = $_POST['update_password'];
        $password = $_POST['pword'];
		$pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$pass' WHERE username='$ide'";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Password Updated"); </script>';
            header("Location:index.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }

	if(isset($_POST["delete"])){
		$ide = $_POST['delete_idd'];
		$sql = "DELETE FROM users WHERE id='$ide'";
		$query_run = mysqli_query($link, $sql);

		if($query_run)
		{
			echo '<script> alert("Data Deleted"); </script>';
			header("Location:index.php");
		}
		else
		{
			echo '<script> alert("Data Not Deleted"); </script>';
		}
	}
	}
	
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="index.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script>
		$(document).ready(function () {

		$('.inpectbtn').on('click', function () {

			$('#inspectbtn').modal('show');

		});
		}); 
		
			$(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#edituser').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#userid').val(data[0]);
				$('#username').val(data[1]);
                $('#needs').val(data[2]);
                $('#savings').val(data[3]);
                $('#wants').val(data[4]);
            });
        }); 
		
			$(document).ready(function () {

				$('.inpectbtn2').on('click', function () {

				$('#inspectbtn2').modal('show');

			});
			}); 
		
			$(document).ready(function () {

            $('.editbtn2').on('click', function () {

                $('#editbudget').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#update_id').val(data[0]);
                $('#buy').val(data[2]);
                $('#pay').val(data[3]);
                $('#type').val(data[4]);
            });
        }); 
		
		    $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
		
			$(document).ready(function () {

            $('.editbtn3').on('click', function () {

                $('#editbudget3').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#update_income').val(data[0]);
                $('#income').val(data[1]);
            });
        }); 
		
		    $(document).ready(function () {

            $('.delete3').on('click', function () {

                $('#delete3').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_income').val(data[0]);

            });
        });
		
		
			$(document).ready(function () {

            $('.editbtn4').on('click', function () {

                $('#editbudget4').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#update_password').val(data[0]);
                $('#pword').val(data[1]);
            });
        }); 
		
				$(document).ready(function () {

				$('.delete').on('click', function () {

				$('#delete').modal('show');

			});
			}); 
		
		
				$(document).ready(function () {

				$('.deletebtn4').on('click', function () {

				$('#deletemodall').modal('show');
					
				$tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
				
				console.log(data);
				$('#delete_idd').val(data[0]);

			});
			}); 
	</script>
</head>
<body>
	<p class="logout">
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
		<!--<a href="index.php" class="btn btn-primary ml-3">Refresh</a>-->
    </p>
	<h1 class="text-center">Admin View</h1>

	<div class="card">
		<div class="card-body">
			<div class="d-grid gap-2 d-md-flex justify-content-md-center">
				<button align="center" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete User</button>
			</div><br>
			
		<!--Modal for User Delete inspect-->						
	<div class ="modal fade" id="delete" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">All Users</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
										<? 	$username = $_SESSION["username"];
											$sql= "SELECT * FROM users";
											$query_run = mysqli_query($link, $sql);
										?>
												<table id="table" class="table table-dark">
													<thead>
														<tr>
															<th scope="col">ID</th>
															<th scope="col">Username</th>
															<th scope="col">Delete</th>
														</tr>
													</thead>
										<?php
											if($query_run){
											foreach($query_run as $row){
										?>
													<tbody>
														<tr>
															<td><?php echo $row['id']; ?></td>
															<td><?php echo $row['username']; ?></td>
															<td>
																<button type="button" class="btn btn-danger deletebtn4"> Delete </button>
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
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--Modal for User Delete-->
    <div class="modal fade" id="deletemodall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete User </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_idd" id="delete_idd">

                        <h4> Are you sure you want to delete this user?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="delete" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
			
			<h3>Users <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inspectbtn">Inspect</button></h3>
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
			
			<!--Modal for Users Inspect-->						
	<div class ="modal fade" id="inspectbtn" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">All Users</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
										<? 	$username = $_SESSION["username"];
											$sql= "SELECT * FROM users";
											$query_run = mysqli_query($link, $sql);
										?>
												<table id="table" class="table table-dark">
													<thead>
														<tr>
															<th scope="col">ID</th>
															<th scope="col">Username</th>
															<th scope="col">Needs</th>
															<th scope="col">Savings</th>
															<th scope="col">Wants</th>
															<th scope="col">Edit</th>
														</tr>
													</thead>
										<?php
											if($query_run){
											foreach($query_run as $row){
										?>
													<tbody>
														<tr>
															<td><?php echo $row['id']; ?></td>
															<td><?php echo $row['username']; ?></td>
															<td><?php echo $row['needs']; ?></td>
															<td><?php echo $row['savings']; ?></td>
															<td><?php echo $row['wants']; ?></td>
															<td>
																<button type="button" class="btn btn-warning editbtn"> EDIT </button>
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
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			<!--Modal for Users Edit-->						
	<div class ="modal fade" id="edituser" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="userid" id="userid">
							<div class="form-group">
							<label for="exampleInputuser">Username</label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
							</div>
							<div class="form-group">
							<label for="exampleInputpass">Needs</label>
							<input type="text" class="form-control" name="needs" id="needs" placeholder="Enter Needs Percent">
							</div>
							<div class="form-group">
							<label for="exampleInputpass">Savings</label>
							<input type="text" class="form-control" name="savings" id="savings" placeholder="Enter Savings Percent">
							</div>
							<div class="form-group">
							<label for="exampleInputpass">Wants</label>
							<input type="text" class="form-control" name="wants" id="wants" placeholder="Enter Wants Percent">
							</div> 
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="edituser" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
			<h3>User Password</h3>
			<? 	$username = $_SESSION["username"];
				$sql= "SELECT * FROM users";
				$query_run = mysqli_query($link, $sql);
			?>
					<table id="table" class="table table-dark">
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Password</th>
								<th scope="col">Edit</th>
							</tr>
						</thead>
			<?php
				if($query_run){
				foreach($query_run as $row){
			?>
						<tbody>
							<tr>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['password']; ?></td>
								<td>
								<button type="button" class="btn btn-warning editbtn4"> EDIT </button>
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
					
	<!--Modal for User Password Edit-->						
	<div class ="modal fade" id="editbudget4" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit User Entry</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name='update_password' id="update_password">
							<div class="form-group">
							<label for="exampleInputbuy">User Password</label>
							<input type="text" class="form-control" name="pword" id="pword" placeholder="Enter Password">
							</div>
							<div class="form-group">
							<br><br><br><br><br><br><br><br>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updatepassword" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
			
			<h3>Budget Data <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inspectbtn2">Inspect</button></h3>
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
		<!--Modal for Budget Inspect-->						
	<div class ="modal fade" id="inspectbtn2" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">All Budget Entries</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
								<? 	$username = $_SESSION["username"];
									$sql= "SELECT * FROM list";
									$query_run = mysqli_query($link, $sql);
								?>
										<table id="table" class="table table-dark">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col">User</th>
													<th scope="col">Item Name</th>
													<th scope="col">Item Cost</th>
													<th scope="col">Item Type</th>
													<th scope="col">Edit</th>
													<th scope="col">Delete</th>
												</tr>
											</thead>
								<?php
									if($query_run){
									foreach($query_run as $row){
								?>
											<tbody>
												<tr>
													<td><?php echo $row['id']; ?></td>
													<td><?php echo $row['username']; ?></td>
													<td><?php echo $row['buy']; ?></td>
													<td><?php echo $row['pay']; ?></td>
													<td><?php echo $row['type']; ?></td>
													<td>
														<button type="button" class="btn btn-warning editbtn2"> E </button>
													</td>
													<td>
														<button type="button" class="btn btn-danger deletebtn"> D </button>
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
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			
			<!--Modal for Budget Insert Edit-->						
	<div class ="modal fade" id="editbudget" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Budget Entry</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name="update_id" id="update_id">
							<div class="form-group">
							<label for="exampleInputbuy">What was bought</label>
							<input type="text" class="form-control" name="buy" id="buy" placeholder="Enter Item">
							</div>
							<div class="form-group">
							<label for="exampleInputpay">How much did it cost</label>
							<input type="text" class="form-control" name="pay" id="pay" placeholder="Enter Cost">
							</div>
							<label for="">Select Type</label> 
							<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="type" id="type">
								  <option value= "" >Select Type of Purchase</option>
								  <option value="needs">Needs</option>
								  <option value="savings">Savings</option>
								  <option value="wants">Wants</option>
							</select>
							<br><br><br><br><br><br><br><br>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updatebudget" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			
			<!--Modal for Budget Insert Delete-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Budget Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Are you sure you want to delete this data?</h4>
                    </div><br><br><br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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
								<th scope="col">Edit</th>
								<th scope="col">Delete</th>
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
								<button type="button" class="btn btn-warning editbtn3"> EDIT </button>
								</td>
								<td>
								<button type="button" class="btn btn-danger delete3"> DELETE </button>
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
			
	<!--Modal for Income Edit-->						
	<div class ="modal fade" id="editbudget3" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit User Entry</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input type="hidden" name='update_income' id="update_income">
							<div class="form-group">
							<label for="exampleInputbuy">User Income</label>
							<input type="text" class="form-control" name="income" id="income" placeholder="Enter Income">
							</div>
							<div class="form-group">
							<br><br><br><br><br><br><br><br>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updateincome" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
			</div>
			
			<!--Modal for User Income Delete-->
    <div class="modal fade" id="delete3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Budget Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_income" id="delete_income">

                        <h4> Are you sure you want to delete this data?</h4>
                    </div><br><br><br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="delete3" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>