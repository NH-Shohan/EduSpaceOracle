<?php
    include('../model/database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace | Courses</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/4bd420869f.css" crossorigin="anonymous">

    <!-- Style Link -->
    <link rel="stylesheet" href="./../../ADMS/styles.css">
</head>

<body>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <?php
    function showAllCourses($conn) {
        $sql = "SELECT *
                FROM Course";
        
        $stmt = oci_parse($conn, $sql);
        
        try {
            oci_execute($stmt);
            
            while ($row = oci_fetch_assoc($stmt)) {
                // Process each row and display course information
                echo "Course ID: " . $row['COURSE_ID'] . "<br>";
                echo "Course Name: " . $row['COURSE_NAME'] . "<br>";
                echo "Description: " . $row['COURSE_DESCRIPTION'] . "<br>";
                echo "Price: " . $row['COURSE_PRICE'] . "<br>";
                echo "Duration: " . $row['COURSE_DURATION'] . "<br>";
                echo "Price: " . $row['COURSE_PRICE'] . "<br>";
                echo "Instructor ID: " . $row['INSTRUCTOR_ID'] . "<br>";
                echo "Category: " . $row['CATEGORY_ID'] . "<br>";
                echo "Available from: " . $row['CREATED_DATE'] . "<br>";
                echo "<form method='POST'>  <button type='submit' value=". $row['COURSE_ID'] ." name='deleteCourse'> Delete </button>  </form>";
                // Display additional course fields if needed
                echo "<br>";
            }
            
            oci_free_statement($stmt);
        } catch (Exception $e) {
            echo "Failed to retrieve courses: " . $e->getMessage();
        }
    }
    
    // Usage example:
    showAllCourses($conn);
    ?>
    <?php include "./../../ADMS/Shared/Footer.php" ?>
</body>

</html>