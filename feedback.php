<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
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

        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="submit_feedback.php" method="post">
        <label for="doctor_id">Doctor ID:</label>
        <input type="text" name="doctor_id" required><br>

        <label for="patient_id">Patient ID:</label>
        <input type="text" name="patient_id" required><br>

        <label for="name">Your Name:</label>
        <input type="text" name="name" required><br>

        <label for="comment">Comment:</label>
        <textarea name="comment" rows="4" cols="50" required></textarea><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>

        <input type="submit" value="Submit Feedback">
    </form>
</body>
</html>
