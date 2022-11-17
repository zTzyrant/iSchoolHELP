<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: ../login");
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
    <title>Dashboard</title>

    <!-- Favicons -->
    <link href="../assets/img/logois.png" rel="icon">
    <link href="../assets/img/apple-touch-iconis" rel="apple-touch-icon">

    <link rel="stylesheet" href="../assets/css/admindashboard.css">
    <!-- Bootsrapt -->
    <link rel="stylesheet" href="../assets/css/bootstrap52.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <!-- end Bootsrapt -->

    <!-- datatables -->
    <link rel="stylesheet" href="../assets/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/datatables/datatables.css">
    <!-- end datatables -->

   <!-- sweet alert -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Side bar -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <!-- Need Logo -->
                            <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""></a> 
                        </div>
                        <!-- toggle sidebar -->
                        <div class="sidebar-toggler x pointeri"> 
                            <a onclick="offsidebar()" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu mb-auto">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item active ">
                            <a href="admin" class='sidebar-link disabled'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a onclick="signoutvolun()" href="#" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </div>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Side bar -->
    

    <div id="main">
    
        <header class="mb-3 pointeri">
            <a onclick="onsidebar()" class="burger-btn d-block d-xl-none">
                <i class="bi bi-list"></i>
            </a>
        </header>


        <div class="page-heading">
            <h3>Dashboard <?php echo $_SESSION['fullname'] ?></h3>
        </div>

        <!-- cONTENT -->
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <!-- Container Center -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>View Requests</h4>
                                    <p>You can sort this table by school / by city / or by request date by click table header.</p>
                                </div>
                                <div class="card-body">
                                    <table id="table1" class="table overflow-auto" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Request ID</th>
                                                <th>School</th>
                                                <th>City</th>
                                                <th>Request Date</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include "../connector/connector.php";
                                                $query = ("SELECT * FROM `school` INNER JOIN request ON schoolid= schoolidkey INNER JOIN tutorialrequest ON request.requestid = tutorialrequest.idreqkey;");
                                                $result = mysqli_query($conn, $query);
                                                if ($result -> num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        if($row["requeststatus"] == "NEW"){
                                                            echo '<tr>';
                                                            echo '<td>'.$row["requestid"].'</td>';
                                                            echo '<td>'.$row["schoolname"].'</td>';
                                                            echo '<td>'.$row["city"].'</td>';
                                                            echo '<td>'.$row["requestdate"].'</td>';
                                                            echo '<td>'.$row["requeststatus"].'</td>';
                                                            echo '<td>'.$row["description"].'</td>';
                                                            echo '<td><button id="myInput" type="button" class="btn btn-outline-primary" onclick="window.location.href='."'requestdetails?viewid=". $row["requestid"] ."'".';">View Details</button></td>';
                                                            echo '</tr>';
                                                        }  
                                                    }
                                                }
                                            ?>           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container Center -->

                </div>
                <!-- right profile -->
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="../assets/img/img_avatar.png" alt="face">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold"><?php echo $_SESSION['fullname'] ?></h5>
                                    <h6 class="text-muted mb-0"><?php echo $_SESSION['username'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="font-bold"><?php echo $_SESSION['occupation'] ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['email'] ?></h6>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['dateofbirth'] ?></h6>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['phone'] ?></h6>
                        </div>
                    </div>

                </div>
                <!-- right profile -->
            </section>
        </div>
        <!-- content -->    
    
    </div>
                    
    
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <script src="../assets/js/signoutadm.js"></script>
    
    <script src="../assets/js/jquery-3.6.1.js" type="text/javascript"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
        $('#viewrequestdetails').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
    </script>
</body>
</html>