<?php
session_start();

require_once "server.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['insertdata'])){
	$username=($_SESSION["username"]);
	$income = $_POST['income'];
		
	$sql = "INSERT INTO income (username, income) VALUES ('$username', '$income')";
	$query_run = mysqli_query($link, $sql);
	
	        if($query_run)
        {
            echo '<script> alert("Income Updated"); </script>';
            header("Location:myacct.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }}

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
	
	<div class="card-deck">
  <div class="card">
    <img src="https://cdn-icons-png.flaticon.com/512/2037/2037015.png" alt="income">
    <div class="card-body">
      <h4 class="card-title">Income</h4>
      <p class="card-text">Let us help you by inserting your monthly income so that we can plan how you should spend your money based on the plan you have chosen.</p>
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
    </div>
		 <!-- Button trigger modal -->
		<div class="card-footer">
		  <small class="d-grid gap-2 d-md-flex justify-content-md-center"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addincomemodal">
			Income</button></small>
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
		
		
  <div class="card">
    <img src="https://cdn-icons-png.flaticon.com/512/2036/2036910.png"  alt="plan">
    <div class="card-body">
      <h4 class="card-title">Selected Plan</h4>
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
    </div>
	  	<div class="card-footer">
      		<small class="d-grid gap-2 d-md-flex justify-content-md-center"><a href="myplan.php" class="btn btn-success" role="button">Change Plan</a></small>
    	</div>
</div>
  	<div class="card">
		<img src="https://cdn-icons-png.flaticon.com/512/2037/2037085.png" alt="progress">
		<div class="card-body">
	  	<h4 class="card-title">Progress</h4>
	  	<p class="card-text">We are here to help you every step of the way and in doing so we have created a way for you to check your progress based on the plan you have chosen for yourself </p>
		<h5>Needs (The max you should be spending on needs):
			<?php 
				$username= $_SESSION['username'];
				$percent= 60;
				$sql= "SELECT users.username, users.needs, income.income, ROUND((needs/100)*income,2) AS user_needs 
				FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
				$query_run= mysqli_query($link, $sql);
					if($query_run){
					foreach($query_run as $row){
					echo $row['user_needs']; 
					$user_needs= $row['user_needs'];
					$user_needs2= ($percent / 100) * $user_needs;
					}}
			?> </h5>
			<h6>Current Status:
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
						echo '<i style="color:green;font-size:30px;"> Limit not met </i>';
					} elseif($sum_needs > $user_needs2 && $sum_needs < $user_needs){
						echo '<i style="color:yellow;font-size:30px;"> Close to Limit </i>';
					} elseif ($sum_needs > $user_needs){
						echo '<i style="color:red;font-size:30px;"> Limit Exceeded </i>';
					} elseif ($sum_needs = $user_needs){
						echo '<i style="color:green;font-size:30px;"> Limit Met </i>';
					}
				?> </h6>
		<h5>Savings (The max you should be spending on savings):
			<?php 
				$username= $_SESSION['username'];
				$percent= 60;
				$sql= "SELECT users.username, users.savings, income.income, ROUND((savings/100)*income,2) AS user_savings 
				FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
				$query_run= mysqli_query($link, $sql);
				if($query_run){
				foreach($query_run as $row){
				echo $row['user_savings']; 
				$user_savings= $row['user_savings'];
				$user_savings2= ($percent / 100) * $user_savings;
				}}
			?> </h5>
			<h6>Current Status:
				<?php
				$username= $_SESSION['username'];
				$sql= "SELECT list.type, list.pay, income.income, ROUND(SUM(pay),2) as sum_savings FROM list, income
				WHERE list.username = income.username AND list.username= '".$username."'  AND list.type='savings'";
				$query_run= mysqli_query($link, $sql);
					if($query_run){
					foreach($query_run as $row){
					$sum_savings= $row['sum_savings'];
						if($sum_savings < $user_savings2){
							echo '<i style="color:green;font-size:30px;"> Limit not Met </i>';
						} elseif ($sum_savings > $user_savings){
							echo '<i style="color:red;font-size:30px;"> Limit Exceeded </i>';
						} elseif ($sum_savings = $user_savings){
							echo '<i style="color:green;font-size:30px;"> Limit Met </i>';
						} elseif ($sum_savings > $user_savings2 && $sum_savings < $user_savings){
							echo '<i style="color:yellow;font-size:30px;"> Close to Limit </i>';
						}
					}}
				?></h6>
		<h5>Wants (The max you should be spending on wants):
			<?php 
				$username= $_SESSION['username'];
				$percent= 60;
				$sql= "SELECT users.username, users.wants, income.income, ROUND((wants/100)*income,2) AS user_wants 
				FROM users, income WHERE users.username = income.username AND users.username = '" . $username . "'";
				$query_run= mysqli_query($link, $sql);
				if($query_run){
				foreach($query_run as $row){
				echo $row['user_wants']; 
				$user_wants= $row['user_wants'];
				$user_wants2= ($percent / 100) * $user_wants;
				}}
			?></h5>
			<h6>Current Status:
			<?php
				$username= $_SESSION['username'];
				$sql= "SELECT list.type, list.pay, income.income, ROUND(SUM(pay),2) as sum_wants FROM list, income
				WHERE list.username = income.username AND list.username= '".$username."'  AND list.type='wants'";
				$query_run= mysqli_query($link, $sql);
				if($query_run){
				foreach($query_run as $row){
				$sum_wants= $row['sum_wants'];
					if($sum_wants < $user_wants2){
						echo '<i style="color:green;font-size:30px;"> Limit not met </i>';
					} elseif($sum_wants > $user_wants2 && $sum_wants < $user_wants){
						echo '<i style="color:yellow;font-size:30px;"> Close to Limit </i>';
					} elseif ($sum_wants > $user_wants){
						echo '<i style="color:red;font-size:30px;"> Limit Exceeded </i>';
					} elseif ($sum_wants = $user_wants){
						echo '<i style="color:green;font-size:30px;"> Limit Met </i>';
					}
				}}
				?></h6>	  	
		</div>
		    <div class="card-footer">
      			<small class="d-grid gap-2 d-md-flex justify-content-md-center"><a href="index2.php" class="btn btn-success" role="button">Check Progress</a></button></small>
    		</div>
	  </div>
</div>
	


		
</body>
</html>