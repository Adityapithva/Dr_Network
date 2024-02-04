<?php
session_start();
$user_name = $_SESSION["u_name"];
$conn = new mysqli("localhost","root",12345,"healthcare");
if(mysqli_connect_errno()){
    die("Connection failed: ". mysqli_connect_error());
}
$sql = "select * from doctor";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request an Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            color: #007bff;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
        }

        label {
            font-weight: bold;
            color: #007bff;
            transition: color 0.3s ease-in-out;
        }

        .form-control {
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease-in-out;
        }

        textarea {
            resize: none;
            transition: box-shadow 0.3s ease-in-out;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-group:hover label,
        .form-control:hover,
        textarea:hover {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        table{
            max-width: 100%;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f8f9fa;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>List of available Doctors</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Doctor_id</th>
                    <th>User_id</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Specification</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>". $row["doctor_id"] ."</td>";
                    echo "<td>". $row["user_id"] ."</td>";
                    echo "<td>". $row["name"] ."</td>";
                    echo "<td>". $row["ph_no"] ."</td>";
                    echo "<td>". $row["email"] ."</td>";
                    echo "<td>". $row["specification"] ."</td>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <h2 class="text-center">Welcome, <?php echo $user_name ?></h2>
        <form action="/PHP_PROJECT/action_appointment.php" method="post">
            <div class="form-group">
                <label for="patient_id">Patient ID:</label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" required>
            </div>
            <div class="form-group">
                <label for="doctor_id">Doctor ID:</label>
                <input type="text" class="form-control" id="doctor_id" name="doctor_id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Appointment:</label>
                <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
            </div>
            <input type="submit" name="submit" value="Request Appointment" class="btn btn-primary">
        </form>
    </div>
</body>
</html>
