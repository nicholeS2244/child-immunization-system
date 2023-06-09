<?php
session_start();
error_reporting();
include "PHP/connection.php";
include "PHP/functions.php";
include "vaccinedate.php";

$user_data = check_login($con);

$child_data = child($con);
$parent_id = $user_data['parent_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/parent_vaccine_schedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- notif -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Dashboard | Parent</title>
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
          <li><a href="parent_index.php" class="active"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
          <li><a href="parent_child.php"><i class="fas fa-child"  id="icon"></i>Child Profile</a></li>
          <li><a href="parent_vaccine_schedule.php"><i class="fas fa-list-alt"  id="icon"></i>Vaccination Schedule</a></li>
          <li><a href="parent_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
          <li><a href="parent_guide.php"><i class="fas fa-book"  id="icon"></i>Nutrition Guide</a></li>

      <li class="dropdown">
       <a href="cronjob.php" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
      
          <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
            <a href="./PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
            </div>
          </div>
        </ul>
      </nav>
      <br>
      <br>

      <?php
      $sql = "SELECT * FROM child_tbl where parent_id='$parent_id'";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {

          $parentFN = $row['fathername'];
          $childFN = $row['firstname'];
          $childLN = $row['lastname'];
          $dob = $row['dateofbirth'];

          $dateOfBirth = new DateTime($dob);
          $today = date("Y-m-d");
          $diff = date_diff(date_create($dob), date_create($today));
          $age = $diff->format('%y');

          echo "<center><h3>Schedule for " . $childFN . " " . $childLN . "</h3></center>";
          echo "<center><h4>DOB : " . $dateOfBirth->format('d-m-Y') . "</h4></center>";
          echo "<center><h4>Age : " . $age . " years</h4></center>";
          ?>
          <!--<center><button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">CLICK</button></center>
          <div id="demo" class="collapse">-->
        <center><table class="table" style="width: 60%; margin-bottom: 30px; border-collapse: separate; font-size: 16px">
      <thead style="line-height: 40px">
                <th style="width: 30%; text-align: center;">Timing</th>
                <th style="width: 40%; text-align: center;">Vaccine</th>
                <th style="width: 30%; text-align: center;">Due Date</th>
      </thead>
      <tbody>
           <tbody>
                <?php
                $sql_v = "SELECT * FROM vaccine_schedule";
                $stmt_v = $con->prepare($sql_v);
                $stmt_v->execute();
                $result_v = $stmt_v->get_result();

                while ($row = $result_v->fetch_assoc()) {

                    $vaccinename = $row['vaccine_name'];
                    $minage = $row['min_age'];

                    $vaccine_date = vaccineDate($minage, $dob);
                    $min_age = $vaccine_date[0];
                    $vaccinedate = new DateTime($vaccine_date[1]);
                    ?>

                  <tr>
                    <td><?php echo $min_age; ?></td>
                    <td><?php echo $vaccinename; ?></td>
                    <td><?php echo $vaccinedate->format('d F, Y'); ?></td>
                  </tr>

                  <?php
                }
                ?>

          </tbody>
        </table></center>
        <!--</div>-->

        <center>
        <hr style="border: 0.5px solid black; width: 75%;"></center><br>

        <?php
      }
      ?>

        </div>
        </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- notif -->
    <script>
$(document).ready(function(){

var parent_id = '<?= $parent_id ?>';
console.log(parent_id); 

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch_notification.php",
   method:"POST",
   data:{
       view:view,
       parent_id : parent_id
       },
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
  </body>
</html>
