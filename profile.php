<?php
session_start();
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed:" . mysqli_connect_error());
}
$u_id = $_SESSION["user_id"];
$sql = "select * from doctor where user_id = $u_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $doctor_id = $row["doctor_id"];
    $user_id = $row["user_id"];
    $name = $row["name"];
    $_SESSION["name"] = $name;
    $ph_no = $row["ph_no"];
    $email = $row["email"];
    $specification = $row["specification"];
} else {
    echo "Fail to fetch data";
}
$sql2 = "select password from users where user_id = $u_id";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_array($result2);
    $password = $row2["password"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile_Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        :root {
            --blue: #3498db;
            --dark-blue: #2980b9;
            --red: #e74c3c;
            --dark-red: #c0392b;
            --black: #333;
            --white: #fff;
            --light-bg: #eee;
            --box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        *::-webkit-scrollbar {
            width: 10px;
        }

        *::-webkit-scrollbar-track {
            background-color: transparent;
        }

        *::-webkit-scrollbar-thumb {
            background-color: var(--blue);
        }

        .btn,
        .delete-btn {
            width: 100%;
            border-radius: 5px;
            padding: 10px 30px;
            color: var(--white);
            display: block;
            text-align: center;
            cursor: pointer;
            font-size: 20px;
            margin-top: 10px;
        }

        .btn {
            background-color: var(--blue);
        }

        .btn:hover {
            background-color: var(--dark-blue);
        }

        .delete-btn {
            background-color: var(--red);
        }

        .delete-btn:hover {
            background-color: var(--dark-red);
        }

        .message {
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            background-color: var(--red);
            color: var(--white);
            font-size: 20px;
        }

        .form-container {
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container form {
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            text-align: center;
            width: 500px;
            border-radius: 5px;
        }

        .form-container form h3 {
            margin-bottom: 10px;
            font-size: 30px;
            color: var(--black);
            text-transform: uppercase;
        }

        .form-container form .box {
            width: 100%;
            border-radius: 5px;
            padding: 12px 14px;
            font-size: 18px;
            color: var(--black);
            margin: 10px 0;
            background-color: var(--light-bg);
        }

        .form-container form p {
            margin-top: 15px;
            font-size: 20px;
            color: var(--black);
        }

        .form-container form p a {
            color: var(--red);
        }

        .form-container form p a:hover {
            text-decoration: underline;
        }

        .container {
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container .profile {
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            text-align: center;
            width: 400px;
            border-radius: 5px;
        }

        .container .profile img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        .container .profile h3 {
            margin: 5px 0;
            font-size: 20px;
            color: var(--black);
        }

        .container .profile p {
            margin-top: 20px;
            color: var(--black);
            font-size: 20px;
        }

        .container .profile p a {
            color: var(--red);
        }

        .container .profile p a:hover {
            text-decoration: underline;
        }

        .update-profile {
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .update-profile form {
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            text-align: center;
            width: 700px;
            text-align: center;
            border-radius: 5px;
        }

        .update-profile form img {
            height: 200px;
            width: 200p;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        .update-profile form .flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 15px;
        }

        .update-profile form .flex .inputBox {
            width: 49%;
        }

        .update-profile form .flex .inputBox span {
            text-align: left;
            display: block;
            margin-top: 15px;
            font-size: 17px;
            color: var(--black);
        }

        .update-profile form .flex .inputBox .box {
            width: 100%;
            border-radius: 5px;
            background-color: var(--light-bg);
            padding: 12px 14px;
            font-size: 17px;
            color: var(--black);
            margin-top: 10px;
        }

        @media (max-width:650px) {
            .update-profile form .flex {
                flex-wrap: wrap;
                gap: 0;
            }

            .update-profile form .flex .inputBox {
                width: 100%;
            }
        }
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
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");
        .link a:hover {
            color: var(--primary-color);
        }


    </style>
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
        <div class="profile">
            <img src="Images/4333097.jpeg" alt="">
            <h3><?php echo $name; ?></h3>
            <a href="update_profile.php" class="btn">Update profile</a>
            <a href="index.html" class="delete-btn">Log Out</a>
        </div>
    </div>
</body>

</html>