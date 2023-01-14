
<html>
<title>Add new account</title>
<body>
<div class="wholeouter">
<h1>DATABASE</h1>
<div class="wholeouter2">
<p style="font-style: italic;"><br>Fill up this form and submit to add a new user.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div class="wholein">
	Username: <input type = "text" name = "txtusername" required><br><br>	
	Password: <input type = "password" name = "txtpassword" required><br><br>
	User type: <select name = "cmbusertype" id = "cmbusertype" required>
		<option value = "">--Select Usertype--</option>
		<option value = "ADMINISTRATOR">Administrator</option>
		<option value = "TECHNICAL">Technical</option>
		<option value = "USER">User</option>
	</select><br><br>
	<input type = "submit" name = "btnsubmit" value = "Submit">
	<a href = "acc.php">Cancel</a>
	</div>
</form>



<?php
include("session-checker.php");
require_once "config.php";
if(isset($_POST['btnsubmit']))
{
	//check if the username is existing
	$sql = "SELECT * FROM accounttable wHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt, "s", $_POST['txtusername']);
		if(mysqli_stmt_execute($stmt))
		{
			$result = mysqli_stmt_get_result($stmt);
			if(mysqli_num_rows($result) != 1)
			{
				//insert new user to the accounts table
				$sql = "INSERT INTO accounttable VALUES (?, ?, ?, ?, ?)";
				if($stmt = mysqli_prepare($link, $sql))
				{
					$status = "ACTIVE";
					mysqli_stmt_bind_param($stmt, "sssss", $_POST['txtusername'], $_POST['txtpassword'], $_POST['cmbusertype'], $status, $_SESSION['username']);
					if(mysqli_stmt_execute($stmt))
					{
						echo("<script>alert('Account successfully created!')</script>");
 						echo("<script>window.location = 'acc.php';</script>");
						exit();
					}
					else{
						echo "Error on insert statement";
					}
				}
			}
			else{
				echo "User already exists";
			}
		}
		else{
			echo "Error on select statement";
		}
	}
}
?>
</div>
<p style="color: white; font-size: 10px">Peter Piper picked a peck of pickled peppers
		A peck of pickled peppers Peter Piper picked
		If Peter Piper picked a peck of pickled peppers
		Where’s<br> the peck of pickled peppers Peter Piper picked?</p>


</body>
</html>

<style>

	body
	{
		background-color: rgba(45,46,48);
	}

	h1
	{
		text-align: left;
		color: rgba(25,104,170);
		font-size: 50px;
		
		margin-top: 0%;
		margin-bottom: 0%;
		margin-left: 25%;
	}

	.wholeouter2
	{
		width: 700px;
		height: 450px;
		margin-left: 25%;
		margin-top: 2%;
		text-align: center;
		background-color: white;
		border-radius: 25px; 
		font-size: 25px;


	}

	.wholein
	{
		
		
		font-size: 25px;
		margin-top: 10%;
	}

	p
	{
		text-align: center;
		margin-left: -5%;
	}
</style>
