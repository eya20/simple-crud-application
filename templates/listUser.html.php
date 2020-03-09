<?php
 include "../connection.php";
 session_start();
 setcookie('user','super user');
 // get all users in database
 $conn = connection();
 $resultats = $conn->query('SELECT * FROM user ');
// On fouille le résultat pour en extraire les données réelles
  $resuls = $resultats->fetchAll();
  // display message successful update or add
  if (isset($_SESSION["flash"]))
{
    // display message of session
    echo "<div style='width:20%; position:relative; left:400px' class='alert alert-success' id='hiden'>";echo $_SESSION['flash']['message'];echo"</div>";
    unset($_SESSION["flash"]);
}
?>
<html>
    <head>
    <title>List of Users</title>
        <!-- add links of bootstrap and icons --> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
<body style="font-family: sans-serif; "> 
      <div class="container" >
        <br><br><h1 id="title">List of Users</h1><br>
        <a href="index.html" class="btn btn-success col-5 col-lg-2 col-md-3 col-sm-4"> Add new User </a> <br><br>
      <table class="table" > 
            <tr class="thead-light ">
                <th scope="col ">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Action</th>
            </tr>
            <!-- display all users in table -->
            <?php foreach ($resuls as $user): ?>
            <tr class="thead-light ">
                    <td scope="row"> <?php echo $user['id']; ?></td>
                    <td><?php echo $user['firstname']; ?></td>
                    <td><?php  echo $user['lastname']; ?></td>
                    <td> <a href="../delete.php?id=<?php echo $user['id']; ?>" onclick="return window.confirm(`Are you sure to delete this User ?!`)" ><i class="material-icons" onclick="return window.confirm(`Are you sure to delete this User ?!`)">restore_from_trash</i></a>
                    <a href="edit.html.php?id=<?php echo $user['id']; ?> "><i class="material-icons">edit</i></a> </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
   
 

</div>
</body>
<?php if ($_COOKIE['user'] == null): ?>
<footer name="footerCookies" id ="footerCookies" style="padding-top:130px">
        <div class="alert alert-success" role="alert">
         <p class="cookie" style="color:black;">This site use cookies
         <button class="btn btn-secondary" name="addcookie" onclick="hidecookie()">OK, undrestood</button>
         </p>                                       
         
        </div>
</footer>
<?php endif ?>

<!-- hide message of successful update or add -->
<script type="text/javascript">
var cookie = document.getElementById('footerCookies');
setTimeout(function(){ document.getElementById('hiden').style.display = 'none';
}, 1000);

function hidecookie(){
    //alert('function test');
    setTimeout(function(){ cookie.style.display = 'none';
}, 1000);
    
    
}

</script>

    


