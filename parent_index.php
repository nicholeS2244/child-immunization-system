<?php
session_start();
error_reporting(0);
include "PHP/connection.php";
include "PHP/functions.php";

$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/parent_index.css">
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
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
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
      <center><table class="table" style="width: 60%; margin-bottom: 30px">
      <thead style="line-height: 40px">
                <th style="width: 10%">Vaccine</th>
                <th style="width: 30%">Information</th>
      </thead>
      <tbody>
           <tbody>
           <tr>
                <?php
                $sql = "SELECT *
                    FROM vaccine_information";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {

                    $vaccinename = $row['vaccinename'];
                    $information = $row['information'];
                    ?>        
                        <tr>
                        <td  ><?php echo $vaccinename; ?></td>  
                        <td  ><?php echo $information; ?></td>          
                    </tr>
                    <?php
                }
                ?>
          </tbody>
        </table>
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