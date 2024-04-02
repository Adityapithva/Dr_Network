<?php
session_start();
$conn = new mysqli("localhost","root",12345,"healthcare");
if(mysqli_connect_errno()){
    die("Connection failed". mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $doctor_id = $_POST["doctor_id"];
    $patient_id = $_POST["patient_id"];
    $invoice_details = $_POST["invoice_details"];
    $amount = $_POST["amount"];
    $status = "pending";
    $sql = "insert into billing (doctor_id,patient_id,invoice_details,amount,status) values ('$doctor_id','$patient_id','$invoice_details','$amount','$status')";
    $result = mysqli_query($conn, $sql);
}
$id = $_SESSION["user_id"];
$query = "select * from billing where doctor_id in (select doctor_id from doctor where user_id = '$id')";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing and Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .table-container {
            margin-top: 30px;
            animation: slideIn 1s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
        <div class="form-container">
            <form action="billing.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="doctor_id">Doctor ID:</label>
                    <input type="text" name="doctor_id" required><br>
                </div>
                <div class="mb-3 mt-3">
                    <label for="patient_id">Patient ID:</label>
                    <input type="text" name="patient_id" required><br>
                </div>
                <div class="mb-3 mt-3">
                    <label for="invoice_details">Invoice Details:</label>
                    <textarea name="invoice_details" rows="4" required></textarea><br>
                </div>
                <div class="mb-3 mt-3">
                    <label for="amount">Amount:</label>
                    <input type="number" step="0.01" name="amount" required><br>
                </div>
                <input type="submit" value="Create Billing Record">
            </form>
        </div>
    </div>
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
        <div class="conatiner table-container">
            <h2 class="mt-5">List of Invoices Generated by You</h2>
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
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['billing_id'] . "</td>";
                            echo "<td>" . $row['doctor_id'] . "</td>";
                            echo "<td>" . $row['patient_id'] . "</td>";
                            echo "<td>" . $row['invoice_details'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='6'>0 Results Found...</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>