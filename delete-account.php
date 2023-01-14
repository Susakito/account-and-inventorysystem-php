<?php
require_once "config.php";
include ("session-checker.php");
if(isset($_POST['btnsubmit'])){
	$sql = "DELETE FROM accounttable WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", trim($_POST["username"]));
		if(mysqli_stmt_execute($stmt)){
			echo("<script>alert('Account Deleted')</script>");
 			echo("<script>window.location = 'acc.php';</script>");
			exit();
		}
		else{
			echo "Error on delete statement";
		}
	}
}
?>


<html>
	<title>Delete account</title>
	<head>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
 	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<!--para automatic open ng modal-->
  	<script type="text/javascript">
    $(window).on('load',function()
    {
        $('#myModal').modal('show');
    });
</script>
	</head>
	<body>
		<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog modal-sm">
      	<div class="modal-content">
        <div class="modal-header">
        	<h4 class="modal-title">DELETE?</h4>
        </div>
        <div class="modal-body">
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
			<input type = "hidden" name = "username" value = "<?php echo trim($_GET["username"]); ?>" />
			<p> Are you sure you want to delete this account? </p><br>
			<input type = "submit" name = "btnsubmit" value = "Yes">
			<a href = "acc.php">No</a>
		</form>
		</div> 
		</div>
		</div>
		</div>
	</body>
</html>

