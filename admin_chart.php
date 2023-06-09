<?php
include "PHP/connection.php";
$query1 = "SELECT * FROM healthcenter_tbl";
$result1 = mysqli_query($con, $query1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vaccine Chart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/admin_chart.css">
    <!-- bootstrap datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
  

   </head>
<body>


<!-- Navigation Bar -->
<nav>
  <input type="checkbox" id="check">
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  <label class="logo">Child Immunization management system</label>
  <ul>
    <li><a href="admin_index.php"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
    <li><a href="admin_input.php"><i class="fas fa-book"  id="icon"></i>Input</a></li>
      <li><a href="admin_sms.php"><i class="fas fa-book"  id="icon"></i>sms</a></li>
    <li><a href="admin_chart.php" class="active"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
    <div class="dropdown">
      <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
      <div class="dropdown-content">
      <a href="PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
      </div>
    </div>
  </ul>
</nav>

      

            <!-- child table -->
<div class="container" style="overflow-x: auto">
    <table id="example" class="table table-primary table-hover" style="width:50%;">
        <thead>
            <tr>
              <th>Child's Name</th>
              <th style="width: 10%">Details</th>
              <th style="width: 15%">Delete</th>
            </tr>
        </thead>
        <tbody class="table table-light" style="line-height: 20px">
            <?php
            $sql = "SELECT * FROM child_tbl";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td hidden><?php echo $row['parent_id']; ?></td>
                <td hidden><?php echo $row['child_id']; ?></td>
                <td><?php echo $row['firstname'] . "  " . $row['lastname']; ?></td>                           
                <td><button id="id-<?php echo $row['child_id']; ?>" type="button" class="btn btn-primary view_chart" style="color: black; border: none">
                <i class="fa fa-arrow-circle-right"></i>
                </button></td>
                <td>
                <form action="PHP/delete.php" method="POST">
                    <input type="hidden" name="child_id" value="<?php echo $row['child_id']; ?>">
                    <button type="submit" name="delete_child" class="btn btn-danger"><a href="PHP/delete.php"></a><i class="fa fa-trash"></i></button>
                </form>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>


<!-- chart table -->
<div class="container" style="overflow-x: auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduserchart">
              Add Child Chart
        </button>
        <br><br>
  <table id="example" class="table table table-hover" style="width:100%">
      <thead class="table table-primary">
          <tr>
              <th>Child's Name</th>
              <th>Vaccine Name</th>
              <th>Dosage</th>
              <th>Vaccinator Name</th>
              <th>Date of Vaccination</th>
              <th>Health Center</th>
              <th>Vaccinated?</th>
              <th>Update</th>
              <th>Delete</th>
          </tr>
      </thead>
      <tbody class="table table-light">
          <?php
          $sql = "SELECT *, child_tbl.firstname, child_tbl.lastname, vaccine.vaccinename, healthcare_info.vaccinatorname, chart.dateofvaccination, healthcenter_tbl.healthcenter 
         FROM ((((chart
         LEFT JOIN child_tbl ON chart.child_id = child_tbl.child_id)
         LEFT JOIN vaccine ON chart.vaccine_id = vaccine.vaccine_id)
         LEFT JOIN healthcare_info ON chart.healthcare_id = healthcare_info.healthcare_id)
         LEFT JOIN  healthcenter_tbl ON chart.healthcenter_id = healthcenter_tbl.healthcenter_id)
         ";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) { ?>
          <tr>
              <td hidden><?php echo $row['chart_id']; ?></td>  
              <td hidden><?php echo $row['child_id']; ?></td>
              <td><?php echo $row['firstname'] . '  ' . $row['lastname']; ?></td>
              <td><?php echo $row['vaccinename']; ?></td>
              <td><?php echo $row['dose']; ?></td>
              <td><?php echo $row['vaccinatorname']; ?></td>
              <td><?php echo $row['dateofvaccination']; ?></td>
              <td><?php echo $row['healthcenter']; ?></td>        
              <td><?php echo $row['vaccinated']; ?></td>  
              <td hidden><?php echo $row['vaccine_id']; ?></td>       
              <td><button id="id-<?php echo $row['chart_id']; ?>" type="button" class="btn btn-primary editbtn" style="color: black; border: none;">
              <i class="fas fa-edit"></i>
              </button></td>
              <td>
              <form action="PHP/delete.php" method="POST">
                  <input type="hidden" name="chart_id" value="<?php echo $row['chart_id']; ?>">
                  <button type="submit" name="delete_chart" class="btn btn-danger"><a href="PHP/delete.php"></a><i class="fa fa-trash"></i></button>
              </form>
              </td>
          </tr>
          <?php }
          ?>
      </tbody>
  </table>
