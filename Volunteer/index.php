<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: login");
    exit();
} else{
    if($_SESSION['loginas'] != 'volunteer'){
        header("location: ../login");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard <?php $_SESSION['username'] ?></title>
</head>
<body>
    welcome  
    <?php echo $_SESSION['idkey']?>
    
    <?php echo $_SESSION['dateofbirth']?>
    <?php echo $_SESSION['occupation'] ?>
    <a href="convolunteer/logout">Logout</a>

    <script>

    </script>
</body>
</html>