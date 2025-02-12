<?php
session_start();

require 'dbconn.php';

if (!isset($_SESSION["email"])) {
    header("Location: ../index.php");
    exit();
}

$userid = $_SESSION["email"];
if (isset($_SESSION["email"])) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $query = $conn->prepare($sql);
    $query->execute(array($userid));
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $result->name;
        }
    }
}
// Fetch all users to display in the table
$sql_all_users = "SELECT DISTINCT t.name, t.id, t.year_of_study, t.class, t.photo, t.payment_status, r.datetime
FROM report r 
JOIN table_the_iot_projects t ON t.id = r.sid order by datetime DESC";
$query_all = $conn->prepare($sql_all_users);
$query_all->execute();
$all_users = $query_all->fetchAll(PDO::FETCH_ASSOC); // Multiple rows


?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Kibogora Polytechnic | Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="css/feather.css">

    <link rel="stylesheet" type="text/css" href="css/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="css/icofont.css">

    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/datatables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.datatables.min.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.datatables.min-2.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/pages.css">
</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?php include 'Layouts/Navbar.php' ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php include 'Layouts/Sidebar.php' ?>

                    <div class="pcoded-content">

                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-server bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Exam Attendance Page</h5>
                                            <span>Welcome to Kibogora Polytechnic Admin Dashboard!</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="#">/ Dashboard</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="card">
                                                    <div class="card-header table-card-header">
                                                        <h5>Exam Attendance</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Reg Number</th>
                                                                        <th>Student Name</th>
                                                                        <th>Level of Year</th>
                                                                        <th>Class</th>
                                                                        <th>Payment Status</th>
                                                                        <th>Attendance</th>
                                                                        <th>Date & Time</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php if (!empty($all_users)) : ?>
                                                                        <?php foreach ($all_users as $index => $row) : ?>
                                                                            <tr>
                                                                                <th scope="row"><?php echo $index + 1; ?></th>
                                                                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                                                <td><?php echo htmlspecialchars($row['year_of_study']); ?></td>
                                                                                <td><?php echo htmlspecialchars($row['class']); ?></td>
                                                                                <td>
                                                                                    <?php
                                                                                    if ($row['payment_status'] == 1) {
                                                                                        echo "Full payment";
                                                                                    } elseif ($row['payment_status'] == 2) {
                                                                                        echo "Partial payment";
                                                                                    } else {
                                                                                        echo "No payment";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                                                                                                
                                                                                <td>
                                                                                    <?php
                                                                                    if ($row['payment_status'] == 1) {
                                                                                        echo '<span class="badge badge-success">Allowed</span>';
                                                                                    } elseif ($row['payment_status'] == 2) {
                                                                                        echo '<span class="badge badge-danger">Not Allowed</span>';
                                                                                    } else {
                                                                                        echo '<span class="badge badge-danger">Not Allowed</span>';
                                                                                    }
                                                                                    ?>

                                                                                </td>

                                                                                <td><?php echo htmlspecialchars($row['datetime']); ?></td>

                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <td colspan="8">No data available.</td>
                                                                        </tr>
                                                                    <?php endif; ?>


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div id="styleSelector">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="46fdda76826106b979343b7a-text/javascript" src="js/jquery.min.js"></script>
    <script type="46fdda76826106b979343b7a-text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="46fdda76826106b979343b7a-text/javascript" src="js/popper.min.js"></script>
    <script type="46fdda76826106b979343b7a-text/javascript" src="js/bootstrap.min.js"></script>

    <script src="js/waves.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>

    <script type="46fdda76826106b979343b7a-text/javascript" src="js/jquery.slimscroll.js"></script>

    <script type="46fdda76826106b979343b7a-text/javascript" src="js/modernizr.js"></script>
    <script type="46fdda76826106b979343b7a-text/javascript" src="js/css-scrollbars.js"></script>

    <script src="js/jquery.datatables.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/datatables.buttons.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/jszip.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/pdfmake.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/vfs_fonts.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/datatables.buttons.min-2.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/buttons.flash.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/jszip.min-2.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/vfs_fonts-2.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/buttons.colvis.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/buttons.print.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/buttons.html5.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/datatables.bootstrap4.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/datatables.responsive.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/responsive.bootstrap4.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>

    <script src="js/extension-btns-custom.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/pcoded.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/vertical-layout.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script src="js/jquery.mcustomscrollbar.concat.min.js" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script type="46fdda76826106b979343b7a-text/javascript" src="js/script.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="46fdda76826106b979343b7a-text/javascript"></script>
    <script type="46fdda76826106b979343b7a-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="js/rocket-loader.min.js" data-cf-settings="46fdda76826106b979343b7a-|49" defer=""></script>
</body>

</html>