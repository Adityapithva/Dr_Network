<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        nav {
            padding: 2rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            width: 100%;
        }

        .nav__logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 8px;
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

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px; /* Adjusted max-width for better readability */
            width: 100%;
            margin-top: 20px; /* Add margin to separate form from navbar */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .row {
            display: flex;
            gap: 20px; /* Adjust the gap between inputs */
        }

        .mb-3 {
            flex: 1;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #4CAF50;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        textarea {
            resize: vertical;
        }

        /* Improved styling for small screens */
        @media (max-width: 600px) {
            form {
                max-width: 100%;
            }

            .row {
                flex-direction: column;
            }
        }

        :root {
            --primary-color: #28bf96;
            --primary-color-dark: #209677;
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");
    </style>
</head>

<body>
<nav>
        <div class="nav__logo"><img src="Images/logo.png" alt=""><a href="Doctor_page.php"></a></div>
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
    <form action="action_prescription.php" method="post">
        <h2>Prescription Form</h2>
        <div class="row" style="margin-bottom: 3px;">
            <div class="mt-1">
                <label for="doctor_id">Doctor Id:</label>
                <input type="text" name="doctor_id" placeholder="Enter doctor id:" required>
            </div>
            <div class="mt-1">
                <label for="patient_id">Patient Id:</label>
                <input type="text" name="patient_id" placeholder="Enter patient id:" required>
            </div>
        </div>
        <div class="mt-1">
            <label for="medication_details">Medication Details:</label>
            <textarea name="medication_details" rows="4"  required style="margin-bottom: 3px;"></textarea>
        </div>
        <div class=" mt-1">
            <label for="dosage_instruction">Dosage Instructions:</label>
            <textarea name="dosage_instruction" rows="4" style="margin-bottom: 3px;"required></textarea>
        </div>
        <div class="row" style="margin-bottom:5px">
            <div class="mt-1">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Enter email of patient:" required>
            </div>
            <div class="mt-1">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Enter name of patient:" required>
            </div>
        </div>
        <input type="submit" value="Generate Prescription">
    </form>
    </div>
</body>

</html>
