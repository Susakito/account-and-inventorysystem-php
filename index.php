

</body>
</html>

<html>
<head>
	<title>Account Management</title>
	<link rel="stylesheet" a href="style69.css">
	<link rel="stylesheet" a href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<center>
	<div class="container">
		<img src="pic.png">
		
			<div class="top">
				<?php
				session_start();
				if(isset($_SESSION['username'])){ ?>
					<div class = "header">
					<h1><?php echo "Welcome, " . $_SESSION['username']; ?> </h1>
					<h3> <?php echo "Usertype: " . $_SESSION['usertype']; ?> </h3>
					
					</div>
				<?php
				}
				else{
					header("location: login.php");
				}
				?>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<a href="logout.php">Logout</a><br>
					<div class="indexbut">
					
					</div>
				</form>


				<center>

				
				
					<?php
						
						if((isset($_SESSION['usertype']) && $_SESSION['usertype'] == "ADMINISTRATOR")){?>
					    	<div class = indexbut><a href="acc.php" style="margin:10px;">Accounts Table</a>
							<a href="equip.php" style="margin:10px;">Equipment Table</a></div>
							<?php
						}

						elseif((isset($_SESSION['usertype']) && $_SESSION['usertype'] == "TECHNICAL")){?>
					    	<div class = indexbut><a href="tech.php" style="margin:10px;">Equipment Table</a></div>
							<?php
						}

						elseif((isset($_SESSION['usertype']) && $_SESSION['usertype'] == "USER")){?>
					    	<div class = indexbut><a href="user.php" style="margin:10px;">Equipment Table</a></div>
							<?php
						}

				?>

				</center>
			</div>
	</center>

		
	</body>
</html>

<style>
	/* FOR BUTTONS */
	.indexbut a:hover, a:active 
	{
		background-color: red;
	}

	.indexbut a:link, a:visited 
	{
	  background-color: rgba(20,87,146);
	  padding: 5px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  border-style: solid;
	  border-radius: 10px;
	  	
	}

	
</style>
