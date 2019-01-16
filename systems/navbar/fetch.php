<?php
include '../../js/function_db.php';
if (isset($_POST['view'])) {

    $con = mysqli_connect("localhost", "root", "", "leave_pj");

    if ($_POST["view"] != '') {

        $update_query = "UPDATE notifications SET status = 1 WHERE status=0";
     
        $rs = in_up_delSql($update_query);

    }
    $query = " SELECT notifications.*,concat(initial.INITIAL_NAME,' ',user.FIRST_NAME,' ',user.LAST_NAME) as FULL_NAME
    ,initial.INITIAL_NAME
    FROM notifications
    LEFT JOIN formleave
    ON formleave.LEAVE_ID =notifications.LEAVE_ID
    LEFT JOIN approve
    ON approve.LEAVE_ID =notifications.LEAVE_ID
    LEFT JOIN user
    ON user.USER_ID =formleave.USER_ID
    LEFT JOIN initial
    ON initial.INITIAL_ID =user.INITIAL_ID
    WHERE approve.APPROVE_STATUS = '0'
    ORDER BY id DESC LIMIT 5 ";

    $result = selectSql($query);
    $output = '';

    {
        foreach ($result as $row) {
            $output .= '

    <li><a rel="nofollow" href="http://127.0.0.1/test/" class="dropdown-item">
    <div class="notification d-flex justify-content-between">

    <div class="notification-content"><i class="fa fa-envelope"></i> ' . $row['FULL_NAME'] . '</div>
    <div class="notification-time"><small>ขอลางาน</small></div>
    </div></a></li>
    ';

        }
    }
    $status_query = "SELECT * FROM notifications WHERE status=0";
    $result_query = mysqli_query($con, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count,
    );

    echo json_encode($data);

}