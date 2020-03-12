<?php
 include "connection.php" ;
 session_start();
 $first = $_POST['fname'];
 $last = $_POST['lname'];
 $cin = $_POST['cin'];
 $photo =($_FILES["photo"]["name"]);
 $target_dir = 'templates/uploads/';
 $target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['add'])){
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        if(file_exists($target_file)) 
        {  
            $target_file = $target_dir.basename($first.".".$imageFileType);
        } 
            if ($uploadOk === 1){
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $conn = connection();
                    if ($conn){
                            $query = "INSERT INTO user (firstname, lastname,cin,photo) 
                            VALUES(?,?,?,?)";
                            $stmt = $conn->prepare($query);
                            $stmt->execute([$first, $last,$cin,$photo]);
                            $_SESSION["flash"] = ["type" => "success", "message" => "User added successfuly !"];
                            header('Location: /eya/templates/listUser.html.php');
                            //echo "User added successfuly ! ";
                            //echo "<a href=\"listUser.html.php\">Return to list of Users page </a>";
                    }
                } 
            }else {
                $_SESSION["fail"] = ["type" => "success", "message" => "Sorry, there was an error uploading your file, it support only jpeg,jpg, gif and png image."];
                header('Location: /eya/templates/index.html.php');
            }
        
            
        }
    }
    

?>