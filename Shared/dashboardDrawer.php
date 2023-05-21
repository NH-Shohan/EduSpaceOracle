<?php $page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1); ?>
<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icon Link -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/4bd420869f.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .dashboard_quick_links {
            color: var(--primary);
            height: 100%;
            padding: 20px;
            box-shadow: 0px 0px 5px var(--secondaryText2);
        }

        .dashboard_quick_links .drawer_nav_link {
            display: block;
            text-decoration: none;
            margin-block: 10px;
            background-color: var(--tertiary);
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            color: var(--primary);
            transition: 200ms;
        }

        .dashboard_quick_links .drawer_nav_link:hover::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 30px;
            height: 2px;
            border-radius: 10px;
            background-color: var(--text);
            transition: opacity 200ms;
        }

        .error {
            color: red;
            font-size: 14px;
            font-weight: bold;
            margin: 5px 0;
        }

        .success {
            color: green;
            font-size: 14px;
            font-weight: bold;
        }

        .drawer_active {
            display: block;
            text-decoration: none;
            margin-block: 10px;
            background-color: var(--text);
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            color: var(--primary);
            transition: 200ms;
        }
    </style>
    <title>Dashboard</title>
</head>

<body>
    <?php $page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
    ?>
    <!-- Responsive -->
    <div class="dashboard_container">
        <div class="dashboard_navlinks">
            <!-- Add an icon to toggle the menu -->
            <div class="icon" onclick="toggleMenu()">
                <i class="fa fa-bars"></i>
                <!-- <i class="fa fa-times"></i> -->
            </div>
            <!-- Wrap the links in a div with an id -->
            <div id="menu" class="dashboard_quick_links">
                <a class="<?= $page === 'Dashboard.php' ? 'drawer_active' : 'drawer_nav_link'; ?>" href="./../../ADMS/Dashboard/Dashboard.php">Dashboard</a>

                <a class="<?= $page === 'AddCourses.php' ? 'drawer_active' : 'drawer_nav_link'; ?>" href="./../../ADMS/AddCourses/AddCourses.php">Add Course</a>

                <a class="<?= $page === 'DeleteCourse.php' ? 'drawer_active' : 'drawer_nav_link'; ?>" href="./../../ADMS/DeleteCourse/DeleteCourse.php">Delete Course</a>
            </div>
        </div>
    </div>
</body>

</html>