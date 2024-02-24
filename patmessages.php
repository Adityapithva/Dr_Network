<?php
session_start();
$sender_id = $_SESSION['user_id'];
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
// $sql1 = "select user_id,username,user_type from users where user_id != '$sender_id'";
// $result1 = mysqli_query($conn, $sql1);
// $name = $_SESSION['name'];
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $message = $_POST['content'];
//     $receiver_id = $_POST['receiver_id'];
//     $sql2 = "insert into messages (sender_id,receiver_id,message_content,time) values ('$sender_id','$receiver_id','$message',NOW())";
//     $result2 = mysqli_query($conn, $sql2);
// }
// $sql_result = "select sender_id,message_content,time from messages where receiver_id = '$receiver_id' and sender_id = '$sender_id'";
// $result_received = mysqli_query($conn, $sql_result);
// $received_messages = array();
// if(mysqli_num_rows($result_received) > 0){
//     while($row_received = mysqli_fetch_assoc($result_received)){
//         $received_messages[] = $row_received;
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var conn = new WebSocket('ws://localhost:5001');
            conn.onopen = function(e) {
                console.log("Connection established!");
            };
            
            conn.onmessage = function(e) {
                var message = JSON.parse(e.data);
                $('.messages').append('<p><strong>' + message.sender_id + ': </strong>' + message.message + '</p>');
            };
        });
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");

        nav {
            padding: 2rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .nav__logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .nav__links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .link a {
            text-decoration: none;
            color: var(--text-light);
            cursor: pointer;
            transition: 0.3s;
        }

        :root {
            --primary-color: #28bf96;
            --primary-color-dark: #209677;
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        .link a:hover {
            color: var(--primary-color);
        }
        
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<nav>
            <div class="nav__logo"><img src="Images/logo.png" alt=""></div>
            <ul class="nav__links">
                <li class="link"><a href="patprofile.php">Profile</a></li>
                <li class="link"><a href="patappointment.php">Request an Appointment</a></li>
                <li class="link"><a href="patmessages.php">Messages</a></li>
                <li class="link"><a href="makepayment.php">Billing and Invoice</a></li>
                <li class="link"><a href="feedback.php">Feedback</a></li>
            </ul>
        </nav>
        <div class="container">
            <h2>Receiver Page</h2>
            <div class="messages"></div>
        </div>
</body>

</html>