<?php
include '../../js/function_db.php';
date_default_timezone_set("Asia/Bangkok");
$APPROVE_DATE = date("Y-m-d");

session_start();

$maxAPPROVE_ID = " SELECT max(APPROVE_ID) as APPROVE_ID  FROM approve ";
$results = selectSql($maxAPPROVE_ID);
foreach ($results as $row) {
    $maxID = $row['APPROVE_ID'];
}

if ($maxID == null) {
    $APPROVE_ID = "A00001";
} else {
    $APPROVE_ID = substr($maxID, 1, 5) + 1;
    if ($APPROVE_ID < 10) {
        $APPROVE_ID = "A0000" . $APPROVE_ID;
    } else if ($APPROVE_ID < 100) {
        $APPROVE_ID = "A000" . $APPROVE_ID;
    } else if ($APPROVE_ID < 1000) {
        $APPROVE_ID = "A00" . $APPROVE_ID;
    } else if ($APPROVE_ID < 10000) {
        $APPROVE_ID = "A0" . $APPROVE_ID;
    } else if ($APPROVE_ID < 10000) {
        $APPROVE_ID = "A" . $APPROVE_ID;
    }
}

$sql = " INSERT INTO formleave (LEAVE_ID, USER_ID, START_DATE, END_DATE, CREATED_DATE,
TYPE_LEAVE, REASON_LEAVE)
VALUES ('" . $_POST['LEAVE_ID'] . "', '" . $_POST['USER_ID'] . "', '" . $_POST['START_DATE'] . "'
, '" . $_POST['END_DATE'] . "', '" . $_POST['CREATED_DATE'] . "', '" . $_POST['TYPE_LEAVE'] . "'
, '" . $_POST['REASON_LEAVE'] . "') ";
$rs = in_up_delSql($sql);

$sql1 = " INSERT INTO approve (APPROVE_ID, LEAVE_ID, APPROVE_DATE, USER_ID, APPROVE_STATUS)
VALUES ('" . $APPROVE_ID . "', '" . $_POST['LEAVE_ID'] . "', '" . $APPROVE_DATE . "'
, '" . $_POST['USER_ID'] . "', '0') ";
$rs1 = in_up_delSql($sql1);

$sql2 = " INSERT INTO notifications (id, LEAVE_ID, status) VALUES (NULL, '" . $_POST['LEAVE_ID'] . "', '0'); ";
$rs2 = in_up_delSql($sql2);
echo "OK";