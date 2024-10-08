
<?php

require '../../../database/dbcon.php';

$query = "SELECT * FROM system  ";
$query_run = mysqli_query($conn, $query);

if (mysqli_num_rows($query_run) > 0) {
	$student = mysqli_fetch_array($query_run);
?><?php
								} else {
									echo "<h4>No Such Id Found</h4>";
								}

									?>
<?php
//send_mail.php

require '../../../database/config.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['push_notification'])) {

	require 'class/class.phpmailer.php';
	$output = '';
	$academic = $_POST['academic'];
	$semester = $_POST['semester'];

	$slq = "SELECT * FROM students INNER JOIN admission_score a ON students.applicant_id = a.applicant_id WHERE academic = '$academic' AND semester_id = '$semester' ";


	$res = mysqli_query($conn, $slq);
	if (mysqli_num_rows($res) > 0) {
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host       = 'smtp.gmail.com'; 		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port       = 465;								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = ($student['email_user']);					//Sets SMTP username
		$mail->Password   = ($student['email_pass']);				//Sets SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = ($student['email_user']);				//Sets the From email address for the message
		$mail->FromName = ($student['email_name']);						//Sets the From name of the message

		while ($gmail = mysqli_fetch_assoc($res)) {
			$mail->AddAddress($gmail['email']);

			$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
			$mail->IsHTML(true);							//Sets message type to HTML
			$mail->Subject = 'Admission Exam Score - MCC'; //Sets the Subject of the message
			//An HTML or plain text message body
			$id = $gmail['applicant_id'];
			$body = '<h4>Madridejos Community College check your Admission Test</h4>
				<p>Here is your Admission Assestment Report. Link provided below:</p>
				<a href="https://madridejoscommunitycollege.com/assestment?applicant_id=' . $id . '">https://madridejoscommunitycollege.com/assestment?applicant_id=' . $id . '</a>
				<br>
				<p>Please print this form:</p>
				<a href="https://madridejoscommunitycollege.com/enrollment-step?applicant_id=' . $id . '">https://madridejoscommunitycollege.com/enrollment-step?applicant_id=' . $id . '</a>
				<br>
				<p>Thank you for enrolling Madridejos Community College</p>
				';


			$mail->Body = "<p>$body, </p>";

			$mail->AltBody = '';

			$result = $mail->Send();						//Send an Email. Return true on success or false on error

			if ($result) {
				$output .= html_entity_decode($result);
			}
		}
		if ($output) {


			header('Location: ./?status=success');
		} else {
			header('Location: ./?status=error');
		}
	} else {
		header('Location: ./?status=error');
	}
}

?>