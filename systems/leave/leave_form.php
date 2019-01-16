<?php
include '../../js/function_db.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
?>
<div class="card-body">
    <form class="form-horizontal" id="form" method="POST">
        <?php
$year = (substr($date, 0, 4) + 543);
$genid = substr($year, 2, 4) . substr($date, 5, 1) . substr($date, 6, 1) . substr($date, 8, 9);
$sql = " SELECT max(LEAVE_ID) as LEAVE_ID  FROM formleave ";
$results = selectSql($sql);
foreach ($results as $row) {
    $maxID = $row['LEAVE_ID'];
}
if ($maxID == null) {
    $LEAVE_ID = $genid . '000' . +1;
} else {

    if (substr($maxID, 0, 6) == $genid) {

        $LEAVE_ID = substr($maxID, 0, 6) . substr($maxID, 6, 9) + 1;

    } else {
        $LEAVE_ID = $genid . '000' . +1;
    }
}
?>
        <div class="md-form mb-5" hidden>
            <i class="fa fa-user prefix grey-text"></i> <label data-error="wrong" data-success="right" for="form34">รหัสการลา</label>
            <input type="text" id="LEAVE_ID" placeholder="" class="form-control" value=<?php echo $LEAVE_ID ?>
            readonly>
        </div>

        <div class="md-form mb-5">
            <i class="fa fa-id-card-o prefix grey-text"></i> <label data-error="wrong" data-success="right" for="form29">รหัสพนักงาน</label>
            <input type="text" id="USER_ID" placeholder="" class="form-control" value=<?php echo $_SESSION['USER_ID'];
                ?> readonly>
        </div>

        <div class="md-form mb-5">
            <i class="fa fa-tag prefix grey-text"></i> <label data-error="wrong" data-success="right" for="form32">ประเภทการลา</label>
            <select name="account" id="TYPE_LEAVE" class="form-control">

                <option value="1">ลากิจส่วนตัว</option>
                <option value="2">ลาป่วย</option>
                <option value="3">ลาพักผ่อน</option>

            </select>
        </div>

        <div class="md-form mb-5">
            <i class="fa fa-hourglass-start grey-text"></i> <label data-error="wrong" data-success="right" for="form32">วันที่เริ่มลางาน</label>
            <input type="date" id="START_DATE" placeholder="" class="form-control">
        </div>

        <div class="md-form mb-5">
            <i class="fa fa-hourglass-end grey-text"></i> <label data-error="wrong" data-success="right" for="form32">ถึงวันที่</label>
            <input type="date" id="END_DATE" placeholder="" class="form-control">
        </div>

        <div class="md-form mb-5">
            <div id="amount_day"></div>
        </div>

        <div class="md-form mb-5" hidden>
            <i class="fa fa-tag prefix grey-text"></i> <label data-error="wrong" data-success="right" for="form32">วันที่ขอลางาน</label>
            <input type="date" id="CREATED_DATE" class="form-control" value=<?php echo $date ?> readonly>
        </div>

        <div class="md-form">
            <i class="fa fa-pencil prefix grey-text"></i> <label data-error="wrong" data-success="right" for="form8">เหตุผลการลา</label>
            <textarea type="text" id="REASON_LEAVE" class="md-textarea form-control" rows="4"></textarea>
        </div>
</div>

<div class="modal-footer d-flex justify-content-center">
    <button type="botton" data-dismiss="modal" id="insert_leave" class="btn btn-primary">ส่งคำขอ <i class="fa fa-paper-plane-o ml-1"></i></button>
</div>

</div>

</form>

</div>


<script type="text/javascript">
$("#show_list").load("systems/leave/leave_list.php");

$("*[id^=insert]").click(function() {
    $("#leave_form").load("systems/leave/leave_form.php");
});


$("*[id^=END_DATE]").change(function() {

    var START_DATE = $("#START_DATE").val();
    var END_DATE = $(this).val();
    $.post("systems/leave/leave_check_day.php", {
        START_DATE: START_DATE,
        END_DATE: END_DATE,
    }, function(msg) {
        $("#amount_day").html(msg);

    });
});


$("#insert_leave").click(function() {
    insert();
});

function insert() {
    var LEAVE_ID = $("#LEAVE_ID").val();
    var USER_ID = $("#USER_ID").val();
    var START_DATE = $("#START_DATE").val();
    var END_DATE = $("#END_DATE").val();
    var CREATED_DATE = $("#CREATED_DATE").val();
    var TYPE_LEAVE = $("#TYPE_LEAVE").val();
    var REASON_LEAVE = $("#REASON_LEAVE").val();
    $.post("systems/leave/leave_insert_pro.php", {
        LEAVE_ID: LEAVE_ID,
        USER_ID: USER_ID,
        START_DATE: START_DATE,
        END_DATE: END_DATE,
        CREATED_DATE: CREATED_DATE,
        TYPE_LEAVE: TYPE_LEAVE,
        REASON_LEAVE: REASON_LEAVE,
    }, function(msg) {
        if (msg == "OK") {} else {
            alert(msg + " | " + "Can not Insert");
        }
    });
}
</script>