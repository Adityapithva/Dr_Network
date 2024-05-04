<?php
session_start();
$id = $_SESSION["user_id"];
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed:" . mysqli_connect_error());
}
$sql = "select * from billing where patient_id in (select patient_id from patients where user_id = '$id')";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");
        :root {
            --primary-color: #28bf96;
            --primary-color-dark: #209677;
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .table-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-container table th,
        .table-container table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }

        .table-container table th {
            background-color: #007bff;
            color: #fff;
        }

        .table-container table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-container table tbody tr:hover {
            background-color: #cce5ff;
        }

        .no-results {
            text-align: center;
            font-style: italic;
            color: #777;
        }
        .make-payment-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .make-payment-btn:hover {
            background-color: #218838;
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

        .link a:hover {
            color: var(--primary-color);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
        <div class="table-container">
            <h2>List of Pending and Completed Payments</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Billing Id</th>
                        <th>Doctor Id</th>
                        <th>Patient Id</th>
                        <th>Invoice Details</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['billing_id'] . "</td>";
                            echo "<td>" . $row['doctor_id'] . "</td>";
                            echo "<td>" . $row['patient_id'] . "</td>";
                            echo "<td>" . $row['invoice_details'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td><button class='make-payment-btn'>Make Payment</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-results'>0 Results Found...</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
