<?php
session_start();
$conn = new mysqli("localhost","root",12345,"healthcare");
if(mysqli_connect_errno()){
    die("Connection failed: ".mysqli_connect_error());
}
$user_name = $_SESSION["u_name"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $p_id = $_POST["patient_id"];
    $d_id = $_POST["doctor_id"];
    $name = $_POST["name"];
    $date = $_POST["date"];
    $status = "pending";
    $reason = $_POST["reason"];
    $sql = "insert into appointment (doctor_id,patient_id,appointment_date,status,reason) values ('$d_id','$p_id','$date','$status','$reason')";
    if($conn->query($sql)){
        echo"Appointment successfully requested";
    }else{
        echo "Error while requesting ".$conn->error;
    }
}