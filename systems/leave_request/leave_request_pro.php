<?php
include '../../js/function_db.php';
session_start();
if (isset($_POST['APPROVE_STATUS'])) {
    $sql = " UPDATE approve SET  APPROVE_STATUS = '" . $_POST['APPROVE_STATUS'] . "'
	WHERE approve.LEAVE_ID = '" . $_POST['LEAVE_ID'] . "' ";

    $rs = in_up_delSql($sql);
    echo "OK";
}