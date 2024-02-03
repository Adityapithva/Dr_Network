<?php
session_start();
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed:". mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["user_id"];
    $name = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];
    $sql = "select * from users where user_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        switch($user_type){
            case "doctor":
                $_SESSION["user_id"] = $id;
                $_SESSION["name"] = $name;
                header("Location: Doctor_page.php");
                break;
            case "patient":
                $_SESSION["user_id"] = $id;
                header("Location: Patient_page.php");
                break;
            default:
                header("Location: index.html");
        }
        exit();
    }else{
        echo "Authentication failed. Please check crendentials";
    }
}