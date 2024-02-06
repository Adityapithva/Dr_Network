<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <script>
            const socket = new WebSocket('ws://localhost:5001');

socket.onopen = (event) => {
    console.log('Connected to WebSocket server');
    socket.send('Hello, WebSocket server!');
};

socket.onmessage = (event) => {
    console.log("Received message: ${event.data}");
};

socket.onclose = (event) => {
    console.log('WebSocket connection closed');
};
        </script>
</body>
</html>