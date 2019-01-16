<?php
include '../../js/function_db.php';
session_start();
?>
<script src="systems/login/set_login_page.js"></script>
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a id="toggle-btn" href="#" class="menu-btn">
                        <i class="icon-bars"> </i>
                    </a>
                    <a href="index.html" class="navbar-brand">
                        <div class="brand-text d-none d-md-inline-block">
                            <span><b>
                                    <font size="4px" color="">ระบบลางาน </font></span>
                            <strong class="text-primary">ในองค์กรธุรกิจ</strong>
                        </div>
                    </a>
                </div>

                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                    <!-- vvvแจ้งเตือน-->


                    <?php if ($_SESSION["USER_TYPE"] == '2') {?>
                    <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i>

                            <span class="badge badge-warning count"></span>

                        </a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>

                    <?php }?>
                    <!-- ^^^แจ้งเตือน-->



                    <!-- Log out-->

                    <?php if (isset($_SESSION["USER_ID"])) { ?>
                    &nbsp;&nbsp;

                    <li class="nav-item">
                        <a href="#" id="oklogout" class="">
                            <span class="d-none d-sm-inline-block">ออกจากระบบ <i class="fa fa-sign-out"></i></span>

                        </a>
                    </li>



                    <?php }?>

                </ul>
            </div>
        </div>
    </nav>
</header>





<script>
$(function() {
    $('#oklogout').click(function() {
        $.post('systems/login/login_out_pro.php', {
            status: '1'
        }, function(data) {
            $('#showmain').load('systems/login/login_form.php');


            login_page(); //systems/login/set_login_page.js

        });
    });
});



$(document).ready(function() {

    function load_unseen_notification(view = '') {
        $.ajax({
            url: "systems/navbar/fetch.php",
            method: "POST",
            data: {
                view: view
            },
            dataType: "json",
            success: function(data) {
                $('.dropdown-menu').html(data.notification);
                if (data.unseen_notification > 0) {
                    $('.count').html(data.unseen_notification);
                }
            }
        });
    }

    load_unseen_notification();


    $(document).on('click', '.nav-link', function() {
        $('.count').html('');
        load_unseen_notification('yes');
    });

    setInterval(function() {
        load_unseen_notification();;
    }, 5000);

});
</script>