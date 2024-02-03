<?php
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if(mysqli_connect_errno()){
    die("Connection failed: " . mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $doctor_id = $_POST["doctor_id"];
    $patient_id = $_POST["patient_id"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $rating = $_POST["rating"];
    $sql = "INSERT INTO feedback (doctor_id, patient_id, name, comment, rating) VALUES ('$doctor_id', '$patient_id', '$name', '$comment', '$rating')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Feedback submitted successfully";
    } else {
        echo "Error while submitting feedback: " . $conn->error;
    }
}


