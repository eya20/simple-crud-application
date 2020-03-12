<?php
include "../connection.php";
session_start();
$id = $_GET['id'];
$conn = connection();
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$query = $conn->prepare('SELECT * FROM user WHERE id = :id');
 $query->execute(['id' => $id]);
$user = $query->fetch();

?>
<!doctype html>
<html>
<head>
    <title><?php echo $user['firstname']." ".$user['lastname'] ?></title>
    <!-- links of bootstrap and icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" />    
</head>
<body>
    <div class="container">
        <?php if ($user['photo']) :?>
            <img src="uploads/<?php echo $user['photo'] ?>" alt="<?php echo $user['firstname'] ?>'s photo" class="img-thumbnail profil">
        <?php endif ?>
        <div style="display:inline-block;">
        <h1>Hi <?php echo $user['firstname'] ?> ! </h1>
        <table class="table details">
            <tr><th>Firstname :</th><td><?php echo $user['firstname'] ?></td></tr>
            <tr><th>Lastname :</th><td><?php echo $user['lastname'] ?></td></tr>
            <tr><th>CIN :</th><td><?php echo $user['cin'] ?></td></tr>
            <tr><th><a href="listUser.html.php" class="btn btn-primary">Go Back to list of users </a></th>
            <th><a class="btn btn-success" href="edit.html.php?id=<?php echo $id ?>">Edit</a></th></tr>
        </table>
        </div>
    </div>
</body>

</html>