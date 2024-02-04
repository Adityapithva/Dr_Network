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
            align-items: center;
            justify-content: center;
            height: 100vh;
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
    </style>
</head>

<body>

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
</body>

</html>
