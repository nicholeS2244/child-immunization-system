<?php
session_start();

include "PHP/connection.php";
include "PHP/functions.php";

$user_data = check_login($con);

$sql = "SELECT vaccinated FROM chart where vaccinated='yes'";
$result = mysqli_query($con, $sql);
$complete = mysqli_num_rows($result);
$sql2 = "SELECT vaccinated FROM chart where vaccinated='no'";
$result2 = mysqli_query($con, $sql2);
$Incomplete = mysqli_num_rows($result2);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'NO. OF CHILDREN', 'NO. OF VACCINATED '],
          <?php
          $sql = "SELECT * FROM vaccine";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) {

              $vaccine_id = $row['vaccine_id'];
              $vaccinename = $row['vaccinename'];
              $sql1 = "SELECT * FROM chart where vaccine_id='$vaccine_id'";
              $result1 = mysqli_query($con, $sql1);
              $rowcount = mysqli_num_rows($result1);
              $sql2 = "SELECT vaccinated FROM chart where vaccinated='yes' AND vaccine_id='$vaccine_id'";
              $result2 = mysqli_query($con, $sql2);
              $rowcount2 = mysqli_num_rows($result2);
              ?>   
          [' <?php echo $vaccinename; ?>', <?php echo $rowcount; ?>, <?php echo $rowcount2; ?>],
          <?php
          }
          ?>
        ]);
     
        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Total number of Vaccinated', 'Total number of not Vaccinated'],
          [' 2021',<?php echo $complete; ?> ,<?php echo $Incomplete; ?>],
        ]);
     
        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('total_of_vaccinated'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
    <div id="total_of_vaccinated" style="width: 100%; height: 500px;"></div>
  </body>
</html>
