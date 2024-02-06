<?php
session_start();
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select user_id,username,user_type from users";
$result1 = mysqli_query($conn,$sql1); 
$name = $_SESSION['name'];
print_r($_SESSION);
$sender_id = $_SESSION['user_id']; 
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
        .containert{
            display: grid;
            place-content: center;
            min-height: 100vh;
        }
        .chat{
            background-color: red;
            padding: 2rem;
            border-radius: 10px;
        }
        .msg{
            width: 420px;
            height: 480px;
            border-top: 1px solid lightgrey;
            border-bottom: 1px solid lightgrey;
            margin: 1rem auto;
            padding: 1rem 0;
            display: flex;
            flex-direction: column;
        }
        .input_msg{
            display: flex;
            justify-content: space-between;
        }
        .input_msg .t{
            width: 75%;
        }
        .input{
            width: 80%;
            font-size: 1.3rem;
            padding: 0.4rem 1.3rem;
        }
        .input_msg button{
            background-color: #171747;
            color: white;
            border: none;
            cursor: pointer;
            padding: 0.5rem 1.2rem;
            font-size: 1.3rem;
            border-radius: 5px;
        }
        .msg p{
            background-color: gray;
            padding: 0.4rem 1rem;
            width: fit-content;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .msg p span{
            display: block;
            font-weight: bold;
            opacity: 0.5;
        }
        .msg .sender{
            background-color:green;
            align-self:end;
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
                if(mysqli_num_rows($result1)> 0){
                    while($row = $result1->fetch_assoc()){
                        echo"<tr>";
                        echo"<td>".$row['user_id']."</td>";
                        echo"<td>".$row['username']."</td>";
                        echo"<td>".$row['user_type']."</td>";
                        echo "<td><button class='btn btn-success' data-bs-toggle='collapse' data-bs-target='#collapseMessage".$row['user_id']."'>Send Message</button></td>";
                        echo"</tr>";
                        echo "<tr id='collapseMessage".$row['user_id']."' class='collapse'><td colspan='4'>
                        <div class='containert'>
                            <div class='chat'>
                                <h2>Welcome ".$name."</h2>
                                <div class='msg' id='messageBox" . $row['user_id'] . "'>

                                </div>
                                <div class='input_msg'>
                                <input type='text' class='t form-control' placeholder='Write message here' id='messageInput" . $row['user_id'] . "'>
                                <button class='btn btn-primary mt-2' onclick='sendMessage(" . $row['user_id'] . ")'>Send</button>
                                </div>
                            </div>
                        </div>
                    </td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function sendMessage(userId){
            const messageInput = document.getElementById('messageInput' + userId);
            const message = messageInput.value;
            const messageBox = document.getElementById('messageBox' + userId);
            const p = document.createElement('p');
            p.innerHTML = "<span>You:</span>"+ message;
            p.className = "sender";
            messageBox.appendChild(p);
            messageInput.value = '';
        }
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
