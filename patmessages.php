<?php
session_start();
$sender_id = $_SESSION['user_id'];
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select user_id,username,user_type from users";
$result1 = mysqli_query($conn, $sql1);
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
        .card{
            max-width: 400px;
            height: 500px !important;
            margin: 5px;
            padding: 5px;
        }
        .card-body{
            overflow-y: scroll;
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($result1) > 0){
                    while($row = $result1->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['user_type']."</td>";
                        echo "<td><button class='btn btn-success' data-bs-toggle='collapse' data-bs-target='#collapseexample" . $row['user_id'] . "'>Message</button>";
                        echo "<div class='collapse' id='collapseexample" . $row['user_id'] . "'>";
                        echo "<div class='card'>";
                        echo "<div class='card-header'>Welcome $name</div>";
                        echo "<div class='card-body messages'>";
                        echo "</div>";
                        echo "<div class='card-footer'>";
                        echo"<form id='message_form'>
                        <input type='hidden' id='sender_id' value=1>
                        <input type='hidden' id='receiver_id'>
                        <input type='text' id='message'  placeholder='Type your message...'>
                        <button type='button' class='btn btn-success'>Send</button>
                        </form>
                        ";
                        echo "</div></div></div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>