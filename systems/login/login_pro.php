<?php
include '../../js/function_db.php';

session_start();
$sql = "SELECT user.USER_ID, concat(user.FIRST_NAME,' ',user.LAST_NAME)  as name,
department.DEPARTMEMT_NAME,position.POSITION_NAME,user.image,user.USER_TYPE

FROM user
LEFT JOIN initial
ON initial.INITIAL_ID = user.INITIAL_ID
LEFT JOIN department
ON department.DEPARTMEMT_ID = user.DEPARTMENT_ID
LEFT JOIN position
ON  position.POSITION_ID= user.POSITION_ID

WHERE user.USERNAME= '" . $_POST['username'] . "' and user.PASSWORD = '" . $_POST['password'] . "' ";

$result = selectSql($sql);
if ($result != null) {
    foreach ($result as $row) {
        $_SESSION['USER_ID'] = $row['USER_ID'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['DEPARTMEMT_NAME'] = $row['DEPARTMEMT_NAME'];
        $_SESSION['POSITION_NAME'] = $row['POSITION_NAME'];
        $_SESSION['image'] = $row['image'];
        $_SESSION['USER_TYPE'] = $row['USER_TYPE'];
    }

    echo 'OK';

} else {
    session_destroy();
    if ($_POST['username'] == null || $_POST['password'] == null) {
        echo '<font color="red">กรุณากรอกข้อมูลให้ครบ !!</font>';
    } else {
        echo '<font color="red">ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง !!</font>';
    }
}