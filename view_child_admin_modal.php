<?php
include "connection.php";
// print_r($_POST);
$child_id = $_POST['child_id'];
// echo json_encode($_POST);
if (isset($_POST['child_id'])) {
}
?>

<?php
$sql = "SELECT * FROM child_tbl WHERE child_id = '$child_id'";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { ?>
<style>
  .label{
    margin-right: 10%; 
    width: 20%;
    box-shadow: 1px 1px 2px black, 0 0 10px #00539cff, 0 0 5px #00539cff;
  }
  @media (max-width: 700px){
    .container{
        margin-left: 10%;
    }
    .label{
    margin-right: 25%; 
    width: 50%;
  }
  .sex{
    margin-right: 50%;
  }
  }
</style>
    <?php echo "<label style='border-bottom: 1px solid #00539cff; font-size: 20px;'>" . $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'] . "</label>"; ?>
        <div class="container"> 
            <label style="margin-right: 5%">Birthday:</label> 
               <?php echo "<label class='label'>" . $row['dateofbirth'] . "</label>"; ?>

            <label style="margin-right: 5%">Birth Place:</label> 
                <?php echo "<label class='label'>" . $row['placeofbirth'] . "</label>"; ?>
        <br>
            <label style="margin-right: 5%">Address:</label>        
                <?php echo "<label class='label'>" . $row['address'] . "</label>"; ?>
        <br>
            <label style="margin-right: 3%">Mother's Name:</label>
                <?php echo "<label class='label'>" . $row['mothername'] . "</label>"; ?>

            <label style="margin-right: 2%">Father's Name:</label>
                <?php echo "<label class='label'>" . $row['fathername'] . "</label>"; ?>
        <br>
            <label style="margin-right: 5%">Birth Height:</label>
                <?php echo "<label class='label'>" . $row['birthheight'] . "</label>"; ?>

            <label style="margin-right: 5%">Birth Weight:</label>
                <?php echo "<label class='label'>" . $row['birthweight'] . "</label>"; ?>
        <br>
            <label class="sex" style="margin-right: 5%">Sex:</label>
                <?php echo "<label class='label'>" . $row['sex'] . "</label>"; ?>
        </div>
    </form>  
<?php }
?> 

<div style="overflow-x: auto">
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
      <thead>
          <tr>
              <th>Vaccine</th>
              <th>Dosage</th>
              <th>Date of Vaccination</th>
              <th>Vaccinator Name</th>
              <th>Health Center</th>
              <th>Vaccinated?</th>
          </tr>
      </thead>
      <tbody>
          <?php
          $sql = "SELECT *,chart.vaccinated, vaccine.vaccinename, healthcare_info.vaccinatorname, chart.dateofvaccination, healthcenter_tbl.healthcenter 
          FROM (((chart
          INNER JOIN vaccine ON chart.vaccine_id = vaccine.vaccine_id)
          INNER JOIN healthcenter_tbl ON chart.healthcenter_id = healthcenter_tbl.healthcenter_id)
          INNER JOIN healthcare_info ON chart.healthcare_id = healthcare_info.healthcare_id)
          where child_id='$child_id'";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) { ?>
          <tr>
              <td><?php echo $row['vaccinename']; ?></td>
              <td><?php echo $row['dose']; ?></td>
              <td><?php echo $row['dateofvaccination']; ?></td>
              <td><?php echo $row['vaccinatorname']; ?></td>        
              <td><?php echo $row['healthcenter']; ?></td> 
              <td><?php echo $row['vaccinated']; ?></td>
              </td>
          </tr>
          <?php }
          ?>
      </tbody>
  </table>
  </div>
