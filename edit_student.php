<?php
session_start();

require 'dbconn.php';

if (!isset($_SESSION["email"])) {
    header("Location: sign-in.php");
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


?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/polygon/admindek/default/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:09:14 GMT -->
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
    <script src="jquery.min.js"></script>

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
                                        <a href="index.php">
                                            <i class="feather icon-home bg-c-blue">
                                            </i>
                                        </a>
                                        <div class="d-inline">
                                            <h5>Edit Student Page</h5>
                                            <span>Welcome to Kibogora Polytechnic Admin Dashboard!</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb" style="margin-right: 1.5em;">
                                        <ul class="breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="#">/ Dashboard</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Check if the user ID is provided
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $userId = $_GET['id'];
                            // Fetch the user's details to edit
                            $sql_one_user = "SELECT * FROM table_the_iot_projects WHERE id = :id";
                            $query_all = $conn->prepare($sql_one_user);
                            $query_all->bindParam(':id', $userId, PDO::PARAM_INT);
                            $query_all->execute();
                            $one_user = $query_all->fetch(PDO::FETCH_ASSOC); // Single row for one user

                            if ($one_user) {
                        ?>

                                <div class="pcoded-inner-content">
                                    <div class="main-body">
                                        <div class="page-wrapper">
                                            <div class="page-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>Edit Student Form</h5>
                                                                <span>Add class of <code>.form-control</code> with
                                                                    <code>&lt;input&gt;</code> tag</span>
                                                            </div>
                                                            <div class="card-block">
                                                                <form method="post" action="insertDB.php" enctype="multipart/form-data" novalidate>
                                                                    <!-- Hidden input for student ID -->
                                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($one_user['id']); ?>">

                                                                    <div class="form-group row justify-content-center text-center">
                                                                        <?php if (!empty($one_user['photo'])) : ?>
                                                                            <img src="uploads/<?php echo htmlspecialchars($one_user['photo']); ?>" alt="User Photo" style="width: 100px; height: 100px; object-fit: cover;border-radius: 50%;">
                                                                        <?php else : ?>
                                                                            <span>No Photo</span>
                                                                        <?php endif; ?>
                                                                    </div>


                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Student Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control" id="names" name="name"
                                                                                value="<?php echo htmlspecialchars($one_user['name']); ?>">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Level of Study</label>
                                                                        <div class="col-sm-10">
                                                                            <select name="year_of_study" class="form-control">
                                                                                <option value="">Select the Level</option>
                                                                                <option value="First year" <?php echo ($one_user['year_of_study'] == 'First year') ? 'selected' : ''; ?>>First year</option>
                                                                                <option value="Second year" <?php echo ($one_user['year_of_study'] == 'Second year') ? 'selected' : ''; ?>>Second year</option>
                                                                                <option value="Third year" <?php echo ($one_user['year_of_study'] == 'Third year') ? 'selected' : ''; ?>>Third year</option>
                                                                                <option value="Fourth year" <?php echo ($one_user['year_of_study'] == 'Fourth year') ? 'selected' : ''; ?>>Fourth year</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Class</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control" id="class" name="class"
                                                                                value="<?php echo htmlspecialchars($one_user['class']); ?>">
                                                                            <span class="messages"></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Payment Status</label>
                                                                        <div class="col-sm-10">
                                                                            <select name="payment_status" class="form-control">
                                                                                <option value="opt1">Select fees status</option>
                                                                                <option value="1" <?php echo ($one_user['payment_status'] == '1') ? 'selected' : ''; ?>>Full Payment</option>
                                                                                <option value="2" <?php echo ($one_user['payment_status'] == '2') ? 'selected' : ''; ?>>Partial payment</option>
                                                                                <option value="3" <?php echo ($one_user['payment_status'] == '3') ? 'selected' : ''; ?>>No Payment</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2 col-form-label">Upload Photo</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="file" name="photo" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-sm-2"></label>
                                                                        <div class="col-sm-10">
                                                                            <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>


                    </div>

                    <div id="styleSelector">
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/jquery.min.js"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/popper.min.js"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/bootstrap.min.js"></script>

    <script src="js/waves.min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>

    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/jquery.slimscroll.js"></script>

    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/modernizr.js"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/css-scrollbars.js"></script>

    <script src="js/underscore-min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script src="js/moment.min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/validate.js"></script>

    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/form-validation.js"></script>
    <script src="js/pcoded.min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script src="js/vertical-layout.min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script src="js/jquery.mcustomscrollbar.concat.min.js" type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript" src="js/script.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
        type="9fef68816305b81b29a5d613-text/javascript"></script>
    <script type="9fef68816305b81b29a5d613-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="js/rocket-loader.min.js" data-cf-settings="9fef68816305b81b29a5d613-|49" defer=""></script>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:09:15 GMT -->

</html>