<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
$sql = " DELETE FROM user WHERE user.USER_ID = '" . $_POST['id'] . "' ";
$rs = in_up_delSql($sql);

echo "OK";
