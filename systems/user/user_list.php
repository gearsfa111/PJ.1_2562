<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
if (!isset($_SESSION["USER_ID"])) {
    ?>
<script type="text/javascript">
    //$("#showmain").load("systems/login_form.php");
    //window.location="http://127.0.0.1/test/systems/login_form.php";
</script>
<?php
}

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
                <th> รหัสผนักงาน </th>
                <th> ชื่อ-นามสกุล </th>
                <th> แผนก</th>
                <th> ตำแหน่ง</th>
                <th width="20%"> </th>

            </tr>
        </thead>

        <!--ส่วนเนื้อหา -->
        <tbody>
            <?php

$sql = " SELECT user.USER_ID, concat(initial.INITIAL_NAME,' ',user.FIRST_NAME,' ',user.LAST_NAME)  as name,department.DEPARTMEMT_NAME,position.POSITION_NAME FROM user
    LEFT JOIN initial
    ON initial.INITIAL_ID = user.INITIAL_ID
    LEFT JOIN department
    ON department.DEPARTMEMT_ID = user.DEPARTMENT_ID
    LEFT JOIN position
    ON  position.POSITION_ID= user.POSITION_ID ";

$results = selectSql($sql);
$i = 0;
foreach ($results as $row) {$i++?>
            <tr align="center">
                <td>
                    <?php echo $i; ?>
                </td>
                <td onclick="button" style="cursor:pointer" data-toggle="modal" data-target="#myModal" id="showdata"
                    name="<?php echo $row['USER_ID']; ?>">
                    <?php echo $row['USER_ID']; ?>
                </td>
                <td onclick="button" style="cursor:pointer" data-toggle="modal" data-target="#myModal" id="showdata"
                    name="<?php echo $row['USER_ID']; ?>">
                    <?php echo $row['name']; ?>
                </td>
                <td onclick="button" style="cursor:pointer" data-toggle="modal" data-target="#myModal" id="showdata"
                    name="<?php echo $row['USER_ID']; ?>">
                    <?php echo $row['DEPARTMEMT_NAME']; ?>
                </td>
                <td onclick="button" style="cursor:pointer" data-toggle="modal" data-target="#myModal" id="showdata"
                    name="<?php echo $row['USER_ID']; ?>">
                    <?php echo $row['POSITION_NAME']; ?>
                </td>

                <td>
                    <button type="button" id="edit_data" class="btn-xs btn-info" name="<?php echo $row['USER_ID']; ?>">แก้ไขข้อมูล
                        <i class="glyphicon glyphicon-edit"></i> </button>
                    <button type="button" class="btn-xs btn-danger" data-toggle="modal" data-target="#myDelete" id="delete_data"
                        name="<?php echo $row['USER_ID']; ?>">ลบ <i class="glyphicon glyphicon-remove"></i> </button>
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
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> ข้อมูลพนักงาน</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body" id="user_data">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>
                        Close</button>
                </div>

            </div>

        </div>
    </div>


    <div id="myDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 mb-2 bg-danger text-white">
                    <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-remove"></i> ยืนยันการลบ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body" id="showTreat">
                    <p>คุณต้องการลบผู้ใช้ ใช่ หรือ ไม่.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete_data1"><i class="glyphicon glyphicon-ok"></i>
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
            $("#user_data").load("systems/user/user_data.php", {
                id: id
            });
        });


        $("*[id^=edit_data]").click(function() {
            var id = $(this).attr('name');
            $("#showmain").load("systems/user/user_insert.php", {
                user_id: id
            });
        });

        $("*[id^=delete_data]").click(function() {

            var id = $(this).attr('name');

            $("*[id^=delete_data1]").click(function() {

                $.post("systems/user/user_delete_pro.php", {
                    id: id
                }, function(msg) {
                    // alert(msg);
                    if (msg == "OK") {

                        setTimeout(function() {
                            $("#showmain").load("systems/user/user_show.php");
                        }, 200);


                    } else {
                        alert(msg + " | " + "Can not Delete");
                    }
                });

            });
        });
    </script>