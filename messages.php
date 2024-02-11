<?php
session_start();
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select user_id,username,user_type from users";
$result1 = mysqli_query($conn, $sql1);
$name = $_SESSION['name'];
$sender_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['content'];
    $reciver_id = $_POST['receiver_id'];
    $sql2 = "insert into messages (sender_id,receiver_id,message_content,time) values ('$sender_id','$reciver_id','$message',NOW())";
    $result2 = mysqli_query($conn, $sql2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
        .card-body{
            max-height: 500px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav>
        <div class="nav__logo"><img src="Images/logo.png" alt=""></div>
        <ul class="nav__links">
            <li class="link"><a href="profile.php">Profile</a></li>
            <li class="link"><a href="appointment.php">Your Appointments</a></li>
            <li class="link"><a href="prescription.php">Prescription</a></li>
            <li class="link"><a href="messages.php">Messages</a></li>
            <li class="link"><a href="cme.php">CME</a></li>
            <li class="link"><a href="billing.php">Billing and Invoice</a></li>
            <li class="link"><a href="reviews.php">Your Reviews</a></li>
        </ul>
    </nav>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result1) > 0) {
                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['user_type'] . "</td>";
                        echo "<td><button class='btn btn-success' data-bs-toggle='collapse' data-bs-target='#collapseexample" . $row['user_id'] . "'>Message</button>";
                        echo "<div class='collapse' id='collapseexample" . $row['user_id'] . "'>";
                        echo "<div class='card'>";
                        echo "<div class='card-header'>Welcome $name</div>";
                        echo "<div class='card-body'>";
                        $sql3 = "SELECT * FROM messages WHERE sender_id = '$sender_id' AND receiver_id = '" . $row['user_id'] . "'";
                        $result3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($result3) > 0) {
                            while ($message_row = mysqli_fetch_assoc($result3)) {
                                echo "<p>You:".$message_row['message_content']."</p>";
                            }
                        } else {
                            echo "<p>No messages sent.</p>";
                        }
                        echo "</div>";
                        echo "<div class='card-footer'>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='receiver_id' value='" . $row['user_id'] . "'>";
                        echo "<input type='text' placeholder='Type your message' name='content'>";
                        echo "<button class='btn btn-success'>Send</button>";
                        echo "</form>";
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
    <script>
        const socket = new WebSocket('ws://localhost:5001');

        socket.onopen = (event) => {
            console.log('Connected to WebSocket server');
            socket.send('Hello, WebSocket server!');
        };

        socket.onmessage = (event) => {
            console.log("Received message: $event.data");
        }
        socket.onclose = (event) => {
            console.log('WebSocket connection closed');
        };
    </script>
</body>

</html>