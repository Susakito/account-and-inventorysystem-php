<?php
	include("session-checker.php");
	require_once "config.php";
	$validate = " ";
	if(isset($_POST['btnsubmit']))
	{
		//check if the serialnum is existing
		$sql = "SELECT * FROM equipment WHERE serialnum = ?";
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "s", $_POST['txtserial_number']);
			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) != 1)
				{
					//insert new serialnum to the equipment table
					$sql = "INSERT INTO equipment VALUES (?, ?, ?, ?, ?, ?)";
					if($stmt = mysqli_prepare($link, $sql))
					{
						$status = "WORKING";
						mysqli_stmt_bind_param($stmt, "ssssss", $_POST['txtserialnumber'], $_POST['txtmodel'], $_POST['txtdescription'], $_POST['txtdepartment'], $status, $_SESSION['username']);
						if(mysqli_stmt_execute($stmt))
						{
							echo("<script>alert('Equipment successfully added!')</script>");
	 						echo("<script>window.location = 'tech.php';</script>");
							exit();
						}
						else{
							$validate = "Serial number already exists";
							echo("<script>alert('Serial number already exists')</script>");		
						}
					}
				}
				else
				{
					echo("<script>alert('Serial number already exists')</script>");		
				}
			}
			else{
				echo "Error on select statement";
			}
		}
	}
	?>






<html>
<head>
	<title>Update account</title>
	<style>
body
{
	background-image: url(bg.jpg);
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
}

p{
	font-size: 20px;
	color: black;
}

h1
{
	color: black;
}


input[type="text"]
{
	height: 40px;
	width: 250px;
	font-size: 18px;
	margin-bottom: 20px;
	background-color: #fff;
	padding-left: 10px;
}

.btnsubmit
{
	padding: 15px 25px;
	border: none;
	background-color: #27ae60;
	color: #fff;
}

a
{
	font-size: 20px;
	color: white;
}
	</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
</head>
<body>
	<center>
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	        <h4 class="modal-title">Update Equipment</h4>
	        </div>
	        <div class="modal-body">
		<p>Edit the values and submit to update the equipment.</p><br>
		<form action = "<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method = "POST">

			<p>Serial Number: <input type="text" name="txtserialnumber" placeholder="Serial Number" required></p>

			<div class="form-input">

				
				<p>Model: <select name = "txtmodel" id = "model" required></p>
				<option value = "">--Select Model--</option>
				<option value = "AVR">AVR</option>
				<option value = "CPU">CPU</option>
				<option value = "Keyboard">Keyboard</option>
				<option value = "MAC">MAC</option>
				<option value = "Monitor">Monitor</option>
				<option value = "Mouse">Mouse</option>
				<option value = "Printer">Printer</option>
				<option value = "Projector">Projector</option>
				<option value = "Speaker">Speaker</option>
			</select>

			<div class="form-input">
					<p>Description: <input type="text" name="txtdescription" placeholder="Description" required></p>
				</div>

		
		<p>Department: <select name = "txtdepartment" id = "txtdepartment" required>
			<option value = "">--Select Department--</option>
				<option value = "Faculty of Sacred Theology">Faculty of Sacred Theology</option>
				<option value = "Faculty of Philosophy">Faculty of Philosophy</option>
				<option value = "Faculty of Canon Law">Faculty of Canon Law</option>
				<option value = "Faculty of Civil Law">Faculty of Civil Law</option>
				<option value = "Faculty of Medicine & Surgery">Faculty of Medicine & Surgery</option>
				<option value = "Faculty of Pharmacy">Faculty of Pharmacy</option>
				<option value = "Faculty of Arts and Letters">Faculty of Arts and Letters</option>
				<option value = "Faculty of Engineering">Faculty of Engineering</option>
				<option value = "College of Education">College of Education</option>
				<option value = "College of Science">College of Science</option>
				<option value = "College of Architecture">College of Architecture</option>
				<option value = "College of Commerce and Business Administration">College of Commerce and Business Administration</option>
				<option value = "Graduate School">Graduate School</option>
				<option value = "Conservatory of Music">Conservatory of Music</option>
				<option value = "College of Nursing">College of Nursing</option>
				<option value = "College of Rehabilitation Sciences">College of Rehabilitation Sciences</option>
				<option value = "College of Fine Arts and Design">College of Fine Arts and Design</option>
				<option value = "Institute of Physical Education & Athletics">Institute of Physical Education & Athletics</option>
				<option value = "College of Accountancy">College of Accountancy</option>
				<option value = "College of Tourism & Hospitality Management">College of Tourism & Hospitality Management</option>
				<option value = "Institute of Information and Computing Sciences">Institute of Information and Computing Sciences</option>
				<option value = "Graduate School of Law">Graduate School of Law</option>
		</select>
		<br>
		<br>
		<br>
				<input type = "submit" name = "btnsubmit" value = "SUBMIT" class="btnsubmit"><br><br>
		<a href = "tech.php">Cancel</a>
			
				</form>
	        </div>
	      </div>
	    </div>
	  </div>	
	  </center>
	</body>
</html>