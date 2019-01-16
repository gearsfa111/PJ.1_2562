<?php
include '../../js/function_db.php';
date_default_timezone_set("Asia/Bangkok");
session_start();
?>

<script>

    $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>
</head>

<body>
    <table id="example" class="display responsive nowrap" style="width:100%">
        <thead align="center">
            <tr>
                <th width="5%"> ลำดับ</th>
                <th> รหัสการลา </th>
                <th> วันที่เขียนใบลา</th>
                <th> ประเภทการลา</th>
                <th> สถานะ</th>
                <th> ดูรายละเอียด </th>
                <th> ยกเลิกรายการ </th>
            </tr>
        </thead>
        <tbody>
            <?php
$APPROVE_STATUS = "";
if (isset($_POST['APPROVE_STATUS'])) {
    if ($_POST['APPROVE_STATUS'] != "") {
        $APPROVE_STATUS = " AND approve.APPROVE_STATUS='" . $_POST['APPROVE_STATUS'] . "' ";
    }
}

$sql = " SELECT formleave.*,approve.APPROVE_STATUS,concat(user.FIRST_NAME,' ',user.LAST_NAME) as name FROM formleave
    LEFT JOIN approve
    ON approve.LEAVE_ID = formleave.LEAVE_ID
    LEFT JOIN user
    ON user.USER_ID = approve.USER_ID
    WHERE formleave.USER_ID = '" . $_SESSION["USER_ID"] . "' $APPROVE_STATUS ";

$results = selectSql($sql);
$i = 0;
foreach ($results as $row) {$i++;
    $CREATED_DATE = date('d/m/', strtotime($row['CREATED_DATE']));
    $CREATED_DATE = $CREATED_DATE . (date('Y') + 543);?>
            <tr align="center">
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $row['LEAVE_ID']; ?>
                </td>
                <td>
                    <?php echo $CREATED_DATE; ?>
                </td>

                <td>
                    <?php
                    if ($row['TYPE_LEAVE'] == '1') {
                    echo "ลากิจส่วนตัว";
                    } else if ($row['TYPE_LEAVE'] == '2') {
                    echo "ลาป่วย";
                    } else if ($row['TYPE_LEAVE'] == '3') {
                    echo "ลาพักผ่อน";
                    }
                    ?>
                </td>

                <td>
                    <?php
                    if ($row['APPROVE_STATUS'] == '0') {
                    echo "<b><font color=#FFA500>รอดำเนินการ</font>";
                    } else if ($row['APPROVE_STATUS'] == '1') {
                    echo "<b><font color=green>อนุมัติ</font>";
                    } else if ($row['APPROVE_STATUS'] == '2') {
                    echo "<b><font color=red>ไม่อนุมัติ</font>";
                    }
                    ?>
                </td>

                <td>
                    <button type="button" class="btn-xs btn-primary" data-toggle="modal" data-target="#myModal" id="showdata"
                        name="<?php echo $row['LEAVE_ID']; ?>">ดูข้อมูล <i class="	fa fa-eye"></i> </button>
                </td>

                <?php if ($row['APPROVE_STATUS'] == '0') {?>
                <td>
                    <button type="button" class="btn-xs btn-danger" data-toggle="modal" data-target="#myDelete" id="delete_data"
                        name="<?php echo $row['LEAVE_ID']; ?>">ยกเลิกคำร้องขอ <i class="glyphicon glyphicon-remove"></i>
                    </button>
                </td>
                <?php } else {?>
                <td>
                    <font color="C6C6C6">ทำรายการแล้ว</font>
                </td>
                <?php }?>

            </tr>
            <?php }?>

        </tbody>

    </table>


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-primary text-white">
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> ข้อมูลการขอลา</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="leave_data">
                    <p>Some text in the modal.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="myDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-danger text-white">
                    <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-remove"></i> &nbsp;ยืนยันการยกเลิก</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="showTreat">
                    <p>คุณต้องการยกเลิกคำขอ ใช่ หรือ ไม่.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete_ok"><i class="glyphicon glyphicon-ok"></i>
                        ยืนยัน</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>
                        ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    $("*[id^=showdata]").click(function() {
        var id = $(this).attr('name');
        $("#leave_data").load("systems/leave/leave_data.php", {
            id: id
        });
    });

    $("*[id^=delete_data]").click(function() {
        var id = $(this).attr('name');
        $("*[id^=delete_ok]").click(function() {
            deleteData(id);
        });

    });

    function deleteData(id) {
        $.post("systems/leave/leave_delete_pro.php", {
            id: id
        }, function(msg) {
            if (msg == "OK") {

                setTimeout(function() {
                    $("#showmain").load("systems/leave/leave_show.php");
                }, 200);
            } else {
                alert(msg + " | " + "Can not Delete");
            }
        });
    }
    </script>