<?php
$conn = mysqli_connect("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "SELECT * FROM patients";
$result1 = mysqli_query($conn, $sql1);
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
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Patient Id</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result1)) {
                    echo "<tr>";
                    echo "<td>" . $row['patient_id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['contact_details'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
