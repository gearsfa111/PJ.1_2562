<?php
include '../js/function_db.php';


session_start();
if (!isset($_SESSION["USER_ID"])) {
    ?>
<script src="systems/login/set_login_page.js"></script>
<script type="text/javascript">
//$("#showmain").load("systems/login/login_form.php");
login_page();
</script>
<?php } else if ($_SESSION["USER_TYPE"] == '3') {
    {?>
<script type="text/javascript">
$("#showmain").load("systems/user/user_show.php");
</script>
<?php }
} else if ($_SESSION["USER_TYPE"] == '1') {?>
<script type="text/javascript">
$("#showmain").load("systems/leave/leave_show.php");
</script>
<?php } else if ($_SESSION["USER_TYPE"] == '2') {?>
<script type="text/javascript">
$("#showmain").load("systems/leave_request/leave_request_show.php");
</script>
<?php
}?>