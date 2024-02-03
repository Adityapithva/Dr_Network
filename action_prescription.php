<?php
session_start();
require_once("./dompdf-2.0.4/dompdf/autoload.inc.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "/xampp/htdocs/PHP_PROJECT/PHPMailer/src/Exception.php";
require "/xampp/htdocs/PHP_PROJECT/PHPMailer/src/PHPMailer.php";
require "/xampp/htdocs/PHP_PROJECT/PHPMailer/src/SMTP.php";
use Dompdf\Dompdf;
use Dompdf\Options;
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST["doctor_id"];
    $patient_id = $_POST["patient_id"];
    $medication_details = $_POST["medication_details"];
    $dosage_instruction = isset($_POST["dosage_instruction"]) ? $_POST["dosage_instruction"] : "";
    $email = $_POST["email"];
    $name = $_POST["name"];
    $sql = "insert into prescription (doctor_id,patient_id,medication_details,dosage_instruction,date_created) values ('$doctor_id','$patient_id','$medication_details','$dosage_instruction',CURDATE())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $prescription_id = $conn->insert_id;
        $html_content = "
<html>
<head>
    <title>Prescription Details</title>
</head>
<body>
    <h2>Prescription Details</h2>
    <h4>Hello, $name </h4>
    <ul>
        <li><p><strong>Prescription ID:</strong> $prescription_id</p></li>
        <li><p><strong>Doctor ID:</strong> $doctor_id</p></li>
        <li><p><strong>Patient ID:</strong> $patient_id</p></li>
        <li><p><strong>Medication Details:</strong> $medication_details</p></li>
        <li><p><strong>Dosage Instruction:</strong> $dosage_instruction</p></li>
        <li><p><strong>Date Created:</strong> " . date('Y-m-d') . "</p></li>
    </ul>
</body>
</html>
";
        $options = new Options();
        $options->set("isHtml5ParserEnabled", "true");
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html_content);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $file_path = "prescription_$prescription_id.pdf";
        $output = $dompdf->output();
        file_put_contents($file_path, $output);
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'adityapithva36@gmail.com'; 
            $mail->Password   = 'zevvggicpqnpvzno';   
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom('adityapithva36@gmail.com', 'Aditya Pithva'); 
            $mail->addAddress($email);  
            $mail->addAttachment($file_path, "Prescription_Details.pdf");
            $mail->isHTML(true);
            $mail->Subject = 'Prescription Details';
            $mail->Body    = "Hello, $name .Please find attached prescription details.";
            $mail->send();
            echo 'Email sent successfully';
        } catch (Exception $e) {
            echo "Email sending failed: {$mail->ErrorInfo}";
        }
    }
}
