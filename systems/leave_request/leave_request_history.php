<?php
include '../../js/function_db.php';
session_start();
$sql = " SELECT YEAR(formleave.START_DATE) year ,MONTH(formleave.START_DATE) MONTH, COUNT(*) COUNT
FROM formleave
LEFT JOIN approve
ON approve.LEAVE_ID = formleave.LEAVE_ID
WHERE formleave.USER_ID = '" . $_POST["USER_ID"] . "' AND approve.APPROVE_STATUS = '1'
GROUP BY MONTH(formleave.START_DATE)  ";
$rs = selectSql($sql);
if ($rs != null) {
    foreach ($rs as $row) {
        if ($row['MONTH'] == "1") {
            $mont = "มกราคม";
        }

        if ($row['MONTH'] == "2") {
            $mont = "กุมภาพันธ์";
        }

        if ($row['MONTH'] == "3") {
            $mont = "มีนาคม";
        }

        if ($row['MONTH'] == "4") {
            $mont = "เมษายน";
        }

        if ($row['MONTH'] == "5") {
            $mont = "พฤษภาคม";
        }

        if ($row['MONTH'] == "6") {
            $mont = "มิถุนายน";
        }

        if ($row['MONTH'] == "7") {
            $mont = "กรกฎาคม";
        }

        if ($row['MONTH'] == "8") {
            $mont = "สิงหาคม";
        }

        if ($row['MONTH'] == "9") {
            $mont = "กันยายน";
        }

        if ($row['MONTH'] == "10") {
            $mont = "ตุลาคม";
        }

        if ($row['MONTH'] == "11") {
            $mont = "พฤศจิกายน";
        }

        if ($row['MONTH'] == "12") {
            $mont = "ธันวาคม";
        }

        ?>
<?php echo ($row['year'] + 543) . " " . $mont . " จำนวน " . $row['COUNT'] . " ครั้ง
"; ?>
<?php }
    $count_year = " SELECT YEAR(formleave.START_DATE) year , COUNT(*) COUNT
    FROM formleave
    LEFT JOIN approve
    ON approve.LEAVE_ID = formleave.LEAVE_ID
    WHERE formleave.USER_ID = '" . $_POST["USER_ID"] . "' AND approve.APPROVE_STATUS = '1'
    GROUP BY YEAR(formleave.START_DATE)  ";
    $rs1 = selectSql($count_year);
    foreach ($rs1 as $row) {
        echo " - ปี " . ($row['year'] + 543) . " จำนวนทั้งหมด " . $row['COUNT'] . " ครั้ง";
    }
} else {
    echo "ไม่มีประวัติการลา";
}
?>