<?php
session_start();
$user_name = $_SESSION["name"];
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && isset($_POST['appointment_id'])) {
        $action = $_POST['action'];
        $appointmentId = $_POST['appointment_id'];

        if ($action === 'accept') {
            $updateSql = "UPDATE appointment SET status='accepted' WHERE appointment_id=$appointmentId";
            mysqli_query($conn, $updateSql);
        } elseif ($action === 'reschedule') {

        }
    }
}
$id = $_SESSION["user_id"];

$sql = "SELECT * FROM appointment where doctor_id in (select doctor_id from doctor where user_id = '$id')";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            color: #007bff;
            margin-top: 20px;
        }
        .container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .accept-btn,
        .reschedule-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .accept-btn {
            background-color: #28a745;
            color: #fff;
        }
        .reschedule-btn {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome,
            <?php echo $user_name ?>
        </h2>
        <h3>List of requested Appointments</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Appointment Id</th>
                    <th>Doctor Id</th>
                    <th>Patient Id</th>
                    <th>Appointment Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["appointment_id"] . "</td>";
                    echo "<td>" . $row["doctor_id"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["appointment_date"] . "</td>";
                    echo "<td>" . $row["reason"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="action" value="accept">';
                    echo '<input type="hidden" name="appointment_id" value="' . $row["appointment_id"] . '">';
                    echo '<button type="submit" class="accept-btn">Accept</button>';
                    echo '</form>';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="action" value="reschedule">';
                    echo '<input type="hidden" name="appointment_id" value="' . $row["appointment_id"] . '">';
                    echo '<button type="submit" class="reschedule-btn">Reschedule</button>';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                }
                }else{
                    echo "<tr><td colspan='6'>0 Results Found...</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
