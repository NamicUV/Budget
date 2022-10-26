<?php
 //Initialize the session
session_start();
 
 //Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
    header("login.php");
	exit;
}

//Include database connection file
require_once "server.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['insertdata'])){
	$sql = "INSERT INTO list (username, buy, pay, type) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	}
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_buy, $param_pay, $param_type);

		// Set parameters
		$param_username = ($_SESSION["username"]);
		$param_buy = $_POST['buy'];
		$param_pay = $_POST['pay'];
		$param_type = $_POST['type'];

			if(mysqli_stmt_execute($stmt)){
				// Redirect to login page
				header("location: login.php");
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		// Close statement
		mysqli_stmt_close($stmt);
	} 

	    if(isset($_POST['updatebudget']))
    {    

        $ide = $_POST['update_id'];
        $username = ($_SESSION["username"]);
        $buy = $_POST['buy'];
        $pay = $_POST['pay'];
        $type = $_POST['type'];

        $sql = "UPDATE list SET username='$username', buy='$buy', pay='$pay', type='$type' WHERE id='$ide'  ";
        $query_run = mysqli_query($link, $sql);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:index2.php");
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
			header("Location:index2.php");
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
	<link rel="stylesheet" href="index.css">
	<script src="senior.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
	        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editbudget').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#update_id').val(data[0]);
                $('#buy').val(data[1]);
                $('#pay').val(data[2]);
                $('#type').val(data[3]);
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
	</script>
</head>
<body>
	<p class="logout">
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    	<h1 class="hello">Hello, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Here is your budget.</h1>
    		<div class="row1">
  				<div class="column left" style="background-color:#aaa;">
    				<h2 class="acct">Budget</h2>
    				<a href="myplan.php" class="my1">My Plan</a><br>
					<a href="myacct.php" class="my1">My Account</a><br>
					<a href="myhistory.php" class="my1">My History</a>
  				</div>
  					<div class="column right" style="background-color:#bbb;">
    					<h2 class="month">This Month</h2>
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#budgetaddmodal">+</button>
	<!--Modal-->
	<div class ="modal fade" id="budgetaddmodal" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add to Budget</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
							<label for="exampleInputbuy">What was bought</label>
							<input type="text" class="form-control" name="buy" placeholder="Enter Item">
							</div>
							<div class="form-group">
							<label for="exampleInputpay">How much did it cost</label>
							<input type="text" class="form-control" name="pay" placeholder="Enter Cost">
							</div>
							<label for="">Select Type</label> 
							<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="type">
								  <option value= "" >Select Type of Purchase</option>
								  <option value="needs">Needs</option>
								  <option value="savings">Savings</option>
								  <option value="wants">Wants</option>
							</select>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="insertdata" class="btn btn-success">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
						
<!--Modal for Edit-->						
	<div class ="modal fade" id="editbudget" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Budget</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input  type="hidden" name="update_id" id="update_id">
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
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updatebudget" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>

<!--Modal for Delete-->
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
	<? 	$username = $_SESSION["username"];
		$sql= "SELECT * FROM list WHERE username = '" . $username . "'";
		$query_run = mysqli_query($link, $sql);
	?>
			<table id="table" class="table table-dark">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Item Name</th>
						<th scope="col">Item Cost</th>
						<th scope="col">Type</th>
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
						<td><?php echo $row['buy']; ?></td>
						<td><?php echo $row['pay']; ?></td>
						<td><?php echo $row['type']; ?></td>
						<td>
							<button type="button" class="btn btn-warning editbtn">Edit</button>
						</td>
						<td>
							<button type="button" class="btn btn-danger deletebtn">Delete</button>
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