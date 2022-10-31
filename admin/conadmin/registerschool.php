<?php 

    include "../../connector/connector.php";

    session_start();
    if(isset($_SESSION['loginas']) === "admin"){
        header("location: ../../admin");
        exit();
    }

    $schoolname = $_POST['schoolname'];
    $address = $_POST['address'];
    $city = $_POST['city'];



    $sql = "INSERT INTO school (schoolid, schoolname, address, city)
    VALUES ('', '$schoolname', '$address', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
  
    $conn->close();

?>