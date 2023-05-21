<?php
    include('../model/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace | Dashboard</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/4bd420869f.css" crossorigin="anonymous">

    <!-- Style Link -->
    <link rel="stylesheet" href="./../../ADMS/styles.css">
</head>

<body>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <form method="POST" class="bg-success">
        <input type="text" name="COURSE_NAME">
        <input type="text" name="COURSE_DESCRIPTION">
        <input type="number" name="COURSE_PRICE">
        <input type="number" name="COURSE_DURATION">
        <input type="number" name="INSTRUCTOR_ID">
        <input type="number" name="CATEGORY_ID">
        <button type="submit" name="addCourse">ADD</button>
    </form>
    <?php include "./../../ADMS/Shared/Footer.php" ?>
</body>

</html>