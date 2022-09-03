<?php
include('connection.php');

if (isset($_GET['id']) && $_GET['id']!='') {
    //Get submitted form
    $id=$_GET['id'];

    //Real Delete
// $sql = "DELETE FROM transaction WHERE id=$id";

//Soft Delete
$sql = "UPDATE transaction SET softdelete='1' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('location:index');
    }

}
?>