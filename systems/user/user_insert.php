<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
$date = date("Y");
$genid = substr(($date + 543), 2, 2);
$sql = " SELECT max(USER_ID) as USER_ID  FROM user ";
$results = selectSql($sql);
foreach ($results as $row) {
    $maxID = $row['USER_ID'];
}
if ($maxID == null) {
    $USER_ID = ($genid) . '000' . +1;
} else {
    $USER_ID = $genid . substr($maxID, 2, 5) + 1;
}

// $USER_ID ='';
$USERNAME = '';
$PASSWORD = '';
$INITIAL_ID = '';
$FIRST_NAME = '';
$LAST_NAME = '';
$POSITION_ID = '';
$DEPARTMENT_ID = '';
$ADDRESS = '';
$DISTRICT_ID = '';
$AMPHUR_ID = '';
$PROVINCE_ID = '';
$PHONE = '';
$USER_TYPE = '';
//$image = '';
$form_type = 'create';

if (isset($_POST['user_id'])) {
    //echo $_POST['user_id'];
    $form_type = 'update';
    $sql = ' SELECT * FROM user
  WHERE user.USER_ID = ' . $_POST['user_id'] . ' ';
    $results = selectSql($sql);
    foreach ($results as $row) {

        $USER_ID = $_POST['user_id'];
        $USERNAME = $row['USERNAME'];
        $PASSWORD = $row['PASSWORD'];
        $INITIAL_ID = $row['INITIAL_ID'];
        $FIRST_NAME = $row['FIRST_NAME'];
        $LAST_NAME = $row['LAST_NAME'];
        $POSITION_ID = $row['POSITION_ID'];
        $DEPARTMENT_ID = $row['DEPARTMENT_ID'];
        $ADDRESS = $row['ADDRESS'];
        $DISTRICT_ID = $row['DISTRICT_ID'];
        $AMPHUR_ID = $row['AMPHUR_ID'];
        $PROVINCE_ID = $row['PROVINCE_ID'];
        $PHONE = $row['PHONE'];
        $USER_TYPE = $row['USER_TYPE'];
        $image = $row['image'];

    }
}

?>
<div class="col-lg-12">

    <div class="card">

        <div class="card-header d-flex align-items-center">
            <h4>เพิ่มข้อมูล พนักงาน</h4>
        </div>

        <div class="card-body">
            <div class="col-lg-9 container">
                <form class="form-horizontal" id="form1" action="#" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">รหัสพนักงาน</label>
                        <div class="col-sm-10">
                            <input type="text" id="user_id" placeholder="" class="form-control" value=<?php echo
    $USER_ID; ?> readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ชื่อผู้ใช้งาน</label>
                        <div class="col-sm-10">
                            <input type="text" id="username" placeholder="" class="form-control" value=<?php echo
    $USERNAME; ?> >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">รหัสผ่าน</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" name="password" class="form-control" value=<?php echo
    $PASSWORD; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">คำนำหน้าชื่อ</label>
                        <div class="col-sm-10 mb-3">
                            <select name="account" id="initial" class="form-control">
                                <option value="">--- เลือกคำนำหน้าชื่อ ---</option>
                                <?php
$sql = "SELECT * From initial";
$results = selectSql($sql);
foreach ($results as $row) {

    ?>
                                <option value="<?php echo $row['INITIAL_ID']; ?>" <?php if ($row['INITIAL_ID'] == $INITIAL_ID) {echo "selected";}?> >
                                    <?php echo $row['INITIAL_NAME']; ?>
                                </option>
                                <?php

}?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ชื่อ</label>
                        <div class="col-sm-10">
                            <input type="text" id="first_name" name="password" class="form-control" value=<?php echo
    $FIRST_NAME; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">นามสกุล</label>
                        <div class="col-sm-10">
                            <input type="text" id="last_name" name="password" class="form-control" value=<?php echo
    $LAST_NAME; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">แผนก</label>
                        <div class="col-sm-10 mb-3">
                            <select name="" id="department" class="form-control">
                                <option value="">--- เลือกแผนก ---</option>
                                <?php
