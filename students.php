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
$sql_all_users = "SELECT * FROM table_the_iot_projects order by datetime desc";
$query_all = $conn->prepare($sql_all_users);
$query_all->execute();
$all_users = $query_all->fetchAll(PDO::FETCH_ASSOC); // Multiple rows

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/polygon/admindek/default/editable-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:09:43 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Kibogora Polytechnic | Admin</title>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">



    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="css/feather.css">

    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">

    <link rel="stylesheet" type="text/css" href="css/swiper.min.css">

    <link rel="stylesheet" type="text/css" href="css/icofont.css">

    <link rel="stylesheet" type="text/css" href="css/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome-n.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/pages.css">
    <link rel="stylesheet" type="text/css" href="css/widget.css">
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
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Students List Page</h5>
                                            <span>Welcome to Kibogora Polytechnic Admin Dashboard!</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb breadcrumb-title">
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

                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Student List</h5>

                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="example-2">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Card id</th>
                                                                <th>Student Name</th>
                                                                <th>Level of Year</th>
                                                                <th>Class</th>
                                                                <th>Photo</th>
                                                                <th>Payment Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($all_users)) : ?>
                                                                <?php foreach ($all_users as $index => $row) : ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $index + 1; ?></th>
                                                                        <td class="tabledit-view-mode">
                                                                            <span class="tabledit-span"><?php echo htmlspecialchars($row['id']); ?></span>

                                                                        </td>

                                                                        <td class="tabledit-view-mode">
                                                                            <span class="tabledit-span"><?php echo htmlspecialchars($row['name']); ?></span>

                                                                        </td>

                                                                        <td class="tabledit-view-mode">
                                                                            <span class="tabledit-span"><?php echo htmlspecialchars($row['year_of_study']); ?></span>
                                                                        </td>
                                                                        <td class="tabledit-view-mode">
                                                                            <span class="tabledit-span"><?php echo htmlspecialchars($row['class']); ?></span>

                                                                        </td>

                                                                        <td class="tabledit-view-mode">
                                                                            <?php if (!empty($row['photo'])) : ?>
                                                                                <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="User Photo" style="width: 80px; height: 80px; object-fit: cover;">
                                                                            <?php else : ?>
                                                                                <span>No Photo</span>
                                                                            <?php endif; ?>

                                                                        </td>

                                                                        <td class="tabledit-view-mode">
                                                                            <span class="tabledit-span">
                                                                                <?php
                                                                                if ($row['payment_status'] == 1) {
                                                                                    echo '<span class=" badge bg-success">Full payment</span>';
                                                                                } elseif ($row['payment_status'] == 2) {
                                                                                    echo '<span class="badge bg-warning">Partial Payment</span>';
                                                                                } else {
                                                                                    echo '<span class="badge bg-danger">No Payment</span>';

                                                                                }
                                                                                ?>
                                                                            </span>


                                                                        </td>
                                                                        <td class="tabledit-view-mode">
                                                                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                                                                <i class="fas fa-pen"></i>
                                                                            </a>
                                                                            <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>

                                                                        </td>

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

                                        <div>
                                            <table id="example-1">
                                            </table>
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
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/jquery.min.js"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/popper.min.js"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/bootstrap.min.js"></script>

    <script src="js/waves.min.js" type="1fe1b88cea5b2fe8354363ed-text/javascript"></script>

    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/jquery.slimscroll.js"></script>

    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/modernizr.js"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/css-scrollbars.js"></script>

    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/jquery.tabledit.js"></script>
    <!-- <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/editable.js"></script> -->

    <script src="js/pcoded.min.js" type="1fe1b88cea5b2fe8354363ed-text/javascript"></script>
    <script src="js/vertical-layout.min.js" type="1fe1b88cea5b2fe8354363ed-text/javascript"></script>
    <script src="js/jquery.mcustomscrollbar.concat.min.js" type="1fe1b88cea5b2fe8354363ed-text/javascript"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript" src="js/script.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="1fe1b88cea5b2fe8354363ed-text/javascript"></script>
    <script type="1fe1b88cea5b2fe8354363ed-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="js/rocket-loader.min.js" data-cf-settings="1fe1b88cea5b2fe8354363ed-|49" defer=""></script>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/editable-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:09:43 GMT -->

</html>