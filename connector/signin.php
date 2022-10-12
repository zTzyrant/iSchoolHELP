<?php 
    include 'connector.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "<script type='text/javascript'>alert('$username');</script>";
?>