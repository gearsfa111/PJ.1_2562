<?php
include '../../js/function_db.php';
//include 'user_session.php';
session_start();
echo $_POST['province_id'];
if (isset($_POST['department_id'])) {
    $sql = " SELECT * From position WHERE DEPARTMEMT_ID = '" . $_POST['department_id'] . "'";
} else if (isset($_POST['province_id'])) {
    $sql = " SELECT * From amphures WHERE PROVINCE_ID = '" . $_POST['province_id'] . "'";
} else if (isset($_POST['amphure_id'])) {
    $sql = " SELECT * From districts WHERE AMPHUR_ID = '" . $_POST['amphure_id'] . "'";
}

$results = selectSql($sql);

foreach ($results as $row) {

    if (isset($_POST['department_id'])) {
        $id = $row['POSITION_ID'];
        $name = $row['POSITION_NAME'];
    } else if (isset($_POST['province_id'])) {
        $id = $row['AMPHUR_ID'];
        $name = $row['AMPHUR_NAME'];
    } else if (isset($_POST['amphure_id'])) {
        $id = $row['DISTRICT_ID'];
        $name = $row['DISTRICT_NAME'];
    }

    ?>
  <option value="<?php echo $id; ?>" > <?php echo $name; ?>
</option>
<?php }?>
