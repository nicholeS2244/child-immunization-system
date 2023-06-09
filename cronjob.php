
<?php
include "PHP/connection.php";
include "PHP/functions.php";
include "vaccinedate.php";
include "sendmail.php";

$user_data = check_login($con);
$child_data = child($con);
$parent_id = $user_data['parent_id'];

$sql_p = "SELECT * FROM parent_tbl";
$stmt_p = $con->prepare($sql_p);
$stmt_p->execute();
$result_p = $stmt_p->get_result();

while ($row = $result_p->fetch_assoc()) {
    $parentID = $row['parent_id'];
    $parentFN = $row['firstname'];
    $parentLN = $row['lastname'];
    $email = $row['email'];
    $parentName = $parentFN . " " . $parentLN;

    $sql_c = "SELECT * FROM child_tbl where parent_id='$parentID'";
    $stmt_c = $con->prepare($sql_c);
    $stmt_c->execute();
    $result_c = $stmt_c->get_result();

    while ($row = $result_c->fetch_assoc()) {
        $childFN = $row['firstname'];
        $childLN = $row['lastname'];
        $dob = $row['dateofbirth'];
        $childName = $childFN . " " . $childLN;

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

            $subject = "Vaccination reminder to " . $parentName . " - CIC";

            $message =
                "Hello, <b>" .
                $parentName .
                "</b>,<br> Your child, <b>" .
                $childName .
                "</b>, will have a <b>" .
                $vaccinename .
                "</b> vaccine dose after 7 days on <b>" .
                $vaccinedate->format('d F, Y') .
                "</b>.<br>Kindly get him vaccinated at a nearby vaccination center.
            <br><br> Thank you,<br><b>Child Immunization Center.</b><br>";

            $mail_date = $vaccinedate->sub(new DateInterval('P7D'));
            $today = date("Y-m-d");

            if ($today > $mail_date) {
                sendEmail($email, $subject, $message);
            }
            sendEmail($email, $subject, $message);
        }
    }
}


?>
