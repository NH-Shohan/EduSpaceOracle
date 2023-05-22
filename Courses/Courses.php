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

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        .card_container {
            margin-inline: 15%;
            margin-block: 80px !important;
            justify-content: center;
            display: flex;
        }

        .card-text {
            font-size: 15px;
        }

        .card_id,
        .course_id {
            background-color: #444444;
            width: fit-content;
            padding: 1px 7px;
            border-radius: 7px;
            font-size: 13px;
            color: white;
            display: inline;
        }

        .instructor_id {
            background-color: #444444;
            width: fit-content;
            padding: 1px 7px;
            border-radius: 7px;
            font-size: 13px;
            color: white;
        }

        .card_price {
            font-weight: 600;
            color: #6f7dff;
            font-size: 24px;
            display: inline-block;
        }

        .card_duration {
            display: inline;
            font-weight: 500;
            float: right;
        }

        .card_date {
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>

    <div class="mt-5 card_container row gap-2">
        <div class="container-fluid mb-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <?php
        function showAllCourses($conn)
        {
            $sql = "SELECT * FROM Course";

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
                            <p class="card_id">ID <?php echo $row['CATEGORY_ID']; ?></p>
                            <p class="course_id">Course ID <?php echo $row['COURSE_ID']; ?></p>
                            <p class="instructor_id">Instructor ID <?php echo $row['INSTRUCTOR_ID']; ?></p>
                            <p class="card_price"><?php echo $row['COURSE_PRICE']; ?>$</p>
                            <p class="card_duration"><?php echo $row['COURSE_DURATION']; ?> min</p>
                            <p class="card_date">Available on <?php echo $row['CREATED_DATE']; ?></p>
                            <form method="POST">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success w-100" name="deleteCourse" value="<?php echo $row['COURSE_ID']; ?>">See More</button>
                                </div>
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
    <?php include "./../../ADMS/Shared/Footer.php" ?>

    <!-- bootstarp js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>