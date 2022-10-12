<?php 
include 'connector.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$occupation = $_POST['occupation'];
$date = $_POST['dob'];
$newDate = date("Y-m-d", strtotime($date));

$sql = "INSERT INTO user (id, username, password, fullname, email, phone)
VALUES ('', '$username', '$password', '$fullname', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $grabvolunteer = "INSERT INTO volunteer (idkey, dateofbirth, occupation) 
    VALUES ('$last_id', '$newDate', '$occupation')";
    if ($conn->query($grabvolunteer) === TRUE) {
        echo "success add volunteer";
    } else{
        echo "Error: " . $grabvolunteer . "<br>" . $conn->error;
    }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>