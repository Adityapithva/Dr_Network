<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");
        :root {
            --primary-color: #28bf96;
            --primary-color-dark: #209677;
            --text-dark: #111827;
            --text-light: #6b7280;
            --white: #ffffff;
        }
        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <form action="submit_feedback.php" method="post">
        <h2>Feedback Form</h2>
        <label for="doctor_id">Doctor ID:</label>
        <input type="text" name="doctor_id" required>

        <label for="patient_id">Patient ID:</label>
        <input type="text" name="patient_id" required>

        <label for="name">Your Name:</label>
        <input type="text" name="name" required>

        <label for="comment">Comment:</label>
        <textarea name="comment" rows="4" required></textarea>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <input type="submit" value="Submit Feedback">
    </form>
</body>

</html>
