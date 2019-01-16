<?php
include '../../js/function_db.php';
session_start();
$sql = " DELETE FROM formleave WHERE formleave.LEAVE_ID = '" . $_POST['id'] . "' ";
$rs = in_up_delSql($sql);
$sql1 = " DELETE FROM approve WHERE approve.LEAVE_ID = '" . $_POST['id'] . "' ";
$rs1 = in_up_delSql($sql1);

echo "OK";