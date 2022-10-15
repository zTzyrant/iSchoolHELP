<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: login");
    exit();
} else{
    if($_SESSION['loginas'] != 'admin'){
        header("location: login");
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
    
    <?php echo $_SESSION['staffid']?>
    <?php echo $_SESSION['position'] ?>
    <?php echo $_SESSION['schoolidkey'] ?>
    <a href="conadmin/logout">Logout</a>

    <script>

    </script>
</body>
</html>