$sql = "SELECT * From department";
$results = selectSql($sql);
foreach ($results as $row) {
    ?>
                                <option value="<?php echo $row['DEPARTMEMT_ID']; ?>" <?php if ($row['DEPARTMEMT_ID'] == $DEPARTMENT_ID) {echo "selected";}?> >
                                    <?php echo $row['DEPARTMEMT_NAME']; ?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ตำแหน่ง</label>
                        <div class="col-sm-10 mb-3">

                            <select name="" id="position" class="form-control" value=<?php echo $POSITION_ID; ?>>
                                <?php if (!isset($_POST['user_id'])) {?>
                                <option value="">--- กรุณาเลือกแผนกก่อน ---</option>
                                <?php } else if (isset($_POST['user_id'])) {
    $sql = "SELECT * From position";
    $results = selectSql($sql);
    foreach ($results as $row) {
        ?>

                                <option value="<?php echo $row['POSITION_ID']; ?>" <?php if ($row['POSITION_ID'] == $POSITION_ID) {echo "selected";}?> >
                                    <?php echo $row['POSITION_NAME']; ?>
                                </option>
                                <?php
}
}?>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ที่อยู่</label>
                        <div class="col-sm-10">
                            <input type="text" id="address" name="password" class="form-control" value=<?php echo
    $ADDRESS; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">จังหวัด</label>
                        <div class="col-sm-10 mb-3">
                            <select name="account" id="province" class="form-control">
                                <option value="">--- เลือกจังหวัด ---</option>
                                <?php
$sql = "SELECT * From provinces";
$results = selectSql($sql);
foreach ($results as $row) {
    ?>
                                <option value="<?php echo $row['PROVINCE_ID']; ?>" <?php if ($row['PROVINCE_ID'] == $PROVINCE_ID) {echo "selected";}?> >
                                    <?php echo $row['PROVINCE_NAME']; ?>
                                </option>

                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">อำเถอ</label>
                        <div class="col-sm-10 mb-3">
                            <select name="account" id="amphure" class="form-control">
                                <option value="">--- เลือกอำเภอ(กรุณาเลือกจังหวัดก่อน) ---</option>

                                <?php
if (!isset($_POST['user_id'])) {?>
                                <option value="">--- เลือกอำเภอ(กรุณาเลือกจังหวัดก่อน) ---</option>
                                <?php } else if (isset($_POST['user_id'])) {
    $sql = "SELECT * From amphures";
    $results = selectSql($sql);
    foreach ($results as $row) {
        ?>
                                <option value="<?php echo $row['AMPHUR_ID']; ?>" <?php if ($row['AMPHUR_ID'] == $AMPHUR_ID) {echo "selected";}?> >
                                    <?php echo $row['AMPHUR_NAME']; ?>
                                </option>
                                <?php
}

}?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ตำบล</label>
                        <div class="col-sm-10 mb-3">
                            <select name="account" id="district" class="form-control">

                                <?php
if (!isset($_POST['user_id'])) {?>
                                <option value="">--- เลือกตำบล(กรุณาเลือกอำเภอก่อน) ---</option>
                                <?php } else if (isset($_POST['user_id'])) {
    $sql = "SELECT * From districts";
    $results = selectSql($sql);
    foreach ($results as $row) {
        ?>
                                <option value="<?php echo $row['DISTRICT_ID']; ?>" <?php if ($row['DISTRICT_ID'] == $DISTRICT_ID) {echo "selected";}?> >
                                    <?php echo $row['DISTRICT_NAME']; ?>
                                </option>
                                <?php
}

}?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">เบอร์โทรศัพท์</label>
                        <div class="col-sm-10">
                            <input type="number" id="phone" name="password" class="form-control" value=<?php echo
    $PHONE; ?>>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">ประเภทผู้ใช้งาน</label>
                        <div class="col-sm-10 mb-3">
                            <select name="account" id="user_type" class="form-control">

                                <?php
if (isset($_POST['user_id'])) {

    ?>
                                <option value="<?php echo $USER_TYPE; ?>" <?php echo "selected"; ?> >
                                    <?php if ($USER_TYPE == '1') {echo "พนักงาน";} else if ($USER_TYPE == '2') {echo "ผู้อนุมัติ";} else if ($USER_TYPE == '3') {echo "พนักงาน";}?>
                                </option>
                                <?php
}?>
                                <option value="">--- เลือกประเภทผู้ใช้ ---</option>
                                <option value="1">พนักงาน</option>
                                <option value="2">ผู้อนุมัติ</option>
                                <option value="3">ผู้ดูแลระบบ</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">รูปพนักงาน</label>
                        <div class="col-sm-10">
                            <input type="file" id="image" name="image" class="form-control">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 form-control-label">รูปตัวอย่าง</label>
                        <div class="col-sm-10">
                            <h4 id='loading'>loading..</h4>
                            <div id="image_preview">
                                <img id="previewing" src="" /></div>
                        </div>
                    </div>


                    <div class="line"></div>

                    <div class="form-group row">

                        <div class="form-group row " hidden>
                            <label class="col-sm-2 form-control-label">Statusss</label>
                            <div class="col-sm-10">
                                <input type="text" id="form_type" name="form_type" class="form-control" value=<?php
echo $form_type; ?>>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-2">

                            <button type="button" id="insert_user" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>



    <div id="validat" hidden></div>


    <script type="text/javascript">
        $("*[id^=department]").change(function() {

            var department = $(this).val();

            $.post("systems/user/user_insert_select.php", {
                department_id: department,


            }, function(msg) {
                //alert(msg);
                //alert("Insert OK");
                $("#position").html(msg);

            });
        });

        $("*[id^=province]").change(function() {

            var province = $(this).val();

            $.post("systems/user/user_insert_select.php", {
                province_id: province,

            }, function(msg) {
                // alert(msg);
                $("#amphure").html(msg);

            });
        });


        $("*[id^=amphure]").change(function() {

            var amphure = $(this).val();

            $.post("systems/user/user_insert_select.php", {
                amphure_id: amphure,

            }, function(msg) {
                $("#district").html(msg);



            });
        });




        $("#insert_user").click(function()

            {

                var user_id = $("#user_id").val();
                var username = $("#username").val();
                var password = $("#password").val();
                var initial = $("#initial").val();
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
                var department = $("#department").val();
                var position = $("#position").val();
                var address = $("#address").val();
                var province = $("#province").val();
                var amphure = $("#amphure").val();
                var district = $("#district").val();
                var phone = $("#phone").val();
                var user_type = $("#user_type").val();
                var image = $("#image").val();
                var form_type = $("#form_type").val();

                $.post("systems/user/user_insert_pro.php", {
                    user_id: user_id,
                    username: username,
                    password: password,
                    initial: initial,
                    first_name: first_name,
                    last_name: last_name,
                    department: department,
                    position: position,
                    address: address,
                    province: province,
                    amphure: amphure,
                    district: district,
                    phone: phone,
                    user_type: user_type,
                    image: image,
                    form_type: form_type,


                }, function(msg) {
                    //alert(msg);
                    if (msg == "ok") {
                        //alert("เพิ่มข้อมูลสำเร็จ");
                        //$("#showmain").load("user_show.php");
                        $("#showmain").load("systems/home.php");
                    } else {
                        //alert(msg +" | "+"Error....");
                        $('#validat').html(msg);

                        //$("#showmain").load("user_show.php");
                        //$("#username").focus();
                    }
                });
            });

        $(document).ready(function(e) {
            $("#image").change(function() {

                var file_data = $('#image').prop('files')[0];
                //alert(file_data)
                var form_data = new FormData();
                form_data.append('uploaded_file', file_data);
                //alert(form_data);
                $.ajax({
                    url: 'systems/user/user_insert_pro.php', // point to server-side PHP script
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(data) {
                        //alert(data);
                        $('#loading').hide();
                        //$("#message").html(data);
                    }
                });

            });


            // Function to preview image after validation
            $(function() {
                $("#image").change(function() {
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match = ["image/jpeg", "image/png", "image/jpg"];
                    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile ==
                            match[2]))) {
                        //$('#previewing').attr('src','user.png');return false;
                    } else {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $("#image").css("color", "green");
                $('#image_preview').css("display", "block");
                $('#previewing').attr('src', e.target.result);
                $('#previewing').attr('width', '250px');
                $('#previewing').attr('height', '230px');
            };
        });
    </script>