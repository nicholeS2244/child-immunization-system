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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <link rel="stylesheet" href="CSS/admin_index.css">
    <!-- Start of the chart code-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['2023', 'NO. OF CHILDREN', 'NO. OF VACCINATED '],
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
            title: 'Child Summary Reports',
            subtitle: '2023',
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
          [' 2023',<?php echo $complete; ?> ,<?php echo $Incomplete; ?>],
        ]);
     
        var options = {
          chart: {
            title: 'Child Summary Reports',
            subtitle: '2023',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('total_of_vaccinated'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <!-- end of the chart code -->
</head>
<body>
        <!-- Navigation Bar -->
        <nav>
          <input type="checkbox" id="check">
          <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
          </label>
          <label class="logo">Child Immunization</label>
          <ul>
            <li><a href="admin_index.php" class="active"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
            <li><a href="admin_input.php"><i class="fas fa-book"  id="icon"></i>Input</a></li>
            <li><a href="admin_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
            <div class="dropdown">
              <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
              <div class="dropdown-content">
              <a href="PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
              </div>
            </div>
          </ul>
        </nav>
        <div style="overflow-x: auto">
        <center><div id="columnchart_material" class="container"></div></center>
       <center><div id="total_of_vaccinated" class="container"></div></center>
       </div>
<style>
  .container{
    height: 500px;
    width: 50%;
    padding: 20px;
    margin: 30px 25%;
    display: inline-block;
    border: 1px solid #f1f1f1;
    box-shadow: 0 10px 30px 0 #ccc;
  }
  @media (max-width: 700px){
    .container{
      width: auto;
      margin: 20px 0px;
      border: 1px solid #f1f1f1;
      box-shadow: 0 10px 30px 0 #ccc;
    }
  }
</style>
 </body>
</html>
