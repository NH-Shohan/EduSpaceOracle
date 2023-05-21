<?php
session_start();

require_once './../../Controller/db_connect.php';

$course_id = $_GET['course_id'];
$sql = "SELECT * FROM login_system.course_content WHERE course_id = $course_id ORDER BY moduleNumber, lectureNumber";
$result = mysqli_query($conn, $sql);
$modules = array();
$banner = "";
$courseName = "";
$description = "";
$courseFee = 0;
$noContent = false;

// Select data from the courses table where course_id is 1
$sql2 = "SELECT * FROM courses WHERE course_id = $course_id";
$result2 = $conn->query($sql2);

// Display the selected data
if ($result2->num_rows > 0) {
    // Output data of each row
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $banner = $row2["course_image"];
        $courseName = $row2["course_name"];
        $courseFee = $row2["course_fee"];
        $description = $row2["description"];
        // And so on for the other columns in the table
    }
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $module_id = $row['moduleNumber'];
        // $banner = $row['course_image'];
        if (!isset($modules[$module_id])) {
            $modules[$module_id] = array(
                'name' => $row['moduleName'],
                'lectures' => array(),
            );
        }

        $modules[$module_id]['lectures'][] = array(
            'name' => $row['lectureName'],
            'lectureDescription' => $row['lectureDescription'],
            'url' => $row['lectureVideoLinks'],
        );
    }
} else {
    $noContent = true;
}
?>

