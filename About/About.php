<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// require_once 'Controller/UserController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace</title>
    <link rel="stylesheet" href="./../../ADMS/styles.css">
    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/9a6693ad48.js" crossorigin="anonymous"></script>
    <style>
        /*add background image in top*/
        .about_top {
            background-image: url("https://www.chavarainstitute.com/assets/images/ielts-banner.jpg");
            background-size: cover;
            color: var(--text);
            text-align: center;
            margin-top: 50px;
            padding: 150px;
            font-size: 30px;
            box-shadow: inset 0px 0px 400px 110px rgba(0, 0, 0, .7);
        }

        /*journey of Eduspace part  */
        .about_eduspace {
            display: grid;
            grid-template-columns: 60% 40%;
            gap: 30px;
            margin-inline: 10%;
        }

        .About_eduspace_details {
            width: 80%;
        }

        .about-tittle {
            margin-top: 15%;
            margin-left: 10%;
        }

        /* short underline */
        .About-tittle-header {
            display: inline-block;
            position: relative;
        }

        .About-tittle-header::after {
            content: '';
            height: 3px;
            width: 10%;
            background: var(--text);
            position: absolute;
            left: 0;
            bottom: 0;
        }

        #part-about-tittle {
            color: var(--text);
        }

        .about-para {
            text-align: justify;
            margin-top: 2%;
            margin-left: 10%;
            margin-right: 5%;
        }

        .about-btn {
            font-weight: 700;
            color: white;
            padding: 1% 4%;
            background: var(--text);
            border: none;
            border-radius: 10px;
            margin-top: 2%;
            margin-left: 10%;
            margin-right: 5%;
        }

        .course-card {
            width: 300px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        /* Make the image fit the card width */
        .course-card img {
            height: 100%;
            width: 350px;
        }

        /* Center the text content */
        .course-card h3,
        .course-card p {
            text-align: center;
        }

        /* Add some hover effect to the card */
        .course-card:hover {
            /* Change the border color */
            border-color: blue;

            /* Add some shadow effect */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);

            /* Rotate the card slightly */
            transform: rotate(5deg);

            /* Transition the effects smoothly */
            transition: all .5s ease-in-out;
        }

        /* Responsive CSS for EduSpace About Page */

        /* Adjust the top section background image height on smaller screens */
        @media only screen and (max-width: 768px) {
            .about_top {
                padding: 80px;
            }
        }

        /* Adjust the grid layout of the Journey of EduSpace section on smaller screens */
        @media only screen and (max-width: 768px) {
            .about_eduspace {
                grid-template-columns: 100%;
            }
        }

        /* Adjust the margin and padding of the Journey of EduSpace section on smaller screens */
        @media only screen and (max-width: 768px) {
            .about-tittle {
                margin-top: 10%;
                margin-left: 5%;
            }

            .about-para {
                margin-left: 5%;
                margin-right: 5%;
            }
        }

        /* Adjust the font size of the Explore more button on smaller screens */
        @media only screen and (max-width: 768px) {
            .about-btn {
                font-size: 14px;
            }
        }

        /* Adjust the size of the course card on smaller screens */
        @media only screen and (max-width: 768px) {
            .course-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <section class="about_top img-fluid">
        <h1>About</h1>
    </section>
    <section class="about_eduspace">
        <div class="About_eduspace_details">
            <h1 class="about-tittle About-tittle-header">Journey of<span id="part-about-tittle"> EduSpace</span></h1>
            <P class="about-para">EduSpace is an online learning platform that offers a wide variety of courses taught
                by expert instructors. The courses cover a broad range of topics, from coding and web development to
                business and personal development. Users can enroll in courses individually or sign up for a
                subscription that provides access to all courses on the platform.</P>
            <a src=""><button class="about-btn">Explore more <i class="fa-solid fa-arrow-right"></i></button></a>
        </div>
        <div>
            <img src="../Assets/About.svg" alt="">
        </div>
    </section>
    <?php include "./../../ADMS/Shared/Footer.php" ?>

    <!-- for Navbar Responsive -->
    <script src="./../../View/Shared/navbarScript.js"></script>
</body>

</html>