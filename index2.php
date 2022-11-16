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
	$username=($_SESSION["username"]);
	$buy = $_POST['buy'];
    $pay = $_POST['pay'];
    $type = $_POST['type'];	
		
	$sql = "INSERT INTO list (username, buy, pay, type) VALUES ('$username', '$buy', '$pay', '$type')";
	$query_run = mysqli_query($link, $sql);
	
	        if($query_run)
        {
            echo '<script> alert("Data Inserted"); </script>';
            header("Location:index2.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }}


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
	    <p><a href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>
	</p>
	
    	<h1 class="hello">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Here is your budget.</h1>
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
	
	<div class="card">
		<div class="card-body">
	<!--Fetches calculations based on account income and user needs percentage-->
	<?php 
		$username= $_SESSION['username'];
		$percent= 60;
		$sql= "SELECT users.username, users.needs, income.income, ROUND((needs/100)*income,2) AS user_needs 
		FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
		$query_run= mysqli_query($link, $sql);
			if($query_run){
			foreach($query_run as $row){
			$user_needs= $row['user_needs'];
			$user_needs2= ($percent / 100) * $user_needs;
			}}
	?>
	<?php
		$username= $_SESSION['username'];
		$sql= "SELECT list.type, list.pay, income.income, ROUND(SUM(pay),2) as sum_needs FROM list, income
		WHERE list.username = income.username AND list.username= '".$username."'  AND list.type='needs'";
		$query_run= mysqli_query($link, $sql);
			if($query_run){
				foreach($query_run as $row){
				$sum_needs= $row['sum_needs'];
				}}
			if($sum_needs < $user_needs2){
				echo '<i style="color:green;font-size:30px;">Needs: Limit not met </i>';
				$pro="progress-bar progress-bar-striped bg-success";
			} elseif($sum_needs > $user_needs2 && $sum_needs < $user_needs){
				echo '<i style="color:yellow;font-size:30px;">Needs: Close to Limit </i>';
				$pro="progress-bar progress-bar-striped bg-warning";
			} elseif ($sum_needs > $user_needs){
				echo '<i style="color:red;font-size:30px;">Needs: Limit Exceeded </i>';
				$pro="progress-bar progress-bar-striped bg-danger";
			} elseif ($sum_needs = $user_needs){
				echo '<i style="color:green;font-size:30px;">Needs: Limit Met </i>';
				$pro="progress-bar progress-bar-striped bg-success";
			}
			
			if($sum_needs > 0){
				echo "$sum_needs out of $user_needs";
				$bar= ($sum_needs/$user_needs) * 100;
				} else{
					echo 'More information needed. Please click "My Account" to add information';
				}
	?>
	<div class="progress" style="height: 30px;">
  		<div class="<?php echo $pro;?>" role="progressbar" style="width: <?php echo $bar;?>%" aria-valuenow=<?php echo $sum_needs ?> aria-valuemin="0" aria-valuemax=<?php echo $user_needs ?>><?php echo $sum_needs; ?></div>
			</div></div>
		
		<div class="card-body">
	<!--Fetches calculations based on account income and user savings percentage-->
	<?php 
		$username= $_SESSION['username'];
		$percent= 60;
		$sql= "SELECT users.username, users.savings, income.income, ROUND((savings/100)*income,2) AS user_savings 
		FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
		$query_run= mysqli_query($link, $sql);
		if($query_run){
		foreach($query_run as $row){
		$user_savings= $row['user_savings'];
		$user_savings2= ($percent / 100) * $user_savings;
		}}
	?>
	<?php
		$username= $_SESSION['username'];
		$sql= "SELECT list.type, list.pay, income.income, ROUND(SUM(pay),2) as sum_savings FROM list, income
		WHERE list.username = income.username AND list.username= '".$username."'  AND list.type='savings'";
		$query_run= mysqli_query($link, $sql);
			if($query_run){
			foreach($query_run as $row){
			$sum_savings= $row['sum_savings'];
				if($sum_savings < $user_savings2){
					echo '<i style="color:green;font-size:30px;">Savings: Limit not Met </i>';
					$pro2="progress-bar progress-bar-striped bg-success";
				} elseif ($sum_savings > $user_savings){
					echo '<i style="color:red;font-size:30px;">Savings: Limit Exceeded </i>';
					$pro2="progress-bar progress-bar-striped bg-danger";
				} elseif ($sum_savings = $user_savings){
					echo '<i style="color:green;font-size:30px;">Savings: Limit Met </i>';
					$pro2="progress-bar progress-bar-striped bg-success";
				} elseif ($sum_savings > $user_savings2 && $sum_savings < $user_savings){
					echo '<i style="color:yellow;font-size:30px;">Savings: Close to Limit </i>';
					$pro2="progress-bar progress-bar-striped bg-warning";
				}
			}}
			
			if($sum_savings > 0){
				echo "$sum_savings out of $user_savings";
				$bar2= ($sum_savings/$user_savings) * 100;
				} else{
					echo 'More information needed. Please click "My Account" to add information';
				}
	?>
	
	<div class="progress" style="height: 30px;">
  		<div class="<?php echo $pro2;?>" role="progressbar" style="width: <?php echo $bar2;?>%" aria-valuenow=<?php echo $sum_savings ?> aria-valuemin="0" aria-valuemax=<?php echo $user_savings ?>><?php echo $sum_savings; ?></div>
			</div></div>
	
	<div class="card-body">	
	<!--Fetches calculations based on account income and user wants percentage-->
	<?php 
		$username= $_SESSION['username'];
		$percent= 60;
		$sql= "SELECT users.username, users.wants, income.income, ROUND((wants/100)*income,2) AS user_wants 
		FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
		$query_run= mysqli_query($link, $sql);
		if($query_run){
		foreach($query_run as $row){
		$user_wants= $row['user_wants'];
		$user_wants2= ($percent / 100) * $user_wants;
		}}
	?>
	<?php
		$username= $_SESSION['username'];
		$sql= "SELECT list.type, list.pay, income.income, ROUND(SUM(pay),2) as sum_wants FROM list, income
		WHERE list.username = income.username AND list.username= '".$username."'  AND list.type='wants'";
		$query_run= mysqli_query($link, $sql);
		if($query_run){
		foreach($query_run as $row){
		$sum_wants= $row['sum_wants'];
			if($sum_wants < $user_wants2){
				echo '<i style="color:green;font-size:30px;">Wants: Limit not met </i>';
				$pro3="progress-bar progress-bar-striped bg-success";
			} elseif($sum_wants > $user_wants2 && $sum_wants < $user_wants){
				echo '<i style="color:yellow;font-size:30px;">Wants: Close to Limit </i>';
				$pro3="progress-bar progress-bar-striped bg-warning";
			} elseif ($sum_wants > $user_wants){
				echo '<i style="color:red;font-size:30px;">Wants: Limit Exceeded </i>';
				$pro3="progress-bar progress-bar-striped bg-danger";
			} elseif ($sum_wants = $user_wants){
				echo '<i style="color:green;font-size:30px;">Wants: Limit Met </i>';
				$pro3="progress-bar progress-bar-striped bg-success";
			} 
		}}
		
		if($sum_wants > 0){
			echo "$sum_wants out of $user_wants";
			$bar3= ($sum_wants/$user_wants) * 100;
			} else{
				echo 'More information needed. Please click "My Account" to add information';
			}
	?>
	
	<div class="progress" style="height: 30px;">
  		<div class="<?php echo $pro3;?>" role="progressbar" style="width: <?php echo $bar3;?>%" aria-valuenow=<?php echo $sum_wants ?> aria-valuemin="0" aria-valuemax=<?php echo $user_wants ?>><?php echo $sum_wants; ?></div>
	</div>
	</div>
	
	<div class="card-body">
		<h3 class="text-center">You Are Doing Great! Keep Going!</h3>
	</div></div>
</body>
</html>