<?php
include ("session-checker.php");
require_once "config.php";
//update
if(isset($_POST['btnsubmit']))
{
	$sql = "UPDATE accounttable SET password = ?, usertype = ? WHERE username = ?";
    if($stmt = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtpassword'],
        $_POST['cmbusertype'],  $_GET['username']);
        if(mysqli_stmt_execute($stmt))
        {
            echo("<script>alert('Account successfully updated!')</script>");
 			echo("<script>window.location = 'acc.php';</script>");
            exit();
        }
        else{
                echo "Error on update statement";
        } 
    }
}
//displaying value
else{
	if(isset($_GET['username']) && !empty(trim($_GET['username'])))
	{
		$sql = "SELECT * FROM accounttable WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "s", $_GET['username']);
			if(mysqli_stmt_execute($stmt)){
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) == 1){
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				}
				else{
					header("location: error.php");
					exit();
				}
			}
			else{
				echo "Error on select statement";
			}
		}
	}
	else{
		header("location: accounts.php");
	}
}
?>



<html>
	<title>Activate account</title>
<head>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
 	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<!--para automatic open ng modal-->
  	<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>

 </head>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">yo mama</button>-->
	<body>
		<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog modal-sm">
      	<div class="modal-content">
        <div class="modal-header">
        	<h4 class="modal-title">UPDATE ACCOUNT</h4>
        </div>
        <div class="modal-body">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <p>Edit the values and submit to update the account.</p>
		<form action = "<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method = "POST">
			Username: <?php echo $row['username']; ?> <br><br>
			Password: <input type = "password" name = "txtpassword" value = "<?php echo $row['password']; ?>" required><br><br>
			Current Usertype: <?php echo $row['usertype']; ?> <br><br>
			Select new Usertype: <select name = "cmbusertype" id = "cmbusertype" required>
			<option value = "">--Select Usertype--</option>
			<option value = "ADMINISTRATOR">Administrator</option>
			<option value = "TECHNICAL">Technical</option>
			<option value = "USER">User</option>
			</select><br><br>
			<input type = "submit" name = "btnsubmit" value = "Submit">
			<a href = "acc.php">Cancel</a>
		</form> 
		</div> 
		</div>
		</div>
		</div>

	</body>
</html>

<style>
	
</style>
