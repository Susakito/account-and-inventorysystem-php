<?php
require_once "config.php";
include ("session-checker.php");
if(isset($_POST['btnsubmit'])){
	$sql = "UPDATE accounttable SET status = 'INACTIVE' WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", trim($_POST["username"]));
		if(mysqli_stmt_execute($stmt)){
			echo("<script>alert('Account Deactivated')</script>");
 			echo("<script>window.location = 'acc.php';</script>");
			exit();
		}
		else{
			echo "Error on update statement";
		}
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
        	<h4 class="modal-title">DEACTIVATE?</h4>
        </div>
        <div class="modal-body">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
			<input type = "hidden" name = "username" value = "<?php echo trim($_GET["username"]); ?>" />
			<p> Are you sure you want to deactivate this account? </p><br>
			<input type = "submit" name = "btnsubmit" value = "Yes">
			<a href = "acc.php">No</a>
		</form> 
		</div> 
		</div>
		</div>
		</div>

	</body>
</html>