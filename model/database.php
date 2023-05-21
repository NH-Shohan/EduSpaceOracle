<?php
    
    $conn = oci_connect("system","1234","localhost/XE");
    if(!$conn){

        $error = oci_error();
        trigger_error(htmlentities($error['message'], ENT_QUOTES),E_USER_ERROR);
    }

    
        
    if(isset($_POST['login'])){
        
        function adminLogin($username, $password, $conn) {
            $sql = "SELECT COUNT(*) AS count
                    FROM Admin
                    WHERE admin_email = :username AND admin_password = :password";
            
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':username', $username);
            oci_bind_by_name($stmt, ':password', $password);
            
            try {
                oci_execute($stmt);
                
                $row = oci_fetch_assoc($stmt);
                $count = $row['COUNT'];
                
                if ($count == 1) {
                    header("Location: ../index.php");
                } else {
                    // Invalid username or password
                    echo "Invalid username or password.";
                }
                
                oci_free_statement($stmt);
            } catch (Exception $e) {
                echo "Failed to login: " . $e->getMessage();
            }
        }
        
            $username = $_POST['email'];
            $password = $_POST['password'];
    
            adminLogin($username, $password, $conn);
        
        
    }


    if(isset($_POST['addCourse'])){
        function insertCourse($COURSE_NAME, $COURSE_DESCRIPTION, $COURSE_PRICE, $COURSE_DURATION, $INSTRUCTOR_ID, $CATEGORY_ID, $conn) {
            $sql = "INSERT INTO Course (course_id, course_name, course_description,  course_price, course_duration, instructor_id, category_id, created_date)
                    VALUES (course_id_seq.NEXTVAL, :courseName, :course_description, :course_price, :course_duration, :instructor_id, :category_id, SYSDATE)";
            
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':courseName', $COURSE_NAME);
            oci_bind_by_name($stmt, ':course_description', $COURSE_DESCRIPTION);
            oci_bind_by_name($stmt, ':course_price', $COURSE_PRICE);
            oci_bind_by_name($stmt, ':course_duration', $COURSE_DURATION);
            oci_bind_by_name($stmt, ':instructor_id', $INSTRUCTOR_ID);
            oci_bind_by_name($stmt, ':category_id', $CATEGORY_ID);
            
            try {
                oci_execute($stmt);
                
                // Check if the course was inserted successfully
                $rowsAffected = oci_num_rows($stmt);
                
                if ($rowsAffected > 0) {
                    echo "Course inserted successfully.";
                } else {
                    echo "Failed to insert course.";
                }
                
                oci_free_statement($stmt);
            } catch (Exception $e) {
                echo "Failed to insert course: " . $e->getMessage();
            }
        }

        $COURSE_NAME = $_POST['COURSE_NAME'];
        $COURSE_DESCRIPTION = $_POST['COURSE_DESCRIPTION'];
        $COURSE_PRICE = $_POST['COURSE_PRICE'];
        $COURSE_DURATION = $_POST['COURSE_DURATION'];
        $INSTRUCTOR_ID = $_POST['INSTRUCTOR_ID'];
        $CATEGORY_ID = $_POST['CATEGORY_ID'];
        
        // Usage example:
        insertCourse($COURSE_NAME, $COURSE_DESCRIPTION, $COURSE_PRICE, $COURSE_DURATION, $INSTRUCTOR_ID, $CATEGORY_ID, $conn);
    }

    if(isset($_POST['deleteCourse'])){
        function deleteCourse($COURSE_ID, $conn) {
            $sql = "DELETE FROM Course
                    WHERE course_id = :courseId";
            
            $stmt = oci_parse($conn, $sql);
            oci_bind_by_name($stmt, ':courseId', $COURSE_ID);
            
            try {
                oci_execute($stmt);
                
                // Check if the course was deleted successfully
                $rowsAffected = oci_num_rows($stmt);
                
                if ($rowsAffected > 0) {
                    echo "Course deleted successfully.";
                } else {
                    echo "Failed to delete course.";
                }
                
                oci_free_statement($stmt);
            } catch (Exception $e) {
                echo "Failed to delete course: " . $e->getMessage();
            }
        }

        $COURSE_ID = $_POST['deleteCourse'];

        deleteCourse($COURSE_ID, $conn);
    }
    


?>