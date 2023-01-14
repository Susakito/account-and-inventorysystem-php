
<html>
<title>Accont Panel</title>
<head>
	
</head>
<body>
	<div class = "whole2">
	<h1>Not a Phising Site</h1>
	<div class = "whole">	
	<?php
		session_start();
		if(isset($_SESSION['username']))
		{
			?> <h2 id = "username"> <?php echo "Welcome, " . $_SESSION['username']; ?> </h2>
			<!--<h3> <?php echo "Usertype:" . $_SESSION['usertype']; ?> </h3>--> <?php

		}
		else
		{
			header("location: login.php");
		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<a href="logout.php">Logout</a>
	<br>
	<a href="create-account.php">Add new user</a>
	<br>
	Search:<input type="text" name="txtsearch">
	<input type="submit" name="btnsubmit" value="Submit">
	<br>
	</form>


	<div id = "tablee">
	
	<?php
	function build_table($result)
	{
		if(mysqli_num_rows($result) > 0)
		{
			//table header 
			echo "<table>";
			echo "<tr>";
			echo "<th>Username</th>";
			echo "<th>Usertype</th>";
			echo "<th>Status</th>";
			echo "<th>Created by</th>";
			echo "</tr>";
			echo "<br>";
			//table data (loop each row of the result)
			while($row = mysqli_fetch_array($result))
			{  
				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>"; 
				echo "<td>" . $row['usertype'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['createdby'] . "</td>";
				echo "<td>";
				echo "<br>";

				echo "<a href='update-account.php?username=" . $row['username'] . "'>Update</a>"; echo "   ";
				echo "<a href='activate-account1.php?username=" . $row['username'] . "'>Activate</a>"; echo "   ";
				echo "<a href='deactivate-account1.php?username=" . $row['username'] . "'>Deactivate</a>"; echo "   ";
				echo "<a href='delete-account.php?username=" . $row['username'] . "'>Delete</a>";
				echo "</td>";
				echo "</tr>";
				echo "<br>";
				
			}
			echo "</table>";
		} 

	
		else
		{
			echo "No user account/s found";
		}
	} 
	

	

	require_once "config.php";
	//search button

	if(isset($_POST['btnsubmit']))
		{
			$sql = "SELECT * FROM accounttable WHERE username <> ? AND username LIKE ? OR usertype LIKE ? ORDER BY username";
			if($stmt = mysqli_prepare($link, $sql))
			{
				$search = '%' . $_POST['txtsearch'] . '%';
				mysqli_stmt_bind_param($stmt, "sss", $_SESSION['username'], $search, $search);
				if(mysqli_stmt_execute($stmt))
				{
					$result = mysqli_stmt_get_result($stmt);
					build_table($result);
				}	
				else
				{
					echo "Error on search button";
				}
			}
		}

	//form load
	
	else
	{
		$sql = "SELECT * FROM accounttable WHERE username <> ? ORDER BY username";
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);
				build_table($result);
			}
			else
			{
				echo "Error on form load";
			}
		}
	
	}

	?>
	</div>
	</div>
	<p style="color: white; font-size: 10px">Peter Piper picked a peck of pickled peppers
		A peck of pickled peppers Peter Piper picked
		If Peter Piper picked a peck of pickled peppers
		Where’s<br> the peck of pickled peppers Peter Piper picked?</p>
	</div>

	



</body>
</html>

<style>
	body
	{
		background-color: rgba(45,46,48);
	}

	.whole2
	{
		width: 800px;
		height: 650px;
		
		text-align: center;
		margin-left: 22%;
	}

	h1
	{
		text-align: left;
		color: rgba(25,104,170);
		font-size: 50px;
		
		margin-top: 0%;
		margin-bottom: 0%;
		margin-left: 6%;
	}

	#username
	{
		font-size: 45;
		margin-bottom: 0%;
	}

	.whole
	{
		width: 700px;
		height: 450px;
		margin-left: 6.5%;
		margin-top: 0%;
		text-align: center;
		background-color: white;
		border-radius: 25px; 
		
	}

	form
	{
		margin-top: 5%;
		margin-left: 3%;
		text-align: left;
		font-size: 20px;
	}

	table
	{
		
		text-align: center;
		padding-left: 5.5%;
		padding-top: 0px;
			
	}

</style>

	