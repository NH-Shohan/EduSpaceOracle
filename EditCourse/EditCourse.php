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

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        .dashboard_container {
            margin-top: 30px;
            height: calc(100vh - 60px);
            display: grid;
            grid-template-columns: 300px auto;
        }

        .dashboard_content_section {
            overflow: auto;
            margin-inline: 20px;
            padding: 20px;
        }

        .dash_container {
            margin-inline: 15%;
            margin-block: 80px;
        }

        textarea {
            width: 100%;
            border: none;
            padding: 5px;
            border-radius: 5px;
            border-bottom: 2px solid var(--tertiary);
            background-color: var(--primary);
            outline: none;
        }

        input {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <div class="dashboard_container">
        <div class="drawer_section">
            <?php include "./../../ADMS/Shared/dashboardDrawer.php" ?>
        </div>

        <div class="dashboard_content_section">
            <div class="dash_container">
                <form method="POST" class="row">
                <?php 
                    if(isset($_POST['editCourse'])){
                        function UPDATECOURSE() {
                            $id = $_POST['editCourse'];
                            $connection = connection();
                            $sql = "SELECT * FROM course where course_id = $id";
                            
                            $stmt = oci_parse($connection, $sql);
                            
                            try {
                                oci_execute($stmt);
                                while ($row = oci_fetch_assoc($stmt)) {
                                
                                    
                                            echo  '<div class="col-6">
                                            <label for="course_name">Course Name</label>
                                            <input type="text" name="COURSE_NAME" value='.$row['COURSE_NAME'].'>

                                            <label for="COURSE_DURATION">Course Duration</label>
                                            <input type="number" name="COURSE_DURATION" value='.$row['COURSE_DURATION'].'>

                                            <label for="COURSE_PRICE">Course Price</label>
                                            <input type="number" name="COURSE_PRICE" value='.$row['COURSE_PRICE'].'>
                                        </div>

                                        <div class="col-6">
                                            <label for="COURSE_DESCRIPTION">Course Descripion</label>
                                            <input type="text" name="COURSE_DESCRIPTION" value='.$row['COURSE_DESCRIPTION'].'></input>

                                            <label for="INSTRUCTOR_ID">Instructor ID</label>
                                            <input type="number" name="INSTRUCTOR_ID" value='.$row['INSTRUCTOR_ID'].'>

                                            <label for="CATEGORY_ID">Category ID</label>
                                            <input type="number" name="CATEGORY_ID" value='.$row['CATEGORY_ID'].'>
                                        </div>

                                        <div class="w-25 m-auto">
                                            <button class="btn btn-success w-100 " type="submit" name="updateCourse">UPDATE</button>
                                        </div>';


                                }
                            } catch (Exception $e) {
                                echo "Failed to retrieve courses: " . $e->getMessage();
                            }
                        }

                        UPDATECOURSE();
                    }
                ?>
                    
                </form>
            </div>

            <div class="mt-5 card_container row gap-2">
                <?php
                function showAllCourses($conn)
                {
                    $sql = "SELECT *
                FROM Course";

                    $stmt = oci_parse($conn, $sql);

                    try {
                        oci_execute($stmt);

                        while ($row = oci_fetch_assoc($stmt)) {
                            // Process each row and display course information
                ?>

                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['COURSE_NAME']; ?></h5>
                                    <p class="card-text"><?php echo $row['COURSE_DESCRIPTION']; ?></p>
                                    <p>Course ID: <?php echo $row['COURSE_ID']; ?></p>
                                    <p>Price: <?php echo $row['COURSE_PRICE']; ?></p>
                                    <p>Duration: <?php echo $row['COURSE_DURATION']; ?></p>
                                    <p>Instructor ID: <?php echo $row['INSTRUCTOR_ID']; ?></p>
                                    <p>Category: <?php echo $row['CATEGORY_ID']; ?></p>
                                    <p>Available from: <?php echo $row['CREATED_DATE']; ?></p>
                                    <form method="POST">
                                        <button type="submit" class="btn btn-success w-100" name="editCourse" value="<?php echo $row['COURSE_ID']; ?>">Edit</button>
                                    </form>
                                </div>
                            </div>
                            <br>

                <?php
                        }


                        oci_free_statement($stmt);
                    } catch (Exception $e) {
                        echo "Failed to retrieve courses: " . $e->getMessage();
                    }
                }

                // Usage example:
                showAllCourses($conn);
                ?>
            </div>
        </div>
    </div>

    <!-- for Navbar Responsive -->
    <script src="./navbarScript.js"></script>

    <!-- bootstarp js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>