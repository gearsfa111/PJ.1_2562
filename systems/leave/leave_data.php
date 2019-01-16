<?php
include '../../js/function_db.php';
session_start();
$sql = " SELECT formleave.*,approve.APPROVE_STATUS FROM formleave
LEFT JOIN approve
ON approve.LEAVE_ID = formleave.LEAVE_ID
WHERE formleave.LEAVE_ID = '" . $_POST['id'] . "'  ";
$rs = selectSql($sql);
foreach ($rs as $row) {
    date_default_timezone_set("Asia/Bangkok");
    $START_DATE = date('d/m/', strtotime($row['START_DATE']));
    $END_DATE = date('d/m/', strtotime($row['END_DATE']));
    $CREATED_DATE = date('d/m/', strtotime($row['CREATED_DATE']));

    $START_DATE = $START_DATE . (date('Y') + 543);
    $END_DATE = $END_DATE . (date('Y') + 543);
    $CREATED_DATE = $CREATED_DATE . (date('Y') + 543);
    ?>
<div class="sidenav-header-inner text-center">
    <?php echo "<b>สถานะ : ";
    if ($row['APPROVE_STATUS'] == '0') {
        echo "<b><font color=#FFA500>รอดำเนินการ</font>";
    } else if ($row['APPROVE_STATUS'] == '1') {
        echo "<b><font color=green>อนุมัติ</font>";
    } else if ($row['APPROVE_STATUS'] == '2') {
        echo "<b><font color=red>ไม่อนุมัติ</font>";
    }
    ?>
</div>
<hr>
<table border="1" class="table table-bordered">
    <thead>
        <tr>
            <th width="30%">รหัสการลา</th>
            <th>
                <?php echo $row['LEAVE_ID']; ?>
            </th>
        </tr>
        <tr>
            <th>รหัสพนักงาน</th>
            <th>
                <?php echo $row['USER_ID']; ?>
            </th>
        </tr>
        <tr>
            <th>วันที่ลา</th>
            <th>
                <?php echo $START_DATE . " ถึงวันที่ " . $END_DATE ?>
            </th>
        </tr>

        <?php
    $START_DATE_M = substr($row['START_DATE'], 5, 2);
    $END_DATE_M = substr($row['END_DATE'], 5, 2);
    if ($START_DATE_M == "01" || ($START_DATE_M == "03") || ($START_DATE_M == "05") || ($START_DATE_M == "07")
        || ($START_DATE_M == "08") || ($START_DATE_M == "10") || ($START_DATE_M == "12")) {
        $maxDay = 31;
    } else if (($START_DATE_M == "02")) {
        $maxDay = 28;
    } else if (($START_DATE_M == "04") || ($START_DATE_M == "06") || ($START_DATE_M == "09") || ($START_DATE_M == "11")) {
        $maxDay = 30;
    }
    $START_DATE = substr($row['START_DATE'], 8, 8);
    $END_DATE = substr($row['END_DATE'], 8, 8);
    if ($START_DATE > $END_DATE) {
        $n = 1;
        for ($i = $START_DATE; $i < $maxDay; $i++) {
            $n++;
            // echo " i= ".$i;
        }
        $total1 = $n + $END_DATE;
    }
    $total = ($END_DATE + 1) - $START_DATE;
    ?>
        <tr>
            <th>จำนวนวันลา</th>
            <th>
                <?php if ($total > 0) {echo $total;} else if ($START_DATE_M < $END_DATE_M) {echo $total1;}?> วัน</th>
        </tr>
        <tr>
            <th>วันที่ขอลา</th>
            <th>
                <?php echo $CREATED_DATE; ?>
            </th>
        </tr>
        <tr>
            <th>ประเภทการลา</th>
            <th>
                <?php if ($row['TYPE_LEAVE'] == "1") {echo "ลากิจส่วนตัว";} else if ($row['TYPE_LEAVE'] == "2") {echo "ลาป่วย";} else if ($row['TYPE_LEAVE'] == "3") {echo "ลาพักผ่อน";}?>
            </th>
        </tr>
        <tr>
            <th>เหตุผลการลา </th>
            <th>
                <?php echo $row['REASON_LEAVE']; ?>
            </th>
        </tr>

</table>

<?php }?>