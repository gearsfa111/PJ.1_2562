<?php
include '../../js/function_db.php';
session_start();
if (isset($_POST['year'])) {
    $sql = " SELECT MONTH(formleave.START_DATE) MONTH, COUNT(*) COUNT
  FROM formleave
  LEFT JOIN approve
  ON approve.LEAVE_ID = formleave.LEAVE_ID
  LEFT JOIN user
  ON user.USER_ID = formleave.USER_ID
  LEFT JOIN department
  ON department.DEPARTMEMT_ID = user.DEPARTMENT_ID
  WHERE YEAR(formleave.START_DATE)='" . $_POST['year'] . "' && approve.APPROVE_STATUS=1 && user.USER_ID = '" . $_SESSION['USER_ID'] . "'
  GROUP BY MONTH(formleave.START_DATE) ";
    $results = selectSql($sql);
    $count_test = [0,0,0,0,0,0,0,0,0,0,0,0];
    foreach ($results as $row) { 
        $COUNT = $row['COUNT'];
        $MONTH =$row['MONTH'];
        $count_test[($MONTH-1)] = $COUNT;       
        }
    $count1 = "";
    $year = ($_POST['year'] + 543);
    foreach ($results as $row) {

        $count1 = $count1 + $row['COUNT'];
    }
    echo "ปี " . $year . " รวมทั้งหมด " . $count1 . " ครั้ง";
}
?>
<div class="col-lg-12">
    <div class="card-body">
        <canvas id="myChart"></canvas>
    </div>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/charts-custom.js"></script>
    <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                "มกราคม",
                "กุมภาพันธ์",
                "มีนาคม",
                "เมษายน",
                "พฤษภาคม",
                "มิถุนายน",
                "กรกฎาคม",
                "สิงหาคม",
                "กันยายน",
                "ตุลาคม",
                "พฤศจิกายน",
                "ธันวาคม",
            ],
            datasets: [{
                label: '# จำนวนการลา',
                data: [
                    <?php 
                for($i=0; $i<12; $i++){
                 echo  $count_test[$i].',';
                }
                    ?>
                    10
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>