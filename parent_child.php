<?php
error_reporting(0);
session_start();

include "PHP/connection.php";
include "PHP/functions.php";

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
    <title>Child Profile | Parent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/parent_child.css">
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
    <li><a href="parent_index.php"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
    <li><a href="parent_child.php" class="active"><i class="fas fa-child"  id="icon"></i>Child Profile</a></li>
    <li><a href="parent_vaccine_schedule.php"><i class="fas fa-list-alt"  id="icon"></i>Vaccination Schedule</a></li>
    <li><a href="parent_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
    <li><a href="parent_guide.php"><i class="fas fa-book"  id="icon"></i>Nutrition Guide</a></li>          
    <div class="dropdown">
      <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
      <div class="dropdown-content">
      <a href="./PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
      </div>
    </div>
  </ul>
</nav>

<!-- Button to  trigger add child modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
Add Child
</button>
<div class="container">
<!-- Adding child Modal -->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Child</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-inline" action="PHP/add_parent_child.php" method="post"  style=" width: 100%">
        <input hidden type="text" class="form-control"  name="parent_id" value=<?php if (isset($parent_id)) {
            echo $parent_id;
        } ?>>
          <div class="container" >
              <label class="label">First Name:</label>
              <input type="text" class="form-control"  name="firstname">
            <br>
              <label class="label">Middle Name:</label>
              <input type="text" class="form-control" name="middlename">

              <label class="label">Last Name:</label>
              <input type="text" class="form-control" name="lastname">
            <br>
              <label class="label">Date of Birth:</label>
              <input type="date"  name="dateofbirth">
              <br>
              <label class="label">Place of Birth:</label>
              <input type="text"class="form-control" name="placeofbirth">
            <br>
              <label class="label">Address:</label>
              <input type="text"class="form-control" name="address">
            <br>
              <label class="label">Mother's Name:</label>
              <input type="text"class="form-control" name="mothername">

              <label class="label">Father's Name:</label>
              <input type="text"class="form-control" name="fathername">
            <br>
              <label class="label">Birth Height:</label>
              <input type="text"class="form-control" name="birthheight">

              <label class="label"> Birth Weight:</label>
              <input type="text"class="form-control" name="birthweight">
            <br>
              <label class="label">Sex:</label>
              <input type="radio" id="male" name="sex"  value="male">
              <label for="male">Male</label>
              <input type="radio" id="female" name="sex"  value="female">
              <label for="female">Female</label>
            </div>
            <div class="clearfix">
                <button type="submit" class="btn btn-primary" name="add">Add</button>
            </div>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- child table -->
<div class="container">
    <table id="example" class="table table-primary table-hover" style="width:30%;">
        <thead>
            <tr>
              <th>Child's Name</th>
              <th style="width: 10%">Update</th>
            </tr>
        </thead>
        <tbody class="table table-light" style="line-height: 20px">
            <?php
            $sql = "SELECT * FROM child_tbl where parent_id='$parent_id'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td hidden><?php echo $row['parent_id']; ?></td>
                <td hidden><?php echo $row['child_id']; ?></td>
                <td><?php echo $row['firstname'] . "  " . $row['lastname']; ?></td>                           
                <td><button id="id-<?php echo $row['child_id']; ?>" type="button" class="btn btn-primary editbtn" style="color: black; border: none">
                <i class="fa fa-arrow-circle-right"></i>
                </button></td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>

<!-- Edit child data Modal -->
<div class="container">
<div class="modal fade" id="editchild" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="edit_child">
              <!-- the -->
      </div>
    </div>
  </div>
</div>
    
<!-- Forms -->
<!--Step 1:Adding HTML-->
<h2><i class="fa fa-child"></i>Profile</h2>

<?php
$sql = "SELECT * FROM child_tbl where parent_id='$parent_id'";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$child_ids = [];
while ($row = $result->fetch_assoc()) {
    $child_ids[] = $row['child_id'];
}
foreach ($child_ids as $value) {
    $sql = "SELECT * FROM child_tbl where child_id='$value'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result)) { ?>
<form class="form-inline-1" action="/action_page.php"  style="border:1px solid #ccc">
<div class="container">
    <label class="label">First Name:</label>
    <input type="text" value=<?php if (isset($row['firstname'])) {
        echo $row['firstname'];
    } ?>>
<br>
    <label class="label">Middle Name:</label>
    <input type="text" value=<?php if (isset($row['middlename'])) {
        echo $row['middlename'];
    } ?>>

    <label class="label">Last Name:</label>
    <input type="text" value=<?php if (isset($row['lastname'])) {
        echo $row['lastname'];
    } ?>>
<br>
    <label class="label">Date of Birth:</label>
    <input type="text" value=<?php if (isset($row['dateofbirth'])) {
        echo $row['dateofbirth'];
    } ?>>

    <label for="pwd" class="label">Place of Birth:</label>
    <input type="text" value=<?php if (isset($row['placeofbirth'])) {
        echo $row['placeofbirth'];
    } ?>>
<br>
    <label class="label">Address:</label>
    <input type="text" value=<?php if (isset($row['address'])) {
        echo $row['address'];
    } ?>>
<br>
    <label class="label">Mother's Name:</label>
    <input type="text" value=<?php if (isset($row['mothername'])) {
        echo $row['mothername'];
    } ?>>

    <label for="pwd" class="label">Father's Name:</label>
    <input type="text" value=<?php if (isset($row['fathername'])) {
        echo $row['fathername'];
    } ?>>
<br>
    <label class="label">Birth Height:</label>
    <input type="text" value=<?php if (isset($row['birthheight'])) {
        echo $row['birthheight'];
    } ?>>
<br>
    <label for="pwd" class="label"> Birth Weight:</label>
    <input type="text" value=<?php if (isset($row['birthweight'])) {
        echo $row['birthweight'];
    } ?>>
<br>
    <label  class="label">Sex:</label>
    <input type="text" value=<?php if (isset($row['sex'])) {
        echo $row['sex'];
    } ?>>
    </div>
    </div>
</form>
<br>
<?php }
}
?>


<!-- Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
      
  $('.editbtn').on('click', function(){
      var child_id = $(this).attr("id").replace('id-','');
      // alert(chart_id);
  
      $.ajax({
          url: "PHP/edit_parent_child_modal.php",
          type: "post",
          data:{child_id: child_id},
          success:function(data){
            $('#edit_child').html(data);
            $('#editchild').modal('show');
          }
        }); 
   
  });
});
</script>

</body>
</html>
