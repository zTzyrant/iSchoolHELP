<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: login");
    exit();
} else{
    if($_SESSION['loginas'] != 'admin'){
        header("location: login");
        exit();
    } else{
        include "../connector/connector.php";

        $query = ("SELECT * from school where schoolid='". $_SESSION['schoolidkey'] . "'");
        $result = mysqli_query($conn, $query);

        if ($result -> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['schoolname'] = $row["schoolname"];
                $_SESSION['address'] = $row["address"];
                $_SESSION['city'] = $row["city"];
        
            }
        }
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard <?php echo $_SESSION['username'] ?></title>
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
                            <a href="dashboard/registerschool" class='sidebar-link'>
                            <i class="bi bi-file-plus-fill"></i>
                                <span>Register School</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="dashboard/submitreq" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Submit Request</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-journal-check"></i>
                                <span>Review Offers</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a onclick="signoutadm()" href="#" class='sidebar-link'>
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
            <h3>Dashboard <?php echo $_SESSION['position'] ?></h3>
        </div>

        <!-- cONTENT -->
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">

                    <!-- TEST    -->
                    <div class="row">
                        <div class="col-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="card-header">
                                            <h4>School List</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="schooltbl" class="table overflow-auto" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>School Name</th>
                                                        <th>City</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        include "../connector/connector.php";
                                                        $query = ("SELECT * FROM `school`");
                                                        $result = mysqli_query($conn, $query);

                                                        if ($result -> num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo '<tr>';
                                                                echo '<td>'.$row["schoolname"].'</td>';
                                                                echo '<td>'.$row["city"].'</td>';
                                                                echo '<td>'.$row["address"].'</td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-outline-primary float-end">Register School</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right row -->
                        <div class="col-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="card-header">
                                            <h4>Request List</h4>
                                        </div>
                                        <div class="card-body">
                                            <table id="reqtbl" class="table overflow-auto" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        include "../connector/connector.php";
                                                        $query = ("SELECT * FROM `request`");
                                                        $result = mysqli_query($conn, $query);

                                                        if ($result -> num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                echo '<tr>';
                                                                echo '<td>'.$row["requestid"].'</td>';
                                                                echo '<td>'.$row["requestdate"].'</td>';
                                                                echo '<td>'.$row["requeststatus"].'</td>';
                                                                echo '<td>'.$row["description"].'</td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-outline-primary float-end">Add Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Container Center -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>ISchool Admin List</h4>
                                </div>
                                <div class="card-body">
                                    <table id="table1" class="table overflow-auto" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Position</th>
                                                <th>School Name</th>
                                                <th>City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include "../connector/connector.php";
                                                $query = ("SELECT * FROM school INNER JOIN schooladmin ON school.schoolid = schooladmin.schoolidkey INNER JOIN user ON schooladmin.idkey = user.id;");
                                                $result = mysqli_query($conn, $query);
                                                if ($result -> num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo '<tr>';
                                                        echo '<td>'.$row["staffid"].'</td>';
                                                        echo '<td>'.$row["fullname"].'</td>';
                                                        echo '<td>'.$row["email"].'</td>';
                                                        echo '<td>'.$row["position"].'</td>';
                                                        echo '<td>'.$row["schoolname"].'</td>';
                                                        echo '<td>'.$row["city"].'</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            ?>           
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-outline-primary float-end">Add</button>
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
                            <h5 class="font-bold"><?php echo $_SESSION['schoolname'] ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['position'] ?></h6>
                            <h6 class="text-muted mb-0"><?php echo $_SESSION['email'] ?></h6>
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

    

</body>
</html>