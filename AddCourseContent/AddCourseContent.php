<?php
session_start();

require_once './../../Controller/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Add Course Content</title>
    </head>

    <body>
        <h1>Add Course Content</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="course_id">Course ID:</label>
            <input type="text" name="course_id" required><br>

            <label for="total_modules">Total Modules:</label>
            <input type="number" name="total_modules" required><br>

            <label for="module_number">Module Number:</label>
            <input type="number" name="module_number" required><br>

            <label for="module_name">Module Name:</label>
            <input type="text" name="module_name" required><br>

            <label for="lecture_video_links">Lecture Video Links (comma separated):</label>
            <input type="text" name="lecture_video_links" required><br>

            <label for="total_lectures">Total Lectures:</label>
            <input type="number" name="total_lectures" required><br>

            <label for="lecture_name">Lecture Name:</label>
            <input type="text" name="lecture_name" required><br>

            <label for="lecture_description">Lecture Description:</label>
            <textarea name="lecture_description" required></textarea><br>

            <label for="lecture_number">Lecture Number:</label>
            <input type="number" name="lecture_number" required><br>

            <input type="submit" value="Add Course Content">
        </form>

        <?php
        // check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validate input
            $errors = [];

            if (!isset($_POST['course_id']) || empty($_POST['course_id'])) {
                $errors[] = 'Course ID is required.';
            }

            if (!isset($_POST['total_modules']) || empty($_POST['total_modules'])) {
                $errors[] = 'Total Modules is required.';
            }

            if (!isset($_POST['module_number']) || empty($_POST['module_number'])) {
                $errors[] = 'Module Number is required.';
            }

            if (!isset($_POST['module_name']) || empty($_POST['module_name'])) {
                $errors[] = 'Module Name is required.';
            }

            if (!isset($_POST['lecture_video_links']) || empty($_POST['lecture_video_links'])) {
                $errors[] = 'Lecture Video Links are required.';
            }

            if (!isset($_POST['total_lectures']) || empty($_POST['total_lectures'])) {
                $errors[] = 'Total Lectures is required.';
            }

            if (!isset($_POST['lecture_name']) || empty($_POST['lecture_name'])) {
                $errors[] = 'Lecture Name is required.';
            }

            if (!isset($_POST['lecture_description']) || empty($_POST['lecture_description'])) {
                $errors[] = 'Lecture Description is required.';
            }

            if (!isset($_POST['lecture_number']) || empty($_POST['lecture_number'])) {
                $errors[] = 'Lecture Number is required.';
            }

            // display errors if any
            if (!empty($errors)) {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
            } else {
                // insert data into

                // prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO course_content (course_id, totalModule, moduleNumber, moduleName, lectureVideoLinks, totalLecture, lectureName, lectureDescription, lectureNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iiissssis", $course_id, $total_modules, $module_number, $module_name, $lecture_video_links, $total_lectures, $lecture_name, $lecture_description, $lecture_number);

                // set parameters and execute statement
                $course_id = $_POST['course_id'];
                $total_modules = $_POST['total_modules'];
                $module_number = $_POST['module_number'];
                $module_name = $_POST['module_name'];
                $lecture_video_links = $_POST['lecture_video_links'];
                $total_lectures = $_POST['total_lectures'];
                $lecture_name = $_POST['lecture_name'];
                $lecture_description = $_POST['lecture_description'];
                $lecture_number = $_POST['lecture_number'];

                if ($stmt->execute()) {
                    echo "New course content added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // close database connection and statement
                // $stmt->close();
                // $conn->close();
            }
        }
        ?>

    </body>

    </html>