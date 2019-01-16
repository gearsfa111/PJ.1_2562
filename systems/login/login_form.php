<script src="systems/login/set_login_page.js"></script>
<?php
include '../../js/function_db.php';
//include '../js/session_check.php';
session_start();
if (isset($_SESSION["USER_ID"])) {
    ?>
<script src="set_login_page.js"></script>

<script>
    //$("#showmain").load("systems/login_form.php");
//window.location = "http://127.0.0.1/test";
home_page();
</script>
<?php
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../../css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="../../css/Roboto.css">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="../../css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="page login-page">
        <div class="container">
            <div class="form-outer text-center d-flex align-items-center">
                <div class="col-md-12">
                    <div class="form-inner">
                        <div class="logo text-uppercase"><span>Sing</span><strong class="text-primary">In</strong></div>
                        <p>ระบบลางานในองค์กรธุรกิจ</p>
                        <div class="" id="validate"></div>
                        <form method="get" class="text-left form-validate">

                            <div class="form-group-material">
                                <input type="text" id="username" name="username" required data-msg="กรุณากรอก Username"
                                    class="input-material">
                                <label for="login-username" class="label-material">Username</label>

                            </div>
                            <div class="form-group-material">
                                <input type="password" id="password" name="password" required data-msg="กรุณากรอก Password"
                                    class="input-material">
                                <label for="login-password" class="label-material">Password</label>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" id="oklogin" class="btn btn-primary">Login</button>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->

    <script src="../../js/jquery.min.js"></script>
    <script src="../../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="../../../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="../../js/front.js"></script>
</body>

</html>

<script>
$(function() {
    $('#oklogin').click(function() {

        $.post('login_pro.php', {
            username: $('#username').val(),
            password: $('#password').val()

        }, function(data) {

            if (data == 'OK') {
                location.reload();

            } else {
                //alert('ไม่สามารถ เข้าสู่ระบบได้');
                $('#validate').html(data);
            }
        });
    });
});
</script>