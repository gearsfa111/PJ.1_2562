<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();

$sql = " SELECT user.USER_ID,user.PHONE,user.image,user.USERNAME,user.PASSWORD,user.ADDRESS,
concat(initial.INITIAL_NAME,' ',user.FIRST_NAME,' ',user.LAST_NAME) as FULL_NAME,
position.POSITION_NAME,department.DEPARTMEMT_NAME,districts.DISTRICT_NAME,
amphures.AMPHUR_NAME,provinces.PROVINCE_NAME,districts.POSTCODE
FROM user
LEFT JOIN initial
on initial.INITIAL_ID = user.INITIAL_ID
LEFT JOIN position
on position.POSITION_ID = user.POSITION_ID
LEFT JOIN department
on department.DEPARTMEMT_ID = user.DEPARTMENT_ID
LEFT JOIN districts
on districts.DISTRICT_ID = user.DISTRICT_ID
LEFT JOIN amphures
on amphures.AMPHUR_ID = user.AMPHUR_ID
LEFT JOIN provinces
on provinces.PROVINCE_ID = user.PROVINCE_ID

WHERE user.USER_ID = '" . $_POST['id'] . "'  ";
$rs = selectSql($sql);
foreach ($rs as $row) {
    ?>
 <div class="sidenav-header-inner text-center">
   <img src="image/user/<?php if ($row['image'] != null) {echo $row['image'];} else {echo "user.jpg";}?>" width="200"alt="person" class="img-fluid">
 </div>
 <hr>
 <table border="1" class="table table-bordered">

   <thead>
    <tr>
      <th width="30%">รหัสพนักงาน</th>
      <th><?php echo $row['USER_ID']; ?></th>
    </tr>

    <tr>
      <th>ชื่อผู้ใช้</th>
      <th><?php echo $row['USERNAME']; ?></th>
    </tr>

    <tr>
      <th>รหัสผ่าน</th>
      <th><?php echo $row['PASSWORD']; ?></th>
    </tr>

    <tr>
      <th>ชื่อ-นามสกุล</th>
      <th><?php echo $row['FULL_NAME']; ?></th>
    </tr>

    <tr>
      <th>แผนก</th>
      <th><?php echo $row['DEPARTMEMT_NAME']; ?></th>
    </tr>
    <tr>
      <th>ตำแหน่ง</th>
      <th><?php echo $row['POSITION_NAME']; ?></th>
    </tr>

    <tr>
      <th>เบอร์โทร </th>
      <th><?php echo $row['PHONE']; ?></th>
    </tr>

    <tr>
      <th>ที่อยู่</th>
      <th><?php echo $row['ADDRESS'] . " ตำบล" . $row['DISTRICT_NAME'] . " อำเภอ" . $row['AMPHUR_NAME'] .
        " จังหวัด" . $row['PROVINCE_NAME'] . " " . $row['POSTCODE']; ?></th>
    </tr>





  </table>


<?php }?>
