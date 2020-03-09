<?php 
include "connection.php";


$id = $_GET['id'];
$conn = connection();

if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$query = $conn->prepare('SELECT * FROM user WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
    die("L'article .$id. n'existe pas, vous ne pouvez donc pas le supprimer !");
}

$query = $conn->prepare('DELETE FROM user WHERE id = :id');
$query->execute(['id' => $id]);

header("Location: /eya/templates/listUser.html.php");
exit();