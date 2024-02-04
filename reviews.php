<?php
session_start();
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed" . mysqli_connect_error());
}
$id = $_SESSION["user_id"];
$sql = "SELECT * FROM feedback WHERE doctor_id IN (SELECT doctor_id FROM doctor WHERE user_id = '$id')";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #007bff;
        }

        .table {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #007bff;
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        tbody tr {
            animation: fadeIn 0.5s ease-in-out;
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
    <h1>Your Reviews</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Feedback Id</th>
                <th>Doctor Id</th>
                <th>Patient Id</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Rating (1-5)</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['feedback_id']}</td>";
                echo "<td>{$row['doctor_id']}</td>";
                echo "<td>{$row['patient_id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['comment']}</td>";
                echo "<td>{$row['rating']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
            }else{
                echo "<tr><td colspan='6'>0 Result Found...!</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</body>

</html>
