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
                        
                        <li class="sidebar-item active">
                            <a href="dashboard/registerschool" class='sidebar-link disabled '>
                            <i class="bi bi-file-plus-fill"></i>
                                <span>Register School</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="submitreq" class='sidebar-link'>
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
                    <div class="card-header">
                        <h4 class="card-title">Select Register For</h4>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="selectformtype">Register for</label>
                            <select class="form-select" id="selectformtype">
                                <option value="1">School</option>
                                <option value="2">School Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            

                            <!-- Form School & School Administrator  -->
                            <form class="form" id="form1" onsubmit="return false" method="POST">
                                <h4 class="card-title">Register School</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-schname" class="form-label">School Name</label>
                                            <input type="text" id="col-schname" class="form-control" placeholder="School Name" name="schoolname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-schaddress" class="form-label">School Address</label>
                                            <input type="text" id="col-schaddress" class="form-control" placeholder="School Address" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-city" class="form-label">City</label>
                                            <input type="text" id="col-city" class="form-control" placeholder="City" name="city" required>
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

                            <!-- School Administrator -->
                            <form class="form" id="form2" style="display: none;" onsubmit="return false" method="POST">
                                <h4 class="card-title">Register School Administrator</h4>
                                    <div class="form-group">
                                        <label class="form-label">Select School</label>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupSelect01">School</label>
                                            <select class="form-select" id="inputGroupSelect01" required>
                                                <option value="0" selected hidden>Select Register for</option>
                                                <?php 
                                                    include "../connector/connector.php";
                                                    $query = ("SELECT * FROM `school`");
                                                    $result = mysqli_query($conn, $query);

                                                    if ($result -> num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            echo '<option value="'.$row["schoolname"].'">'.$row["schoolname"].'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-uname" class="form-label">Username</label>
                                            <input id="col-uname" type="text"  class="form-control" placeholder="Username" name="col-uname">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-pass" class="form-label">Password</label>
                                            <input type="password" id="col-pass" class="form-control" placeholder="Password" name="col-pass">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-fullname" class="form-label">Fullname</label>
                                            <input type="text" id="col-fullname" class="form-control" name="col-fullname" placeholder="Fullname">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-email" class="form-label">Email</label>
                                            <input type="text" id="col-email" class="form-control" name="col-email" placeholder="Email@example.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-phone" class="form-label">Phone</label>
                                            <input type="number" id="col-phone" class="form-control" name="col-phone" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="col-pos" class="form-label">Position</label>
                                            <input type="text" id="col-pos" class="form-control" name="col-pos" placeholder="Position">
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                                </div> 
                            </form>
                            <!-- Form School & School Administrator  -->

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
                                <h4>School List</h4>
                            </div>
                            <div class="card-body">
                                <table id="schooltblionreg" class="table overflow-auto" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>School Name</th>
                                            <th>City</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            include "../../connector/connector.php";
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
                                <button type="button" class="btn btn-outline-primary float-end">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container Center -->

            </div>
        </section>
    </div>
    <!-- content -->
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/dashboard.js"></script>

    
    <script src="../../assets/js/signoutadm.js"></script>

    <script src="../../assets/js/jquery-3.6.1.js" type="text/javascript"></script>
    <script src="../../assets/js/datatables.min.js"></script>
    <script src="../../assets/js/datatables.js"></script>
    <script src="../../assets/js/regschool.js"></script>


    

</body>
</html>