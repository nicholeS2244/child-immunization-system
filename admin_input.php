<?php

include "PHP/connection.php";
include "PHP/functions.php";

if (isset($_POST['guide'])) {
    $hf = $_POST['hf'];
    $benefits = $_POST['benefits'];
    $reminders = $_POST['reminders'];
    $sql = "INSERT INTO guide (hf,benefits,reminders)
    values ('$hf','$benefits','$reminders')";
    $result = mysqli_query($con, $sql);
}
if (isset($_POST['vaccine_information'])) {
    $vaccinename = $_POST['vaccinename'];
    $information = $_POST['information'];
    $sql = "INSERT INTO vaccine_information (vaccinename,information)
    values ('$vaccinename','$information')";
    $result = mysqli_query($con, $sql);
}
if (isset($_POST['vaccinatorname'])) {
    $vaccinatorname = $_POST['vaccinatorname'];
    $sql = "INSERT INTO healthcare_info (vaccinatorname)
    values ('$vaccinatorname')";
    $result = mysqli_query($con, $sql);
}
if (isset($_POST['vaccine'])) {
    $vaccinename = $_POST['vaccinename'];
    $sql = "INSERT INTO vaccine (vaccinename)
    values ('$vaccinename')";
    $result = mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/input.css">
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
            <li><a href="admin_index.php" ><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
            <li><a href="admin_input.php" class="active"><i class="fas fa-book"  id="icon"></i>Input</a></li>
            <li><a href="admin_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
            <div class="dropdown">
              <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
              <div class="dropdown-content">
              <a href="PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
              </div>
            </div>
          </ul>
        </nav>


<div class="container">
  <p>Fill this up for the new vaccine to be added.
</p>
<!-- Vaccine with Doses -->
<form action="#" method="post" >
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Vaccine name:</label>
    <input type="text" name="vaccinename">
  </div>
  <button type="submit" name="vaccine" class="btn btn-primary">vaccine</button>
</form>
</div>
<div class="container">
<!-- Vaccinator -->
<form action="#" method="post" >
<p>Input here the name of vaccinator
</p>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Vaccinator name:</label>
    <input type="text" name="vaccinatorname">
    <button type="submit" name="vaccinatorname" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
<div class="container">
  <p>Please select a vaccine and place its details.</p>
<!-- Vaccine Information -->
<form action="#" method="post" >
Vaccine Name:
<select name="vaccinename">
  <?php
  $query = "SELECT DISTINCT vaccinename FROM vaccine";
  $result = mysqli_query($con, $query);
  while ($rows = mysqli_fetch_assoc($result)) {
      $vaccinename = $rows['vaccinename'];
      echo "<option value='$vaccinename'>$vaccinename</option>";
  }
  ?>
</select> 
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Information:</label>
    <textarea id="w3review" name="information" rows="5" cols="100"></textarea>
  <button type="submit" name="vaccine_information" class="btn btn-primary">Submit</button>
</form>
</div>
 </body>
</html>
