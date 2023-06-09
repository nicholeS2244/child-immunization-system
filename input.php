<?php
session_start();

include "PHP/connection.php";
include "PHP/functions.php";

if (isset($_POST['submit'])) {
    $healthcenter = $_POST['healthcenter'];
    $vaccinename = $_POST['vaccinename'];
    $doses = $_POST['doses'];

    $query1 = "INSERT INTO healthcenter_tbl (healthcenter)
  values ('$healthcenter')";
    mysqli_query($con, $query1);

    $query2 = "INSERT INTO vaccine (vaccinename,doses)
  values ('$vaccinename','$doses')";
    mysqli_query($con, $query2);
    $child_id = 1;
    $bcgvaccine_id = 1;
    $bcg1st = $_POST['bcg1st'];
    $bcgvaccinatorname = $_POST['bcgvaccinatorname'];
    $bcghealthcenter = $_POST['bcghealthcenter'];

    $sqlbcg = "INSERT INTO chart (child_id,vaccine_id,healthcare_id,dateofvaccination,healthcenter_id)
	values ('$child_id','$bcgvaccine_id','$bcgvaccinatorname','$bcg1st','$bcghealthcenter') 
	ON DUPLICATE KEY UPDATE  healthcare_id='$bcgvaccinatorname', dateofvaccination='$bcg1st',healthcenter_id='$bcghealthcenter'";
    $result1 = mysqli_query($con, $sqlbcg);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="#"  method="POST">
 
  
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="bcg1st"><br>
                   
                      
                    <label for="datetime">vaccinatorname </label><br>
                    
                    
                    <label for="datetime">health center </label><br>
                    <div> <!-- Dropdown -->
                      <select name="bcghealthcenter">
                      <?php
                      $query = "SELECT * FROM healthcenter_tbl";
                      $result = mysqli_query($con, $query);
                      while ($rows = mysqli_fetch_assoc($result)) {
                          $healthcenter_id = $rows['healthcenter_id'];
                          $healthcenter = $rows['healthcenter'];
                          echo "<option value='$healthcenter_id'>$healthcenter_id</option>";
                      }
                      ?>
                      </select>	

                      <select name="bcgvaccinatorname">
                      <?php
                      $query = "SELECT * FROM healthcare_info";
                      $result = mysqli_query($con, $query);
                      while ($rows = mysqli_fetch_assoc($result)) {
                          $healthcare_id = $rows['healthcare_id'];
                          $vaccinatorname = $rows['vaccinatorname'];
                          echo "<option value='$healthcare_id'>$healthcare_id</option>";
                      }
                      ?>
                    </select>	
                      <input type="submit" name="submit" value="Log In">
</form>

  </select>	
  <i class="fas fa-user"></i><input type="text"  name="wew" placeholder="wew"/>
  <i class="fas fa-user"></i><input type="text"  name="healthcenter" placeholder="healthcenter"/>
  <i class="fas fa-lock"></i><input type="text"  name="healthcenter" placeholder="healthcenter"/>
  <i class="fas fa-lock"></i><input type="text"  name="vaccinename" placeholder="vaccinename"/>
  <i class="fas fa-lock"></i><input type="text"  name="doses" placeholder="doses"/>
  
</body>
</html>