</div>

<!-- new child details including profile and chart modal -->
<div class="modal fade" id="detailschart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #00539cff">
        <h5 class="modal-title" id="exampleModalLabel">CHILD IMMUNIZATION RECORD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="chart_detail">
      
      </div>         
    </div>
  </div>
</div>

<!-- add user chart modal -->
<div class="modal fade" id="adduserchart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Child Chart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="PHP/add_chart_admin.php" method="POST">    
            Child Name
            <select name="child_id" class="form-control">
                <?php
                $query = "SELECT * FROM child_tbl";
                $result = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    $child_id = $rows['child_id'];
                    $firstname = $rows['firstname'];
                    $lastname = $rows['lastname'];
                    $middlename = $rows['middlename'];
                    echo "<option value='$child_id'>$firstname $middlename $lastname</option>";
                }
                ?>
            </select>
            <br>                   
            Vaccine Name
            <select name="vaccine_id" class="form-control">
                <?php
                $query = "SELECT * FROM vaccine";
                $result = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    $vaccine_id = $rows['vaccine_id'];
                    $vaccinename = $rows['vaccinename'];
                    echo "<option value='$vaccine_id'>$vaccinename</option>";
                }
                ?>
            </select> 
            <br>
            Dosage
            <select name="dose" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <br>
            Vaccinator's Name 
            <select name="vaccinatorname" class="form-control">
                <?php
                $query = "SELECT * FROM healthcare_info";
                $result = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    $healthcare_id = $rows['healthcare_id'];
                    $vaccinatorname = $rows['vaccinatorname'];
                    echo "<option value='$healthcare_id'>$vaccinatorname</option>";
                }
                ?>
            </select>    
            <br>
            Date of Vaccination    
            <input class="form-control" type="date" id="dtlocal" name="dateofvaccination">  
            <br>
            healthcenter
            <select name="healthcenter" class="form-control">
                <?php
                $query = "SELECT * FROM healthcenter_tbl";
                $result = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    $healthcenter_id = $rows['healthcenter_id'];
                    $healthcenter = $rows['healthcenter'];
                    echo "<option value='$healthcenter_id'>$healthcenter</option>";
                }
                ?>
            </select>     
            <br>
            vaccinate
            <select name="vaccinated" class="form-control">
                <option value="no">not vaccinated</option>
                <option value="yes">vaccinated</option>
            </select>
            </br>  
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>  
        </form>

      </div>         
    </div>
  </div>
</div>

<!-- edit user chart -->
<div class="modal fade" id="editchart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE CHART</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="edit_child"> 

      </div>   
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
  // $("#add-chart").click(function(){

  //   // alert("add here");
  // });
  $('.view_chart').on('click', function(){
      var child_id = $(this).attr("id").replace('id-','');
      // alert(child_id);
 
        $.ajax({
          url: "PHP/view_child_admin_modal.php",
          type: "post",
          data:{child_id: child_id},
          success:function(data){
            $('#chart_detail').html(data);
            $('#detailschart').modal('show');
          }
        }); 

      });
      
  $('.editbtn').on('click', function(){
      var chart_id = $(this).attr("id").replace('id-','');
      // alert(chart_id);
  
      $.ajax({
          url: "PHP/edit_chart_admin_modal.php",
          type: "post",
          data:{chart_id: chart_id},
          success:function(data){
            $('#edit_child').html(data);
            $('#editchart').modal('show');
          }
        }); 
     
  });

  $tr = $(this).closest('tr');
        // var data = $tr.children('td').map(function(){
        //   return $(this).text();
        // }).get();

        // console.log(data);
        // $('#chart_id').val(data[0]);
        // $('#child_id').val(data[1]);
        // $('#vaccinename').val(data[2]);
        // $('#vaccinatorname').val(data[3]);
        // $('#dateofvaccination').val(data[4]);
        // $('#healthcenter').val(data[5]);
        // $('#vaccinated').val(data[6]); 
        // $('#vaccine_id').val(data[7]);     

});

</script>


<!-- datatables -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );
</script>
</body>
</html>
