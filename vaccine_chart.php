<?php
include "PHP/connection.php";
$query1 = "SELECT * FROM healthcenter_tbl";
$result1 = mysqli_query($con, $query1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   
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
          <li><a href="admin_index.php"><i class="fas fa-home" id="icon"></i>Dashboard</a></li>
          <li><a href="admin_child.php" class="active"><i class="fas fa-child"  id="icon"></i>Child Profile</a></li>
          <li><a href="admin_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
          <li><a href="admin_guide.php"><i class="fas fa-book"  id="icon"></i>Nutrition Guide</a></li>
          <li><a href="admin_sms.php"><i class="fas fa-comment"  id="icon"></i>SMS Notification</a></li>
        
          <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
            <a href="PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
            </div>
          </div>
        </ul>
      </nav>

      <!-- edit modal -->
    <div class="modal fade" id="editbcg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="PHP/updateuser.php" class="sign-up-form" method="post">
       
            <h2 class="title">Sign up</h2>
            <!-- INSERT CODE HERE FOR ERROR -->
            <input type="hidden" name="id" id="id">
            
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="First Name" name="firstname"  id="firstname"/>
            </div>
            <div> <!-- Dropdown -->
            <select name="username">
            <?php
            $query = "SELECT username FROM parent_tbl";
            $result = mysqli_query($con, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
                $get_data = $rows['username'];
                echo "<option value='$get_data'>$get_data</option>";
            }
            ?>

            </select>	
                    </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Last Name" name="lastname" id="lastname"/>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Middle Name" name="middlename" id="middlename"/>
            </div>
            <div class="input-field">
              <i class="fas fa-map-marker"></i>
              <input type="text" placeholder="Address" name="address"/>
            </div>
            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="text" placeholder="Phone Number" name="phone_num"/>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" id="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" id="password"/>
            </div>
            <div class="modal-footer">
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>

          </div>         
        </div>
      </div>
    </div>

            <!-- child table -->
    <div class="container">
    <table id="example" class="table table-dark" style="width:100%">
        <thead>
            <tr>
                <th>child_id ID</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>middlename</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM child_tbl";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['child_id']; ?></td>
                <td><?php echo $row['firstname']; ?></td>               
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['middlename']; ?></td>              
                <td><button type="button" class="btn btn-primary editbtn">
               update
                </button></td>
                <td>
                <form action="PHP/delete.php" method="POST">
                    <input type="hidden" name="child_id" value="<?php echo $row['child_id']; ?>">
                    <button type="submit" name="delete_btn" class="btn btn-danger"><a href="PHP/delete.php"></a>Delete</button>
                </form>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>

    
      
          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 10%;">Vaccine Name</th>
                    <th style="width: 10%;">Doses <br> (Recommended Age)</th>
                    <th style="width: 15%;">Date of Vaccination</th>
                    <th style="width: 10%;">Vaccinator's Name</th>
                    <th style="width: 10%;">Health Center</th>
                </tr>
            </thead>
            <tbody>

                <form action="PHP/vaccine_chart.php" method="POST">
                  <tr>
                    <td> BCG </td>
                    <td> 1 <br>(Birth) </td>
                    <td>                      
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="bcg1st">                     
                    <td>
                    <select name="bcgvaccinatorname">
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
                    </td>
                    <td>             
                      <select name="bcghealthcenter">
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
                      </td>
                      
                      <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                      <select name="bcgvaccinated">
                        <option value="no">not vaccinated</option>
                        <option value="yes">vaccinated</option>
                      </select>
                      </td>
                      </td>
                  </tr>
                </form>



                <form action="PHP/vaccine_chart.php" method="POST">
                  <tr>
                    <td> HEPATITIS B </td>
                    <td> 1 <br>(Birth) </td>
                    <td>                    
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="hepatitis1st">                     
                    <td>
                    <select name="hepatitisvaccinatorname">
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
                    </td>
                    <td>
                    <select name="hepatitishealthcenter">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                      </td>
                    </td>
                  </tr>
                </form>



                <form action="">
                  <tr>
                    <td> PENTAVALENT VACCINE </td>
                    <td> 3 <br> (1 ½, 2 ½, 3 ½ months) </td>
                    <td>
                      
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pentavalent1st">
                      <br>
                      <label for="datetime"> 2nd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pentavalent2nd">
                      <br>
                      <label for="datetime"> 3rd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pentavalent3rd">
                      
                    </td>
                    <td>
                    <select name="pentavalentvaccinatorname1st">
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
                    <br><br>
                    <select name="pentavalentvaccinatorname2nd">
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
                    <br><br>
                    <select name="pentavalentvaccinatorname3rd">
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
                    </td>
                    <td>
                    <select name="pentavalenthealthcenter1st">
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
                      <br><br>
                      <select name="pentavalenthealthcenter2nd">
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
                      <br><br>
                      <select name="pentavalenthealthcenter3rd">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                    </td>
                  </tr>
                </form>

                <form action="">
                  <tr>
                    <td> ORAL POLIO VACCINE (OPV) </td>
                    <td> 3 <br> (1 ½, 2 ½, 3 ½ months) </td>
                    <td>
                     
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="opv1st">
                      <br>
                      <label for="datetime"> 2nd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="opv2nd">
                      <br>
                      <label for="datetime"> 3rd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="opv3rd">
                    
                    </td>
                    <td>
                      <br><br>
                      <select name="opvvaccinatorname1st">
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
                      <br><br>
                      <select name="opvvaccinatorname2nd">
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
                      <br><br>
                      <select name="opvvaccinatorname3rd">
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
                    </td>
                    <td>
                      <br><br>
                      <select name="opvhealthcenter1st">
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
                      <br><br>
                      <select name="opvhealthcenter2nd">
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
                      <br><br>
                      <select name="opvhealthcenter3rd">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                    </td>
                  </tr>
                </form>


                <form action="">
                  <tr>
                    <td> INACTIVATED POLIO VACCINE </td>
                    <td> 1 <br> (3 ½ months) </td>
                    <td>
                   
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="inactivepolio1st">
                  
                    </td><br>
                    <td>
                      <br>
                      <select name="inactivepoliovaccinatorname">
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
                    </td>
                    <td>
                      <br>
                      <select name="inactivepoliohealthcenter">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                      </td>
                  </tr>
                </form>


                <form action=""></form>
                  <tr>
                    <td> PNEUMOCOCCAL CONJUGATE VACCINE </td>
                    <td> 3 <br> (1 ½, 2 ½, 3 ½ months) </td>
                    <td>
                    
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pneumococcal1st">
                      <br>
                      <label for="datetime"> 2nd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pneumococcal2nd">
                      <br>
                      <label for="datetime"> 3rd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="pneumococcal3rd">
                    
                    </td>
                    <td>
                      <br><br>
                      <select name="pneumococcalvaccinatorname1st">
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
                      <br><br>
                      <select name="pneumococcalvaccinatorname2nd">
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
                      <br><br>
                      <select name="pneumococcalvaccinatorname3rd">
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
                    </td>
                    <td>
                      <br><br>
                      <select name="pneumococcalhealthcenter1st">
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
                      <br><br>
                      <select name="pneumococcalhealthcenter2nd">
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
                      <br><br>
                      <select name="pneumococcalhealthcenter3rd">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                    </td>                    
                  </tr>
                </form>



                <form action="">
                  <tr>
                    <td> MEASLES, MUMPS, RUBELLA (MMR) </td>
                    <td> 2 <br> (9 months, 1 year old) </td>
                    <td>
                    
                      <label for="datetime"> 1st Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="mmr1st">
                      <br>
                      <label for="datetime"> 2nd Dose: </label>
                      <input type="datetime-local" id="dtlocal" name="mmr2nd">
                   
                    </td>
                    <td>
                    <br><br>
                    <select name="mmrvaccinatorname1st">
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
                      <br><br>
                      <select name="mmrvaccinatorname2nd">
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
                    </td>
                    <td>
                    <br><br>
                    <select name="mmrhealthcenter1st">
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
                      <br><br>
                      <select name="mmrhealthcenter2nd">
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
                    </td>
                    <td>
                      <button type="submit" name="submitbcg" class="btn btn-primary">Submit</button>
                    </td>
                  </tr>
                  </form>
              </tbody>
              </table>
              


<!-- Modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>