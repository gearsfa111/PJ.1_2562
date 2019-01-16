<?php
include '../../js/function_db.php';
session_start();
?>

<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                <img src="image/user/<?php if ($_SESSION['image'] != null) {echo $_SESSION['image'];} else { echo "
                    user.jpg"; } ?>" alt="person" class="img-fluid rounded-circle">
                <h2 class="h5">

                    <?php echo $_SESSION['name']; ?>

                </h2>
                <span>รหัสพนักงาน
                    <?php echo $_SESSION['USER_ID']; ?></span>
                <span>ฝ่าย
                    <?php echo $_SESSION['DEPARTMEMT_NAME']; ?></span>
                <span>ตำแหน่ง
                    <?php echo $_SESSION['POSITION_NAME']; ?></span>

            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo">
                <a href="index.html" class="brand-small text-center">
                    <strong>M</strong>
                    <strong class="text-primary">N</strong>
                </a>
            </div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Menu</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <?php if (isset($_SESSION["USER_ID"]) && ($_SESSION["USER_TYPE"] == '3')) {?>
                <li>
                    <a href="#" id="user_show">
                        <i class="icon-user"></i>จัดการข้อมูลพนักงาน</a>
                </li>


                <?php }?>


                <?php if ((isset($_SESSION["USER_ID"]) && ($_SESSION["USER_TYPE"] == '2'))) {

            $sql_count = " SELECT COUNT(*) count
            FROM formleave
            LEFT JOIN approve
            ON approve.LEAVE_ID = formleave.LEAVE_ID
            WHERE approve.APPROVE_STATUS = '0'";
            $rs = selectSql($sql_count);
            foreach ($rs as $row) {
            $count = $row['count'];
            } ?>
                <li>
                    <a href="#" id="leave_request">
                        <i class="fa fa-map-o"></i>คำขอลางาน
                        <?php if ($count > 0) {?>
                        <div class="badge badge-warning">
                            <?php echo $count; ?> Pending</div>
                        <?php }?>
                    </a>
                </li>

                <li>
                    <a href="#" id="report">
                        <i class="fa fa-bar-chart"></i>รายงาน
                    </a>
                </li>


                <?php }?>

                <?php if ((isset($_SESSION["USER_ID"]) && ($_SESSION["USER_TYPE"] == '1'))) {?>
                <li>
                    <a href="#" id="leave_show"><i class="fa fa-map-o"></i>ข้อมูลการลางาน</a>
                </li>
                <li>
                    <a href="#" id="leave_re_show"> <i class="fa fa-bar-chart"></i>รายงาน ประวัติการลา</a>
                </li>


                <?php }?>

            </ul>

        </div>
    </div>
</nav>

<script type="text/javascript">
$("*[id^=user_show]").click(function() {
    $("#showmain").load("systems/user/user_show.php");
});

$("*[id^=report]").click(function() {
    $("#showmain").load("systems/leave_request/report_show.php");
});

$("*[id^=leave_request]").click(function() {
    $("#showmain").load("systems/leave_request/leave_request_show.php");
});

$("*[id^=leave_show]").click(function() {
    $("#showmain").load("systems/leave/leave_show.php");
});


$("*[id^=leave_re_show]").click(function() {
    $("#showmain").load("systems/leave/report_show.php");
});
</script>