<?php 
session_start();  

require 'dbconn.php'; 

if (!isset($_SESSION["email"])) {
  header("Location: sign-in.php"); 
  exit();
}

$userid=$_SESSION["email"];
 if(isset($_SESSION["email"]))  
 {  
  $sql="SELECT * FROM users WHERE email = ?";
  $query=$conn->prepare($sql);
  $query->execute(array($userid));
  $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount()>0){
    foreach ($results as $result) {
       $result->name;
       
    }
  }
  
  }  
 
?>

<!DOCTYPE html>
<html lang="en">

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

                        <?php include 'Layouts/Content.php' ?>

                    </div>
                </div>
            </div>


            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/jquery.min.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/jquery-ui.min.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/popper.min.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/bootstrap.min.js"></script>

            <script src="js/waves.min.js" type="c7bcae0684be40f056d5ef21-text/javascript"></script>

            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/jquery.slimscroll.js"></script>

            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/modernizr.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/css-scrollbars.js"></script>

            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/owl.carousel.min.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/owl-custom.js"></script>

            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/swiper.min.js"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/swiper-custom.js"></script>
            <script src="js/pcoded.min.js" type="c7bcae0684be40f056d5ef21-text/javascript"></script>
            <script src="js/vertical-layout.min.js" type="c7bcae0684be40f056d5ef21-text/javascript"></script>
            <script src="js/jquery.mcustomscrollbar.concat.min.js"
                type="c7bcae0684be40f056d5ef21-text/javascript"></script>

            <script type="c7bcae0684be40f056d5ef21-text/javascript" src="js/script.js"></script>

            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
                type="c7bcae0684be40f056d5ef21-text/javascript"></script>
            <script type="c7bcae0684be40f056d5ef21-text/javascript">
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'UA-23581568-13');
            </script>
            <script src="js/rocket-loader.min.js" data-cf-settings="c7bcae0684be40f056d5ef21-|49" defer=""></script>
</body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/slider.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:09:06 GMT -->

</html>