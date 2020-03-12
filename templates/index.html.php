<?php
session_start();
if (isset($_SESSION['fail'])){
	echo "<div style='width:20%; 
    position:relative; 
    left:500px;
    background-color:#CD5C5C; 
    color:white;
    border-radius: 3px;
	padding-left: 8px;'; 
	class='alert alert-danger' id='hiden'>"; echo $_SESSION['fail']['message']; echo"</div>";
	unset($_SESSION['fail']);
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add new user</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
		<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		rel="stylesheet">
	<!--===============================================================================================-->
</head>
<body style="font-family: sans-serif; background-image: url('bk.jpg');"> 
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="../addUser.php" method="POST" class="login100-form validate-form" enctype="multipart/form-data">
					<span style="font-family: Georgia, serif;" class="login100-form-title p-b-26">
						Add New User 
					</span>
					<span class="login100-form-title p-b-48">
						
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="fname" id="fname" required="required" >
						<span class="focus-input100" data-placeholder="Firstname"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="btn-show-pass">
							
						</span>
						<input class="input100" type="text" name="lname" id="fname" required="required">
						<span class="focus-input100" data-placeholder="Lastname"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="btn-show-pass">
							
						</span>
						<input class="input100" type="text" name="cin" id="cin" required="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8">
						<span class="focus-input100" data-placeholder="cin"></span>
					</div>
					
					<div class="custom-file" >
						<input class="input100" type="file" name="photo" id="photo" required="required" placeholder="Select File .." >
						
					</div>
			
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="add" id="add" onclick="controle()">
									Add New User
							</button>
						</div>
						<a href="listUser.html.php"><i class="material-icons">
							arrow_back
							</i></a>
					</div>
					

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- hide message of error upload photo -->
<script type="text/javascript">
setTimeout(function(){ document.getElementById('hiden').style.display = 'none';
}, 2000);
</script>

</body>
</html>