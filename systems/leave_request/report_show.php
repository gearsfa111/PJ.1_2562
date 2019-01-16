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
                <div class="col-sm-4 mb-3">
                    <select name="account" id="year" class="form-control">
                        <option>-- กรุณาเลือกปี -- </option>
                        <?php
                        $sql = "SELECT YEAR(formleave.START_DATE) YEAR
                        FROM formleave
                        LEFT JOIN approve
                        ON approve.LEAVE_ID = formleave.LEAVE_ID
                        WHERE approve.APPROVE_STATUS=1
                        GROUP BY YEAR(formleave.START_DATE)";
                        $results = selectSql($sql);
                        foreach ($results as $row) {
                        ?>
                        <option value="<?php echo $row['YEAR']; ?>">
                            <?php echo "ปี ".($row['YEAR'] + 543); ?>
                        </option>
                        <?php }?>
                    </select>
                </div>

                <div class="col-sm-4 mb-3">
                    <select name="account" id="department" class="form-control">
                        <option>-- แผนก -- </option>
                        <?php
                        $sql = "SELECT * FROM department";
                        $results = selectSql($sql);
                        foreach ($results as $row) {
                        ?>
                        <option value="<?php echo $row['DEPARTMEMT_ID']; ?>">
                            <?php echo $row['DEPARTMEMT_NAME']; ?>
                        </option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <hr>
            <div id="show_report"></div>

        </div>
    </div>
</div>
<script type="text/javascript">
$("#show_report").load("systems/leave_request/report_data.php");

$("*[id^=year]").change(function() {

    var department = $('#department').val();
    var year = $(this).val();
    $.post("systems/leave_request/report_data.php", {
        year: year,
        department: department,

    }, function(msg) {
        $("#show_report").html(msg);

    });
});

$("*[id^=department]").change(function() {

    var year = $('#year').val();
    var department = $(this).val();
    $.post("systems/leave_request/report_data.php", {
        year: year,
        department: department,
    }, function(msg) {
        $("#show_report").html(msg);

    });
});
</script>