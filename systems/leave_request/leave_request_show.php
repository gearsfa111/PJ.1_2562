<?php
include '../../js/function_db.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");

?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label class="">แสดงข้อมูลจาก</label>
                <div class="col-sm-5 ">
                    <form action="">
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="0" checked>
                        <font color="#FFA500"> รอดำเนินการ </font>
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="1">
                        <font color="green"> อนุมัติ </font>
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="2">
                        <font color="red"> ไม่อนุมัติ </font>
                    </form>
                </div>
            </div>
            <hr>
            <div id="leave_request_show"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("*[id^=radio]").change(function() {
    var APPROVE_STATUS = $("input[name='APPROVE_STATUS']:checked").val();
    //alert(APPROVE_STATUS);
    $.post("systems/leave_request/leave_request_list.php", {
        APPROVE_STATUS: APPROVE_STATUS,
    }, function(msg) {
        //alert(msg);
        //alert("Insert OK");
        $("#leave_request_show").html(msg);
    });
});

$("#leave_request_show").load("systems/leave_request/leave_request_list.php");
</script>