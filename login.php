<?php
  	$error = " ";
  	if(isset($_POST['btnsubmit']))
  	{
	    require_once "config.php";
	    $sql = "SELECT * FROM accounttable WHERE username = ? and password = ? and status = 'ACTIVE'";
	    if($stmt = mysqli_prepare($link, $sql))
	    {
		    mysqli_stmt_bind_param($stmt, "ss", $_POST['txtusername'], $_POST['txtpassword']);
	    	if(mysqli_stmt_execute($stmt))
	    	{
	    		$result = mysqli_stmt_get_result($stmt);
	        	if(mysqli_num_rows($result) == 1)
	        	{
	        		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	        		session_start();
	        		$_SESSION['username'] = $_POST['txtusername'];
	        		$_SESSION['usertype'] = $row['usertype'];
	            	header("location: index.php");
	    		}
	    		else{
	            	$error = "Incorrect username or Password or Account is Inactive";
	    		}
	    	}
	    }
	    else{
	    		echo "Error on select statement";
	    }
	}

	/*$logged_in_user = mysqli_fetch_assoc($result);
	        		// IF ADMIN
	        		if($logged_in_user['usertype'] == 'ADMINISTRATOR')
	        		{
	        			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		        		session_start();
		        		$_SESSION[	'username'] = $_POST['txtusername'];
		        		$_SESSION['usertype'] = $_row['usertype']; 		
		            	header("location: index.php");
	        		}
	        		// IF TECHNICAL
	        		elseif($logged_in_user['usertype'] == 'TECHNICAL')
	        		{
	        			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		        		session_start();
		        		$_SESSION[	'username'] = $_POST['txtusername'];
		        		$_SESSION['usertype'] = $_row['usertype']; 		
		            	header("location: TECH.php");
	        		}

	        			elseif($logged_in_user['usertype'] == 'USER')
	        		{
	        			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		        		session_start();
		        		$_SESSION[	'username'] = $_POST['txtusername'];
		        		$_SESSION['usertype'] = $_row['usertype']; 		
		            	header("location: USER.php");
	        		}


	    		}*/
?>


<!DOCTYPE html>
<html>
	<div class="whole">
	<body>
		<!--
		<div id="taas">
			<p>testing</p>
		</div>
		-->
		<h1>DATABASE</h1>
		<div id = login>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

		<label>Username:<br></label>
	    <input type="text" name="txtusername" required size="50"><br><br>

	    <label>Password:<br></label>
	    <input type="password" name="txtpassword" required size="50"><br>

	    <div id = but>
	    <input type="submit" name = "btnsubmit" value="Submit" id = "yow">
		</div>

		</div>

	    <div id = "baba">
	    <p>Peter Piper picked a peck of pickled peppers
		A peck of pickled peppers Peter Piper picked
		If Peter Piper picked a peck of pickled peppers
		Where’s the peck of pickled peppers Peter Piper picked?</p>
		</div>
    
</form>
</body>
</div>
</div>
</html>	

<style>
	body
	{
		
		background-color: rgba(45,46,48);

	}

	label
	{
		font-size: 25px;

	}

	.whole
	{
		
		
		width: 600px;
		height: 550px;
		margin-left: 30%;
		margin-top: 5%;
		text-align: center;
	}

	h1
	{
		text-align: left;
		color: rgba(25,104,170);
		padding: 0px 0px 0px 0px;
		font-size: 50px;
	}

	#taas
	{
		padding: 0px 0px 0px 0px;
		text-align: left;
		font-size: 25px;
		color: rgba(25,104,170);
		
		

	}

	#login
	{
		height: 200px;
		text-align: left;
		padding-left: 15%;
		padding-top: 7%;
		border-radius: 25px;
		background-color: white;
	}

	

	#baba
	{
		text-align: center;
		font-size: 10px;
		color: white;
		background-color: rgba(45,46,48);
	}

	#yow
	{
		background-color: rgba(20,87,146);
		color: white;
		margin-left: 60%;
		margin-top: 3%;
	}

	
	
</style>