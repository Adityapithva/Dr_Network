<?php
session_start();
$conn = new mysqli("localhost","root",12345,"healthcare");
$u_id = $_SESSION["user_id"];
$sql = "select * from doctor where user_id = $u_id";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
}
$sql2 = "select password from users where user_id = $u_id";
$result2 = mysqli_query($conn, $sql2);
if(mysqli_num_rows($result2)> 0){
    $row2 = mysqli_fetch_assoc($result2);
}
if(isset($_POST['update_profile'])){
    $update_name = mysqli_real_escape_string($conn,$_POST['update_name']);
    $update_ph_no =  mysqli_real_escape_string($conn,$_POST['update_ph_no']);
    $update_email =  mysqli_real_escape_string($conn,$_POST['update_email']);
    $update_s =  mysqli_real_escape_string($conn,$_POST['update_s']);
    $update_pass =  mysqli_real_escape_string($conn,$_POST['update_pass']);
    $sql3 = "update doctor set name='$update_name',ph_no = '$update_ph_no',email='$update_email',specification='$update_s' where user_id = $u_id";
    $result3 = mysqli_query($conn,$sql3);
    $sql4 = "update users set username='$update_name',password='$update_pass',email='$update_email' where user_id = $u_id";
    $result4 = mysqli_query($conn,$sql4);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

        :root {
            --blue: #3498db;
            --dark-blue: #2980b9;
            --red: #e74c3c;
            --dark-red: #c0392b;
            --black: #333;
            --white: #fff;
            --light-bg: #eee;
            --box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        .update-profile {
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .update-profile form {
            padding: 20px;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            text-align: center;
            width: 70%;
            max-width: 500px;
            border-radius: 5px;
        }

        .update-profile form img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .update-profile form .flex {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .update-profile form .inputBox {
            flex: 0 0 48%;
        }

        .update-profile form .inputBox span {
            text-align: left;
            display: block;
            margin-top: 10px;
            font-size: 16px;
            color: var(--black);
        }

        .update-profile form .inputBox .box {
            width: 100%;
            border-radius: 5px;
            background-color: var(--light-bg);
            padding: 12px 14px;
            font-size: 16px;
            color: var(--black);
            margin-top: 8px;
        }

        .btn,
        .delete-btn {
            width: 100%;
            border-radius: 5px;
            padding: 10px 30px;
            color: var(--white);
            display: block;
            text-align: center;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
        }

        .btn {
            background-color: var(--blue);
        }

        .btn:hover {
            background-color: var(--dark-blue);
        }

        .delete-btn {
            background-color: var(--red);
        }

        .delete-btn:hover {
            background-color: var(--dark-red);
        }
    </style>
</head>
<body>
    <div class="update-profile">
        <form action="" method="post">
            <img src="Images/4333097.jpeg" alt="">
            <div class="flex">
                <div class="inputBox">
                    <span>User Name:</span>
                    <input type="text" name="update_name" value="<?php echo $row['name']?>" class="box">
                </div>
                <div class="inputBox">
                    <span>Phone Number:</span>
                    <input type="text" name="update_ph_no" value="<?php echo $row['ph_no']?>" class="box">
                </div>
                <div class="inputBox">
                    <span>Email:</span>
                    <input type="email" name="update_email" value="<?php echo $row['email']?>" class="box">
                </div>
                <div class="inputBox">
                    <span>Specification:</span>
                    <input type="text" name="update_s" value="<?php echo $row['specification']?>" class="box">
                </div>
                <div class="inputBox">
                    <span>Password:</span>
                    <input type="password" name="update_pass" value="<?php echo $row2['password']?>" class="box" placeholder="Enter your previous password:">
                </div>
            </div>
            <input type="submit" value="Update Profile" name="update_profile" class="btn">
            <a href="profile.php" class="delete-btn">Go Back</a>
        </form>
    </div>
</body>
</html>
