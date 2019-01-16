<?php
include '../../js/function_db.php';
session_start();
$_POST['START_DATE'];
$_POST['END_DATE'];

$START_DATE_M = substr($_POST['START_DATE'], 5, 2);
$END_DATE_M = substr($_POST['END_DATE'], 5, 2);

if ($START_DATE_M == "01" || ($START_DATE_M == "03") || ($START_DATE_M == "05") || ($START_DATE_M == "07")
    || ($START_DATE_M == "08") || ($START_DATE_M == "10") || ($START_DATE_M == "12")) {
    $maxDay = 31;
} else if (($START_DATE_M == "02")) {
    $maxDay = 28;
} else if (($START_DATE_M == "04") || ($START_DATE_M == "06") || ($START_DATE_M == "09") || ($START_DATE_M == "11")) {
    $maxDay = 30;
}
//echo $maxDay;
$START_DATE = substr($_POST['START_DATE'], 8, 8);
$END_DATE = substr($_POST['END_DATE'], 8, 8);
if ($START_DATE > $END_DATE) {
    $n = 1;
    for ($i = $START_DATE; $i < $maxDay; $i++) {
        " n= " . $n++;
        // echo " i= ".$i;
    }

    $total11 = $n + $END_DATE;
}

$total = ($END_DATE + 1) - $START_DATE;
if ($total > 0) {
    echo " <i class='fa fa-calendar prefix grey-text'></i><font color='green'>  จำนวน " . $total . " วัน </font>";
} else if ($START_DATE_M < $END_DATE_M) {
    echo "<font color='green'> จำนวน" . $total11 . "วัน </font>";
} else if (($START_DATE_M == $END_DATE_M) && ($total < 0)) {
    echo "<font color='red'>กรุณาเลือกวันที่ใหม่ให้ถูกต้อง</font>";
}