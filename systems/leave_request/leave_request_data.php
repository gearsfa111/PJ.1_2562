<?php
include '../../js/function_db.php';
session_start();
$sql = " SELECT formleave.*,approve.APPROVE_STATUS ,
concat(initial.INITIAL_NAME,' ',user.FIRST_NAME,' ',user.LAST_NAME) as FULL_NAME,
user.image,department.DEPARTMEMT_NAME,position.POSITION_NAME
FROM formleave
LEFT JOIN approve
ON approve.LEAVE_ID = formleave.LEAVE_ID
LEFT JOIN user
ON user.USER_ID = formleave.USER_ID
LEFT JOIN initial
ON initial.INITIAL_ID = user.INITIAL_ID
LEFT JOIN department
ON department.DEPARTMEMT_ID =user.DEPARTMENT_ID
LEFT JOIN position
ON position.POSITION_ID = user.POSITION_ID
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
    <img src="image/user/<?php if ($row['image'] != null) {echo $row['image'];} else {
        echo " user.jpg"; } ?>"width="200"alt="person"class="img-fluid">
    <hr>
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
            <th>รหัสพนักงาน</th>
            <th>
                <?php echo $row['USER_ID']; ?>
            </th>
        </tr>
        <tr>
            <th>ชื่อ-นามสกุล</th>
            <th>
                <?php echo $row['FULL_NAME']; ?>
            </th>
        </tr>
        <tr>
            <th>แผนก</th>
            <th>
                <?php echo $row['DEPARTMEMT_NAME']; ?>
            </th>
        </tr>
        <tr>
            <th>ตำแหน่ง</th>
            <th>
                <?php echo $row['POSITION_NAME']; ?>
            </th>
        </tr>
        <?php
    ?>
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
            <th>วันที่เขียนใบลา</th>
            <th>
                <?php echo $CREATED_DATE ?>
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
                <?php if ($row['REASON_LEAVE'] != null) {echo $row['REASON_LEAVE'];} else {echo "- ไม่ระบุ";}?>
            </th>
        </tr>
        <tr>
            <th> <button type="submit" d id="btn_history" class="btn-light btn-lg btn-block btn-sm">ดูประวัติการลา</button></th>
            <th> <textarea type="text" id="history" class="md-textarea form-control" rows="1"></textarea></th>
        </tr>
</table>
<div class="sidenav-header-inner text-center">
    <form action="">
        <input type="text" id="USER_ID" value=<?php echo $row['USER_ID']; ?> hidden>
        <input type="text" id="LEAVE_ID" value=<?php echo $row['LEAVE_ID']; ?> hidden>
        <input type="radio" name="APPROVE_STATUS1" value="1">
        <font color="green"> อนุมัติ </font>
        <label>หรือ</label>
        <input type="radio" name="APPROVE_STATUS1" value="2">
        <font color="red"> ไม่อนุมัติ </font>
        <div class="modal-footer d-flex justify-content-center">
            <button type="submit" data-dismiss="modal" id="leave_request_pro" class="btn btn-primary">ยืนยัน <i class="fa fa-check"></i></button>
        </div>
</div>
</form>
<?php }?>



<script type="text/javascript">
$("#btn_history").click(function() {
    var USER_ID = $("#USER_ID").val();
    $.post("systems/leave_request/leave_request_history.php", {
        USER_ID: USER_ID,
    }, function(msg) {
        $('#history').html(msg);
    });
});


$("#leave_request_pro").click(function() {
    insert();
});

function insert() {
    var LEAVE_ID = $("#LEAVE_ID").val();
    var APPROVE_STATUS = $("input[name='APPROVE_STATUS1']:checked").val();
    $.post("systems/leave_request/leave_request_pro.php", {
        APPROVE_STATUS: APPROVE_STATUS,
        LEAVE_ID: LEAVE_ID,
    }, function(msg) {
        if (msg == "OK") {
            location.reload();
            setTimeout(function() {
                $("#showmain").load("systems/leave_request/leave_request_show.php");
            }, 200);
        } else {
            alert(msg + " กรุณาเลือกรายการอนุมัติให้ถูกต้อง ");
        }
    });
}
</script>