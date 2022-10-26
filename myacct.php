<?php
session_start();

require_once "server.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['insertdata'])){
	$sql = "INSERT INTO income (username, income) VALUES (?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	}
	
	if($stmt = mysqli_prepare($link, $sql)){
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_income);

		// Set parameters
		$param_username = ($_SESSION["username"]);
		$param_income = $_POST['income'];

			if(mysqli_stmt_execute($stmt)){
				// Redirect to login page
				echo '<script> alert("Income Updated"); </script>';
				header("location: myacct.php");
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}
		// Close statement
		mysqli_stmt_close($stmt);
	} 
	if(isset($_POST['updatebudget'])){    
        $ide = $_POST['update_id'];
        $username = ($_SESSION["username"]);
        $income = $_POST['income'];
		
        $sql = "UPDATE income SET username='$username', income='$income' WHERE id='$ide'  ";
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
	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>My Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="acct.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script>
		    $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editincome').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
				$('#update_id').val(data[0]);
                $('#income').val(data[1]);
            });
        }); 
	</script>
<body>
	<div class="logout">
	<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
	</div>
	<div class="back">
	<a href="login.php" class="btn btn-danger ml-3">Back</a>
	</div><br><br>
	
	<div class="card-group">
  <div class="card">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135706.png" class="card-img-top" alt="income">
    <div class="card-body">
      <h5 class="card-title">Income</h5>
      <p class="card-text">Let us help you by inserting your income so that we can plan how you should spend your money based on the plan you have chosen.</p>
	  <p>Select the income button below to add your monthly income if one is not yet shown.</p>
	  <p class="card-text">The income amount you have inserted is</p>
		<? 	$username = $_SESSION["username"];
			$sql= "SELECT * FROM income WHERE username = '" . $username . "'";
			$query_run = mysqli_query($link, $sql);
		?>
			<table id="table" class="table table-dark">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Income</th>
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
						<td><?php echo $row['income']; ?></td>
						<td>
							<button type="button" class="btn btn-warning editbtn">Edit</button>
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
      <!-- Button trigger modal -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addincomemodal">
		Income</button>
    </div>
  </div>
  <div class="card">
    <img src="https://icons.veryicon.com/png/o/education-technology/management-icon/plan-28.png" class="card-img-top" alt="plan">
    <div class="card-body">
      <h5 class="card-title">Selected Plan</h5>
      <p class="card-text">Needs- This contains payments made that you absolutely must pay and are things necessary for survival such as Utilities, Healthcare, Insurance, etc.</p>
	  <p class="card-text">Savings- This contains the percentage ammount of money left over after your expenses are subtracted from your revenue. </p>
	  <p class="card-text">Wants- This contains payments made that better your life but that you can do without such as Hobbies, Vacations, Dining Out, etc.</p>
	  <p class="card-text">According to your plan, you chose to distribute you income as follows</p>
	  		<? 	$username = $_SESSION["username"];
			$sql= "SELECT * FROM users WHERE username = '" . $username . "'";
			$query_run = mysqli_query($link, $sql);
		?>
			<table id="table" class="table table-dark">
				<thead>
					<tr>
						<th scope="col">Needs</th>
						<th scope="col">Savings</th>
						<th scope="col">Wants</th>
					</tr>
				</thead>
	<?php
		if($query_run){
		foreach($query_run as $row){
	?>
				<tbody>
					<tr>
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
      <a href="myplan.php" class="btn btn-success" role="button">Change Plan</a>
    </div>
  </div>
  <div class="card">
    <img src="https://www.shareicon.net/data/2016/10/11/842409_interface_512x512.png" class="card-img-top" alt="progress">
    <div class="card-body">
      <h5 class="card-title">Progress</h5>
      <p class="card-text">We are here to help you every step of the way and in doing so we have created a way for you to check your progress based on the plan you have chosen for yourself </p>
      <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
		  <a href="index2.php" class="btn btn-success" role="button">Check Progress</a>
    </div>
  </div>
</div>
	

	<!--Modal-->
    <div class="modal fade" id="addincomemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Monthly Income</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Income</label>
                            <input type="text" name="income" class="form-control" placeholder="Enter your monthly income">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-success">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
	
<!--Modal for Edit-->						
	<div class ="modal fade" id="editincome" tabindex="-1" role="dialog" arialabelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Monthly Income</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="modal-body">
							<input  type="hidden" name="update_id" id="update_id">
							<div class="form-group">
							<label for="exampleInputbuy">Monthly Income (Leave Out Any Commas)</label>
							<input type="text" class="form-control" name="income" id="income" placeholder="Enter Monthly Income">
							</div>
							</div>
							<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updatebudget" class="btn btn-success">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
</body>
</html>