<?php

include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = $id";
$result = mysqli_query($con, $sql);

if($result){
    header("Location: index.php?message=User deleted successfully");
    exit;
}else {
    echo "Falied to delete user.";
}

?>