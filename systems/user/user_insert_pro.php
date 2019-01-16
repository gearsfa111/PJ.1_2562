<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
if (isset($_FILES['uploaded_file'])) {
    $tmpname = $_FILES['uploaded_file']['tmp_name'];

    $target_file = basename($_FILES["uploaded_file"]["name"]);

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $filetrue = date("Ymd") . GeraHash(10) . '.' . $imageFileType;
    if (move_uploaded_file($tmpname, "../../image/user/" . $filetrue)) {
        $_SESSION["filetrue"] = $filetrue;
    } else {
        echo 'no';
    }
    exit;
} else {
    //$_SESSION["filetrue"] = "user.jpg";
}

function GeraHash($qtd)
{
    $Caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $QuantidadeCaracteres = strlen($Caracteres);
    $QuantidadeCaracteres--;
    $Hash = null;
    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = rand(0, $QuantidadeCaracteres);
        $Hash .= substr($Caracteres, $Posicao, 1);
    }
    return $Hash;
}

if ($_POST['username'] == null) {
    echo '<script>alert("กรุณากรอก ชื่อผู้ใช้งาน"); $("#username").focus();</script>';
} else if ($_POST['password'] == null) {
    echo '<script>alert("กรุณากรอก รหัสผ่าน"); $("#password").focus();</script>';
} else if ($_POST['initial'] == null) {
    echo '<script>alert("กรุณาเลือก คำนำหน้าชื่อ"); $("#initial").focus();</script></script>';
} else if ($_POST['first_name'] == null) {
    echo '<script>alert("กรุณากรอก first_name"); $("#first_name").focus();</script></script>';
} else if ($_POST['last_name'] == null) {
    echo '<script>alert("กรุณากรอก last_name"); $("#last_name").focus();</script></script>';
} else if ($_POST['department'] == null) {
    echo '<script>alert("กรุณาเลือก department"); $("#department").focus();</script></script>';
} else if ($_POST['position'] == null) {
    echo '<script>alert("กรุณาเลือก position"); $("#position").focus();</script></script>';
} else if ($_POST['address'] == null) {
    echo '<script>alert("กรุณากรอก address"); $("#address").focus();</script></script>';
} else if ($_POST['province'] == null) {
    echo '<script>alert("กรุณาเลือก จังหวัด"); $("#province").focus();</script></script>';
} else if ($_POST['amphure'] == null) {
    echo '<script>alert("กรุณาเลือก อำเภอ"); $("#amphure").focus();</script></script>';
} else if ($_POST['district'] == null) {
    echo '<script>alert("กรุณาเลือก ตำบล"); $("#district").focus();</script></script>';
} else if ($_POST['phone'] == null) {
    echo '<script>alert("กรุณากรอก เบอร์โทรศัพท์"); $("#phone").focus();</script></script>';
} else if ($_POST['user_type'] == null) {
    echo '<script>alert("กรุณาเลือก ประเภทผู้ใช้"); $("#user_type").focus();</script></script>';
} else {

    if ($_POST['form_type'] == 'create') {
        $image = '';
        if (isset($_SESSION["filetrue"])) {
            $image = " ,image = '" . $_SESSION["filetrue"] . "' ";
        }
        $sql = " INSERT INTO user (USER_ID, USERNAME, PASSWORD, INITIAL_ID, FIRST_NAME,
    LAST_NAME, DEPARTMENT_ID, POSITION_ID, ADDRESS, PROVINCE_ID,
    AMPHUR_ID, DISTRICT_ID, PHONE, USER_TYPE, image)
    VALUES ('" . $_POST['user_id'] . "', '" . $_POST['username'] . "', '" . $_POST['password'] . "'
    , '" . $_POST['initial'] . "', '" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "'
    , '" . $_POST['department'] . "', '" . $_POST['position'] . "', '" . $_POST['address'] . "'
    , '" . $_POST['province'] . "', '" . $_POST['amphure'] . "', '" . $_POST['district'] . "'
    , '" . $_POST['phone'] . "', '" . $_POST['user_type'] . "', '" . $image . "') ";
        $rs = in_up_delSql($sql);
        echo "ok";
        unset($_SESSION['filetrue']);
    } else if ($_POST['form_type'] == 'update') {

        $image = '';
        if (isset($_SESSION["filetrue"])) {
            $image = " ,image = '" . $_SESSION["filetrue"] . "' ";
        }

        $sql = " UPDATE user SET  USERNAME = '" . $_POST['username'] . "',
    PASSWORD = '" . $_POST['password'] . "', INITIAL_ID = '" . $_POST['initial'] . "',
    FIRST_NAME = '" . $_POST['first_name'] . "', LAST_NAME = '" . $_POST['last_name'] . "',
    POSITION_ID = '" . $_POST['position'] . "',DEPARTMENT_ID = '" . $_POST['department'] . "',
    ADDRESS = '" . $_POST['address'] . "', DISTRICT_ID = '" . $_POST['district'] . "',
    AMPHUR_ID = '" . $_POST['amphure'] . "', PROVINCE_ID = '" . $_POST['province'] . "',
    PHONE = '" . $_POST['phone'] . "', USER_TYPE = '" . $_POST['user_type'] . "'$image
    WHERE user.USER_ID = '" . $_POST['user_id'] . "' ";

        $rs = in_up_delSql($sql);
        echo "ok";
        unset($_SESSION['filetrue']);
    }

}