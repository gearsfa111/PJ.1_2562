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
                <div class="col-sm-2">
                    <button type="button" data-toggle="modal" data-target="#myForm" id="insert" class="btn-warning"><span
                            class="glyphicon glyphicon-pencil"></span> เขียนใบลา</button>
                </div>
                <label class="">แสดงข้อมูลจาก</label>
                <div class="col-sm-5 ">
                    <form action="">
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="" checked>
                        <font color=""> ทั้งหมด </font>
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="1">
                        <font color="green"> อนุมัติ </font>
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="2">
                        <font color="red"> ไม่อนุมัติ </font>
                        <input id="radio" type="radio" name="APPROVE_STATUS" value="0">
                        <font color="#FFA500"> รอดำเนินการ </font>
                    </form>
                </div>
            </div>

            <hr>

            <div id="show_list"></div>

        </div>
    </div>
</div>

<div id="myForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header p-3 mb-2 bg-info text-white">
                <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> ขอลางาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="leave_form">
                <p>Some text in the modal.</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("*[id^=radio]").change(function() {
    var APPROVE_STATUS = $("input[name='APPROVE_STATUS']:checked").val();
    $.post("systems/leave/leave_list.php", {
        APPROVE_STATUS: APPROVE_STATUS,
    }, function(msg) {
        $("#show_list").html(msg);
    });
});
$("#show_list").load("systems/leave/leave_list.php");
$("*[id^=insert]").click(function() {
    $("#leave_form").load("systems/leave/leave_form.php");
});
</script>