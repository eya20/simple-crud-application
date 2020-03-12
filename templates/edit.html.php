<?php
	include "../connection.php";
	session_start();
	// geting id from url
	$id = $_GET['id'];
	// connection to the database
	$conn = connection();
	// verify if id exist or not
    if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
        die("Ho ?! Tu n'as pas précisé l'id de l'article !");
	}
	// query to get user's information
    $query = $conn->prepare('SELECT * FROM user WHERE id = :id');
     $query->execute(['id' => $id]);
    $user = $query->fetch();
         $first = $_POST['fname'];
		 $last = $_POST['lname'];
		 $cin = $_POST['cin'];
		 $photo =($_FILES["photo"]["name"]);
		 $target_dir = 'uploads/';
		 $target_file = $target_dir . basename($_FILES["photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		 
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['update'])){
						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
						&& $imageFileType != "gif" ) {
							$uploadOk = 0;
						}
					if ($uploadOk === 1){
						// upload photo
						if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
							//update user's information 
							if ($conn){ 
								$query2  = $conn->prepare(" UPDATE user SET firstname= :first, lastname= :last, cin= :cin, photo= :photo  WHERE id= :id");
								$query2->bindParam(":id",$id);
								$query2->bindParam(":first",$first);
								$query2->bindParam(":last",$last);
								$query2->bindParam(":cin",$cin);
								$query2->bindParam(":photo",$photo);
								$query2->execute();
								$_SESSION["flash"] = ["type" => "success", "message" => "Update successful !"];
								header('Location: listUser.html.php');
							}
							
					    }
					}else {
						// send message if the image can't not uploaded
						$_SESSION["failed"] = ["type" => "success", "message" => "Sorry, there was an error uploading your file, it support only jpeg,jpg, gif and png image"];
						header('Location: /eya/templates/edit.html.php?id='.$id);
					}
					// if there is no image, will update other informations in database 
					if (!$photo){
						if ($conn){ 
							$query2  = $conn->prepare(" UPDATE user SET firstname= :first, lastname= :last, cin= :cin  WHERE id= :id");
							$query2->bindParam(":id",$id);
							$query2->bindParam(":first",$first);
							$query2->bindParam(":last",$last);
							$query2->bindParam(":cin",$cin);
							$query2->execute();
							$_SESSION["flash"] = ["type" => "success", "message" => "Update successful !"];
							header('Location: listUser.html.php');
						}
					}
                }
			} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update Infos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
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
<body style="font-family: sans-serif;;"> 
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" class="login100-form validate-form" enctype="multipart/form-data">
					<h3 style="font-family: Georgia, serif;" class="login100-form-title p-b-26">
						Update Infos
		</h3>
					<span class="login100-form-title p-b-48">
					
					</span>

					<div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="fname" id="fname" value="<?php echo $user['firstname'] ?>" required="required">
						<span class="focus-input100"  ></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="btn-show-pass">
							
						</span>
						<input class="input100" type="text" name="lname" id="fname" value="<?php echo $user['lastname'] ?>" required="required">
						<span class="focus-input100" ></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="btn-show-pass">
							
						</span>
						<input class="input100" type="text" name="cin" id="cin" required="required" value="<?php echo $user['cin'] ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="8">
						<span class="focus-input100" ></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<input type="file" id="photo" name="photo" style="display: none;" />
						<input  class="btn btn-secondary" type="button" value="<?php if ($user['photo']){
						echo $user['photo']; }else { echo "browse ..."; }  ?> " onclick="document.getElementById('photo').click();" />
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="update" id="update">
									Update
							</button>
						</div>
						<a href="listUser.html.php"><i class="material-icons">arrow_back</i></a>
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

	<script type="text/javascript">
	// put as value in photo's input the name of image 
    var filename = '<?php echo $user['photo']; ?>';
    document.getElementById('photo').value=filename; 
	// hide error's message of uploading image 
	setTimeout(function(){ document.getElementById('hiden').style.display = 'none';}, 2000);
</script>

</body>
</html>