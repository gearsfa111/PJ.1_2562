<?php
include '../../js/function_db.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
?>

<script>

    $(document).ready(function() {
    $('#example').DataTable();
  } );

</script>
</head>

<body>
    <table id="example" class="display responsive nowrap" style="width:100%">

        <!--ส่วนหัว-->
        <thead align="center">
            <tr>
                <th width="5%"> ลำดับ</th>
                <th> ชื่อ-นาสกุล </th>
                <th> แผนก</th>
                <th> วันที่เขียนใบลา</th>
                <th> ประเภทการลา</th>
                <th> สถานะ</th>
                <th> ทำรายการ</th>

            </tr>
        </thead>
        <tbody>
            <?php
$APPROVE_STATUS = "0";
if (isset($_POST['APPROVE_STATUS'])) {
    $APPROVE_STATUS = $_POST['APPROVE_STATUS'];

}

$sql = " SELECT formleave.*,approve.APPROVE_STATUS,concat(user.FIRST_NAME,' ',user.LAST_NAME) as name,
    department.DEPARTMEMT_NAME,user.USER_ID
    FROM formleave
    LEFT JOIN approve
    ON approve.LEAVE_ID = formleave.LEAVE_ID
    LEFT JOIN user
    ON user.USER_ID = approve.USER_ID
    LEFT JOIN department
    ON department.DEPARTMEMT_ID = user.DEPARTMENT_ID
    WHERE approve.APPROVE_STATUS = '" . $APPROVE_STATUS . "' ";

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
                    <?php echo $row['name']; ?>
                </td>
                <td>
                    <?php echo $row['DEPARTMEMT_NAME']; ?>
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
                    <?php if ($row['APPROVE_STATUS'] == '0') {?>

                    <button type="button" class="btn-xs btn-info" data-toggle="modal" data-target="#myModal" id="showdata"
                        name="<?php echo $row['LEAVE_ID']; ?>">อนุมัติ <i class="glyphicon glyphicon-remove"></i>
                    </button>
                    <?php }else echo "ทำรายการแล้ว"?>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header p-3 mb-2 bg-primary text-white">
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> ข้อมูลคำขอการขอลา</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="leave_data">
                    <p>Some text in the modal.</p>
                </div>
            </div>
        </div>

        <script type="text/javascript">
        $("*[id^=showdata]").click(function() {
            var id = $(this).attr('name');
            $("#leave_data").load("systems/leave_request/leave_request_data.php", {
                id: id
            });
        });
        </script>