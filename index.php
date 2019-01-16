<?php


session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบลางาน</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="js/jquery.min.js"></script>


    <!-- <script src="js/bootstrap.min.js"></script>CSS-->
    <!-- data table-->
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.dataTables.min.css">
    <script type="text/javascript" src="js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" src="js/dataTables.responsive.min.js">
    </script>


    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="css/Roboto.css">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">


</head>

<body>

    <div id="shownav"></div>
    </div>

    <div class="page">

        <div id="header"></div>

        <div class="container-fluid text-center">
            <div class="row content">

                <div class="col-sm-12 ">
                    <div class="col-sm-12 ">
                        <br>


                        <div id="showmain"></div>
                    </div>




                </div>
            </div>
        </div>

    </div>



</body>

<script src="vendor/popper.js/umd/popper.min.js">
</script>
<script src="vendor/bootstrap/js/bootstrap.min.js">
</script>
<script src="js/grasp_mobile_progress_circle-1.0.0.min.js">
</script>
<script src="vendor/jquery.cookie/jquery.cookie.js">
</script>
<!--<script src="vendor/chart.js/Chart.min.js"></script>-->
<script src="vendor/jquery-validation/jquery.validate.min.js">
</script>
<script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
</script>
<!--<script src="js/charts-home.js"></script>-->
<!-- Main File-->
<script src="js/front.js">
</script>

</html>
<script type="text/javascript">
// $("#login_form").load("systems/login_form.php");
$("#showmain").load("systems/home.php");
$("#header").load("systems/navbar/header.php");
$("#shownav").load("systems/navbar/navbar.php");

/////session desyroy auto////
var IDLE_TIMEOUT = 180; //seconds
var _idleSecondsCounter = 0;
document.onclick = function() {
    _idleSecondsCounter = 0;
};
document.onmousemove = function() {
    _idleSecondsCounter = 0;
};
document.onkeypress = function() {
    _idleSecondsCounter = 0;
};
window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
    _idleSecondsCounter++;
    var oPanel = document.getElementById("SecondsUntilExpire");
    if (oPanel)
        oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {

        $(function() {

            $.post('systems/login/login_out_pro.php', {
                status: '1'
            }, function(data) {
                window.location = "http://127.0.0.1/test/systems/login/login_form.php";
                alert('เซสชั่นหมดอายุ!!');
            });

        });
    }
}
</script>