<?php
session_start();

include "PHP/connection.php";
include "PHP/functions.php";

$user_data = check_login($con);


function itexmo($number, $message, $apicode, $passwd)
{
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = ['1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd];
    $param = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($itexmo),
        ],
    ];
    $context = stream_context_create($param);
    return file_get_contents($url, false, $context);
}
//##########################################################################

if ($_POST) {
    $number = $_POST['number'];
    $name = $_POST['name'];
    $msg = $_POST['msg'];
    $api = "TR-PATPE797790_QMKWB";
    $pass = "2[)ewnm4cn";
    $text = $name . ":   " . $msg;

    if (!empty($_POST['name']) && $_POST['number'] && $_POST['msg']) {
        $result = itexmo($number, $text, $api, $pass);
        if ($result == "") {
            echo "iTexMo: No response from server!!!
    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
    Please CONTACT US for help. ";
        } elseif ($result == 0) {
            echo "Message Sent!";
        } else {
            echo "Error Num " . $result . " was encountered!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SMS Notification | Admin</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/admin_sms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
    
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
          <li><a href="admin_child.php"><i class="fas fa-child"  id="icon"></i>Child Profile</a></li>
          <li><a href="admin_chart.php"><i class="fa fa-chart-bar"  id="icon"></i>Vaccine Chart</a></li>
          <li><a href="admin_guide.php"><i class="fas fa-book"  id="icon"></i>Nutrition Guide</a></li>
          <li><a href="admin_sms.php" class="active"><i class="fas fa-comment"  id="icon"></i>SMS Notification</a></li>
        
          <div class="dropdown">
            <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
            <a href="PHP/logout.php"><i class="fas fa-sign-out-alt" id="icon"></i>Logout</a>
            </div>
            
          </div>
        </ul>
      </nav>


                    <center><form action="admin_sms.php" method="POST" style="width: 30%">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" maxlength="15" class="form-control" id="name" placeholder="Name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Recipient's Mobile Number</label>
                            <input type="text" maxlength="11" class="form-control" id="number" placeholder="Mobile Number" name="number" required>
                        </div>
                        <div class="form-group">
                            <label for="msg">Your Message</label>
                            <textarea class="form-control" rows="3" name="msg" placeholder="Message here" onkeyup="countChar(this)" required></textarea>
                        </div>
                        <!-- <div class="form-group toShowSched" style="display: none;">
                <label>Scheduled At:</label>
                <input type="date" class="date" name="date" required>
            </div> -->
                        <p class="text-right" id="charNum">100</p>
                        <button type="submit" class="btn btn-success">Send</button>
                    </form></center>
   
    <!-- sms -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="JS/bootstrap.min.js"></script>

        <script>
            function countChar(val){
                var len = val.value.length;
                if (len >=85){
                    val.value = val.value.substring(0,85);
                }else{
                    $('#charNum').text(85-len);
                }
            };
        </script>
</body>
</html>