<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");

:root {
    --primary-color: #28bf96;
    --primary-color-dark: #209677;
    --text-dark: #111827;
    --text-light: #6b7280;
    --white: #ffffff;
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.btn {
    padding: 1rem 2rem;
    outline: none;
    border: none;
    font-size: 1rem;
    color: var(--white);
    background-color: var(--primary-color);
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background-color: var(--primary-color-dark);
}

body {
    font-family: "Roboto", sans-serif;
}

.container {
    max-width: 1200px;
    margin: auto;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
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

.header {
    padding: 0 1rem;
    flex: 1;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    align-items: center;
}

.content h1 {
    margin-bottom: 1rem;
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-dark);
}

.content h1 span {
    font-weight: 400;
}

.content p {
    margin-bottom: 2rem;
    color: var(--text-light);
    line-height: 1.75rem;
}

.image {
    position: relative;
    text-align: center;
    isolation: isolate;
}

.image__bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 450px;
    width: 450px;
    background-color: var(--primary-color);
    border-radius: 100%;
    z-index: -1;
}

.image img {
    width: 100%;
    max-width: 475px;
}

.image__content {
    position: absolute;
    top: 50%;
    left: 50%;
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    text-align: left;
    background-color: var(--white);
    border-radius: 5px;
    box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.image__content__1 {
    transform: translate(calc(-50% - 12rem), calc(-50% - 8rem));
}

.image__content__1 span {
    padding: 10px 12px;
    font-size: 1.5rem;
    color: var(--primary-color);
    background-color: #defcf4;
    border-radius: 100%;
}

.image__content__1 h4 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
}

.image__content__1 p {
    color: var(--text-light);
}

.image__content__2 {
    transform: translate(calc(-50% + 8rem), calc(-50% + 10rem));
}

.image__content__2 ul {
    list-style: none;
    display: grid;
    gap: 1rem;
}

.image__content__2 li {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    color: var(--text-light);
}

.image__content__2 span {
    font-size: 1.5rem;
    color: var(--primary-color);
}

@media (width < 900px) {
    .nav__links {
        display: none;
    }

    .header {
        padding: 1rem;
        grid-template-columns: repeat(1, 1fr);
    }

    .content {
        text-align: center;
    }

    .image {
        grid-area: 1/1/2/2;
    }
}
.background-image{
    background: url(Images/background.jpg);
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-repeat: no-repeat;
    padding-top: 6%;
    position: relative;
}
#a {
    display: inline-block;
    padding: 1rem 3rem;
    background-color: var(--primary-color);
    color: var(--white);
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

#a:hover {
    background-color: var(--primary-color-dark);
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
    <div class="background-image">
        <div class="background-content">
            <h1>Provide an exceptional <br>patient exprience</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti reiciendis exercitationem expedita ut eum commodi, quis ea, nihil necessitatibus laboriosam blanditiis eligendi facere illo ducimus sunt magnam. Inventore, rem explicabo.</p>
            <a href="#" id="a">Read More</a>
        </div>
    </div>
</body>

</html>