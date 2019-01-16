<?php

session_start();
if (!isset($_SESSION["USER_ID"])){
?>
  <script type="text/javascript">
   // $("#showmain").load("/systems/login_form.php");
    //window.location="http://127.0.0.1/test/systems/login_form.php";
  </script>

  <?php
}

 ?>
