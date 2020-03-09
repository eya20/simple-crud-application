<?php
 include "connection.php" ;
 session_start();
 $first = $_POST['fname'];
 $last = $_POST['lname'];
 $cin = $_POST['cin'];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['add'])){
            $conn = connection();
            if ($conn){
                    $query = "INSERT INTO user (firstname, lastname,cin) 
                    VALUES(?,?,?)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$first, $last,$cin]);
                    $_SESSION["flash"] = ["type" => "success", "message" => "User added successfuly !"];
                    header('Location: /eya/templates/listUser.html.php');
                    //echo "User added successfuly ! ";
                    //echo "<a href=\"listUser.html.php\">Return to list of Users page </a>";
            }
        }
    }
    

?>