<?php
$discounted_price = $courseFee;
$coupon_err = "";
$coupon_suc = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupon_code = $_POST["coupon_code"];


    $coupons = file("coupons.txt", FILE_IGNORE_NEW_LINES);

    if (in_array($coupon_code, $coupons)) {
        // Coupon code matched, apply 20% discount
        $discounted_price = $courseFee * 0.8;
        $coupon_suc = "Coupon applied successfully. You got 20% offer discount!";
    } else {
        // Coupon code did not match
        $coupon_err = "Sorry, your coupon code was incorrect.";

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace</title>
    <link rel="stylesheet" href="./../../View/styles.css">
    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/9a6693ad48.js" crossorigin="anonymous"></script>

    <style>
        .background_color {
            top: 0;
            width: calc(100vw - 18px);
            z-index: -1;
            padding-bottom: 20vh;
            /* position: absolute; */
        }

        .heading-title {

            height: 50vh;
            background-color: var(--darkText);
            position: absolute;
            padding-top: 100px;
            top: 0;
            width: 100%;
            left: 0;
        }

        .show_course_details_container {
            padding-inline: 14%;
            margin-top: 100px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .show_course_details {
            color: white;
        }

        .show_course_cart {
            position: relative;
        }

        .course_cart {
            background-color: white;
            box-shadow: 0 0 4px #777;
            border-radius: 5px;
            padding: 1em;
            position: sticky;
            margin-top: -80px;
            top: 120px;
        }

        .course_price {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .course_price b {
            font-size: clamp(26px, 28px, 30px);
        }

        .course_cart .add_to_cart_btn,
        .buy_course_btn {
            width: 100%;
            padding: 10px 0;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            background-color: var(--tertiary);
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            color: var(--primary);
            transition: background-color 200ms;
        }

        .buy_course_btn {
            border: 1px solid var(--text);
            color: var(--text);
            background-color: transparent;
        }

        .add_to_cart_btn:hover {
            background-color: var(--text);
        }

        .info_message {
            text-align: center;
            width: 100%;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .course_details_list {
            margin-bottom: 20px;
        }

        .course_details_list p {
            font-size: 12px;
        }

        .coupon_input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            outline: none;
        }

        .coupon_input_filed {
            border-bottom: 2px solid var(--secondaryText2);
        }

        .coupon_input_filed:focus {
            border-bottom: 2px solid var(--text);
        }

        .coupon_btn {
            border: 2px solid var(--text);
            cursor: pointer;
            transition: all 200ms;
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
        }

        .coupon_btn:hover {
            background-color: var(--text);
            color: var(--primary);
        }

        /* Details section */
        .show_course_details p {
            font-size: 14px;
        }

        .show_course_tag {
            background-color: #ffdd00;
            color: var(--darkText);
            font-size: 11px;
            padding: 0px 6px;
            width: fit-content;
            border-radius: 5px;
            margin-block: 10px;
        }

        .course_ratings {
            display: flex;
            gap: 10px;
        }

        .course_ratings i {
            color: #ffdd00;
        }

        .course_learning {
            margin-top: 20vh;
            color: var(--darkText);
            border: 1px solid var(--darkText);
            border-radius: 7px;
        }

        .course_learning {
            padding: 15px;
        }

        .course_learning i {
            color: #ffdd00;
            margin-right: 7px;
        }

        .course_requirment {
            color: var(--darkText);
            margin-top: 20px;
        }

        .course_description {
            color: var(--darkText);
            margin-block: 20px;
            text-align: justify;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <?php include "./../../View/Shared/Navbar.php" ?>
    <div class="show_course_container">
        <div class="background_color"></div>
        <div class="show_course_details_container">
            <div class="show_course_details">
                <div class="heading-title">
                    <div class="container">
                        <h1>
                            <?php echo $courseName; ?>
                        </h1>
                        <p>
                            <?php echo $description; ?>
                        </p>
                        <div class="">
                            <p class="show_course_tag">Bestseller</p>
                            <div class="course_ratings">
                                <p>4.7
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </p>
                                <p>(269,657 ratings)</p>
                                <small>914,966 students</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="course_learning">
                    <b>What you'll learn</b>
                    <p><i class="fa-solid fa-check"></i>Create their own Website</p>
                    <p><i class="fa-solid fa-check"></i>Become an experienced Programmer</p>
                    <p><i class="fa-solid fa-check"></i>Parse the Web and Create their own Games</p>
                </div>

                <div class="course_requirment">
                    <b>Requirements</b>
                    <p><i class="fa-solid fa-check"></i>
                        Macintosh (OSX)/ Windows(Vista and higher) Machine
                    </p>
                    <p><i class="fa-solid fa-check"></i>
                        Internet Connection
                    </p>
                </div>

                <div class="course_description">
                    <b>Description</b>
                    <br>
                    Do you want to become a programmer? Do you want to learn how to create games, automate your browser,
                    visualize data, and much more?
                    <br>
                    If you’re looking to learn Python for the very first time or need a quick brush-up, this is the
                    course for you!
                    <br>

                    Python has rapidly become one of the most popular programming languages around the world. Compared
                    to other languages such as Java or C++, Python consistently outranks and outperforms these languages
                    in demand from businesses and job availability. The average Python developer makes over $100,000 -
                    this number is only going to grow in the coming years.
                    <br>

                    The best part? Python is one of the easiest coding languages to learn right now. It doesn’t matter
                    if you have no programming experience or are unfamiliar with the syntax of Python. By the time you
                    finish this course, you'll be an absolute pro at programming!
                    <br>

                    This course will cover all the basics and several advanced concepts of Python. We’ll go over:
                    <br>
                    <li>The fundamentals of Python programming</li>
                    <li>Writing and Reading to Files</li>
                    <li>Automation of Word and Excel Files</li>
                    <li>Web scraping with BeautifulSoup4</li>
                    <li>Browser automation with Selenium</li>
                    <li>Data Analysis and Visualization with MatPlotLib</li>
                    <li>Regex parsing and Task Management</li>
                    <li>GUI and Gaming with Tkinter</li>
                    <li>And much more!</li>
                    If you read the above list and are feeling a bit confused, don’t worry! As an instructor and student
                    on Udemy for almost 4 years, I know what it’s like to be overwhelmed with boring and mundane. I
                    promise you’ll have a blast learning the ins and outs of python. I’ve successfully taught over
                    200,000+ students from over 200 countries jumpstart their programming journeys through my courses.
                    <br>

                    Here’s what some of my students have to say:
                    <br>

                    “I wish I started programming at a younger age like Avi. This Python course was excellent for those
                    that cringe at the thought of starting over from scratch with attempts to write programs once again.
                    Python is a great building language for any beginner programmer. Thank you Avi!”
                    <br>
                    “I had no idea about any programming language. With Avi's lectures, I'm now aware of several python
                    concepts and I'm beginning to write my own programs. Avi is crisp and clear in his lectures and it
                    is easy to catch the concepts and the depth of it through his explanations. Thanks, Avi for the
                    wonderful course, You're awesome! It's helping me a lot :)”
                    <br>
                    "Videos are short and concise and well-defined in their title, this makes them easy to refer back to
                    when a refresher is needed. Explanations aren't convoluted with complicated examples, which adds to
                    the quick pace of the videos. I am very pleased with the decision to enroll in this course. Not only
                    has it increased the pace I'm learning Python but I actively look forward to continuing the course,
                    whenever I get the chance. Avi is friendly and energetic, absolutely delightful as an instructor.”
                    <br>

                    So what are you waiting for? Jumpstart your programming journey and dive into the world of Python by
                    enrolling in this course today!
                </div>
            </div>

            <div class="show_course_cart">
                <div class="course_cart">
                    <div class="course_price">
                        <b>৳
                            <?php echo $discounted_price; ?>
                        </b>
                        <p>Add Coupon to get upto 30% offer</p>
                    </div>

                    <button class="add_to_cart_btn" type="button">Add to cart</button>
                    <a href="showCourse.php?course_id=<?php echo $course_id ?>"> <button class="buy_course_btn"
                            type="button">Buy now</button> </a>

                    <p class="info_message">30-Day Money-Back Guarantee</p>

                    <div class="course_details_list">
                        <b>This course includes:</b>

                        <p>65 hours on-demand video</p>
                        <p>86 articles</p>
                        <p>49 downloadable resources</p>
                        <p>8 coding exercises</p>
                        <p>Full lifetime access</p>
                        <p>Access on mobile and TV</p>
                        <p>Certificate of completion</p>
                    </div>

                    <form method="post">
                        <input class="coupon_input coupon_input_filed" type="text" name="coupon_code"
                            placeholder="Your Coupon">
                        <?php
                        if ($coupon_err) {
                            ?>
                            <p class="error">
                                <?php echo $coupon_err; ?>
                            </p><br />
                            <?php
                        } else {
                            ?>
                            <p class="success">
                                <?php echo $coupon_suc; ?>
                            </p><br />
                            <?php
                        }
                        ?>
                        <input class="coupon_input coupon_btn" type="submit" value="Add Coupon">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- for Navbar Responsive -->
    <script src="./../../View/Shared/navbarScript.js"></script>
</body>

</html>