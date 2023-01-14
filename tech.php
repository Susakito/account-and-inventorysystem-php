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
					<a href="create-eq-tech.php">Add new Equipment</a><br>
					<br><p>Search: <input type="text" name="txtsearch" placeholder="Input here">
					<input type="submit" name="btnsubmit" value="Find" class="btnsubmita"></p>
					<div class="indexbut">
					</div>
				</form>
				<center>
				<?php
				function build_table($result){
					if(mysqli_num_rows($result) > 0){
						//Table header
						echo "<table>";
						echo "<tr>";
						echo "<th>Serial#</th>";
						echo "<th>Model</th>";
						echo "<th>Description</th>";
						echo "<th>Department</th>";
						echo "<th>Status</th>";
						echo "<th>By</th>";
						echo "<th>Options</th>";
						echo "</tr>";
						echo "<br>";
						//Table data (loop each row of the result)
						while($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>" . $row['serialnum'] . "</td>";
							echo "<td>" . $row['model'] . "</td>";
							echo "<td>" . $row['description'] . "</td>";
							echo "<td>" . $row['dep'] . "</td>";
							echo "<td>" . $row['status'] . "</td>";
							echo "<td>" . $row['createdby'] . "</td>";
							echo "<td>";
							echo "<a href = 'update-eq-tech.php?serialnum=" . $row['serialnum'] . "'>Update </a>";
							echo "<a href = 'delete-eq-tech.php?serialnum=" . $row['serialnum'] . "'>Delete</a>";
							
								
							echo "</td>";
							echo "</tr>";
							echo "<br>";
						}
						echo "</table>";
					}
					else{
						echo "No user account/s found";
					}
				}
				require_once "config.php";
				//Search button
				if(isset($_POST['btnsubmit'])){
					$sql = "SELECT * FROM equipment WHERE serialnum <> ? AND serialnum LIKE ? OR model LIKE ? OR description LIKE ? OR dep LIKE ? ORDER BY serialnum";
					if($stmt = mysqli_prepare($link, $sql)){
						$search = '%' . $_POST['txtsearch'] . '%';
						mysqli_stmt_bind_param($stmt, "sssss", $search, $search, $search, $search, $search);
						if(mysqli_stmt_execute($stmt)){
							$result = mysqli_stmt_get_result($stmt);
							build_table($result);
						}
						else{
							echo "Error on search button";
						}
					}
				} 

				//Form load
				else
				{
					$sql = "SELECT * FROM equipment ORDER BY serialnum";
					if($stmt = mysqli_prepare($link, $sql))
					{
						
						if(mysqli_stmt_execute($stmt)){
							$result = mysqli_stmt_get_result($stmt);
							build_table($result);
						}
						else{
							echo "Error on form load";
						}
					}
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
