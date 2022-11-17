<?php 
session_start();

if(($_SESSION["username"]) === NULL){
    header("location: ../login");
    exit();
} else{
    if($_SESSION['loginas'] != 'admin'){
        header("location: ../login");
        exit();
    } else{
        include "../../connector/connector.php";

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
    <link href="../../assets/img/logois.png" rel="icon">
    <link href="../../assets/img/apple-touch-iconis" rel="apple-touch-icon">

    <link rel="stylesheet" href="../../assets/css/admindashboard.css">
    <!-- Bootsrapt -->
    <link rel="stylesheet" href="../../assets/css/bootstrap52.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-icons.css">
    <!-- end Bootsrapt -->

    <!-- datatables -->
    <link rel="stylesheet" href="../../assets/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables/datatables.css">
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
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="../" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item ">
                            <a href="registerschool" class='sidebar-link '>
                            <i class="bi bi-file-plus-fill"></i>
                                <span>Register School</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="submitreq" class='sidebar-link disabled'>
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
                            <a onclick="insignoutadm()" href="#" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
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

        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12 col-lg-9">
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body">
                                

                                <!-- Form School & School Administrator  -->
                                <form class="form" id="form1" onsubmit="return false" method="POST">
                                    <h4 class="card-title">Submit Request</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="desc" class="form-label">Description</label>
                                                <input type="text" id="desc" class="form-control" placeholder="Description" name="desc" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="datetutor" class="form-label">Date Tutorial</label>
                                                <input type="date" id="datetutor" class="form-control" placeholder="Date Tutor" name="datetutor" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="timetutor" class="form-label">Time Tutorial</label>
                                                <input type="time" id="timetutor" class="form-control" placeholder="Time" title="example: 10:00 AM" name="timetutor" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="studentlevel" class="form-label">Student Level</label>
                                                <input type="text" id="studentlevel" class="form-control" placeholder="Student Level" name="studentlevel" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="nos" class="form-label">Num of Student</label>
                                                <input type="text" id="nos" class="form-control" placeholder="Num of Student" name="nos" required>
                                            </div>
                                        </div>

                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group form-check form-switch">
                                                    <input id="additionalreq" class="form-check-input" type="checkbox" id="addresource">
                                                    <label class="form-check-label" for="addresource">Additional Resource Request</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12" id="addrq1" style="display: none;">
                                            <div class="form-group">
                                                <label for="resourcetype" class="form-label">Resource Type</label>
                                                <input type="text" id="resourcetype" class="form-control" placeholder="Resource Type" name="resourcetype" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" id="addrq2" style="display: none;">
                                            <div class="form-group">
                                                <label for="numrequired" class="form-label">Number Required</label>
                                                <input type="text" id="numrequired" class="form-control" placeholder="Number Required" name="numrequired" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1" id="form1_submit">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1" id="form1_submit">Reset</button>
                                        </div>
                                    </div>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
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
                                        <img src="../../assets/img/img_avatar.png" alt="face">
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
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->

        <!-- cONTENT -->
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    
                    <!-- Container Center -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Request List</h4>
                                </div>
                                <div class="card-body">
                                    <table id="tabletutorialrequest" class="table overflow-auto" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Request Date</th>
                                                <th>Request Status</th>
                                                <th>Description</th>

                                                <th>Proposed Date</th>
                                                <th>Proposed Time</th>
                                                <th>Student Level</th>
                                                <th>Num of Student</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include "../../connector/connector.php";
                                                $query = ("SELECT * FROM request INNER JOIN tutorialrequest ON request.requestid = tutorialrequest.idreqkey;");
                                                $result = mysqli_query($conn, $query);

                                                if ($result -> num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo '<tr>';
                                                        echo '<td>'.$row["requestid"].'</td>';
                                                        echo '<td>'.$row["requestdate"].'</td>';
                                                        echo '<td>'.$row["requeststatus"].'</td>';
                                                        echo '<td>'.$row["description"].'</td>';
                                                        echo '<td>'.$row["proposeddate"].'</td>';
                                                        echo '<td>'.$row["proposetime"].'</td>';
                                                        echo '<td>'.$row["studentlevel"].'</td>';
                                                        echo '<td>'.$row["numstudent"].'</td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-outline-success float-end" onClick="window.location.reload();">Refresh Table</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container Center -->

                </div>
            </section>
        </div>

    </div>
    <script src="../../assets/js/jquery-3.6.1.js" type="text/javascript"></script>
    <!-- content -->    
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/dashboard.js"></script>

    
    <script src="../../assets/js/signoutadm.js"></script>
    


    

    <!-- submit request js -->
    <script src="../../assets/js/subreq.js"></script>


    <script src="../../assets/js/datatables.min.js"></script>
    <script src="../../assets/js/datatables.js"></script>



    

</body>
</html>