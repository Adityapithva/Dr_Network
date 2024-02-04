<?php
session_start();
$name = $_SESSION["name"];
$conn = new mysqli("localhost", "root", 12345, "healthcare");
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select * from medical_resources";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "select * from cource";
$result2 = mysqli_query($conn, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continuing Medical Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            margin-top: 20px;
        }

        h4 {
            color: #333;
        }

        table {
            width: 100%;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .card {
            width: 100%;
            height: 100%;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }

        .card-body {
            padding: 15px;
            text-align: justify;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
        }

        .btn-enroll {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
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
    <h3>Welcome, Dr.<?php echo $name ?>!</h3>
    <div class="container">
        <h4>Medical Resources</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Resource Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo "<tr>";
                    echo "<td>{$row['resource_id']}</td>";
                    echo "<td>{$row['title']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td>{$row['link']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-4">
        <h2>List of available online courses</h2>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result2)) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-header"><strong>Name:</strong> ' . $row['name'] . '</div>';
                echo '<div class="card-body">';
                echo '<strong>Description:</strong>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '</div>';
                echo '<div class="card-footer"><strong>Price:</strong> ' . $row['price'].'/-'. '</div>';
                echo '<div class="card-footer"><button class="btn btn-enroll">Enroll Now</button></div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>
