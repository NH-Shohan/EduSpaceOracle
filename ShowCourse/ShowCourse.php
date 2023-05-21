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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <link rel="stylesheet" href="./../../View/styles.css">
    <style>
        :root {
            --lightDark: #212936;
            --dark: #141722;
            --fontPrimary: #fff;
            --green: #35bb78;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* color: var(--fontPrimary); */
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-color: var(--primary);
        }

        /* nav start */
        .nav {
            background-color: var(--dark);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
        }

        .nav img {
            width: 200px;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav .avatar img {
            width: 30px;
            height: 30px;
        }

        .avatar p {
            margin-left: 10px;
            font-size: 14px;
            color: var(--white);
        }

        /* Main body with grid start */
        .main {
            display: grid;
            grid-template-columns: 2.3fr 1fr;
            grid-gap: 20px;
            padding: 30px;
        }

        .flex {
            display: flex;
        }

        .checkbox {
            width: 40px;
        }

        .milestoneDetails {
            /* border: 1px solid green; */
            color: var(--darkText) !important;
        }

        .milestoneDetails img {
            width: 100%;
            height: 400px;
            object-fit: contain;
            border-radius: 7px;
            -webkit-transition: opacity 0.8s linear;
            -moz-transition: opacity 0.8s linear;
            transition: opacity 0.8s linear;
            padding: 30px;
            box-shadow: 1px 1px 10px var(--text);
            margin-bottom: 30px;
        }

        .milestoneDetails iframe {
            max-width: 800px;
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
            /* resize: cover; */
            border-radius: 7px;
            -webkit-transition: opacity 0.8s linear;
            -moz-transition: opacity 0.8s linear;
            transition: opacity 0.8s linear;

            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 1px 1px 10px var(--text);
        }

        .title,
        .details {
            margin: 20px auto;
            /* padding: 5px 10px; */
        }

        .milestones,
        .doneList {
            background-color: var(--dark);
            border-radius: 7px;
            cursor: pointer;
            max-height: 495px;
            overflow: auto;
            color: var(--fontPrimary);
        }

        .doneList {
            margin-top: 20px;
        }

        .module {
            background-color: var(--dark);
        }

        .milestone,
        .module {
            font-size: 14px;
            color: var(--white);
            margin: 10px;
            padding: 10px;
        }

        .milestone a,
        .module a {
            color: var(--white);
            text-decoration: none;
        }

        .milestoneDetails {
            font-size: 14px;
            color: var(--darkText);
        }


        .border-b {
            border-bottom: 1px solid rgb(31, 41, 55);
        }

        .hidden_panel {
            max-height: 0;
            overflow: hidden;
            -webkit-transition: max-height 0.8s;
            -moz-transition: max-height 0.8s;
            transition: max-height 0.8s;
        }

        .active {
            font-weight: bold;
        }

        .show {
            max-height: 400px;
        }

        .loaded {
            opacity: 1;
        }

        input[type="checkbox"] {
            margin-right: 5px;
            vertical-align: middle;
        }

        .milestoneImage {
            display: none;
        }


        /* .milestoneImageTemp {
            height: 300px !important;
            width: 100%;
            resize: contain;
        } */

        #nextBtn,
        #previousBtn {
            display: none;
        }

        .lecture-name {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        @media only screen and (max-width: 1024px) {

            .main,
            .todo {
                grid-template-columns: repeat(1, 1fr);
                padding: 15px;
                grid-gap: 10px;
            }

            .nav img {
                width: 150px;
            }

            .nav .avatar img {
                width: 20px;
                height: 20px;
            }

            .milestones,
            .doneList {
                height: fit-content;
            }
        }
    </style>
</head>

<body>
    <!-- navbar  start -->
    <?php include "./../../View/Shared/Navbar.php" ?>
    <!-- navbar end start -->

    <!-- main start -->
    <div class="container">
        <section class="main">

            <!-- course details start -->
            <div class="milestoneDetails">
                <img class="milestoneImageTemp" src="<?php echo $banner; ?>" alt="" />
                <iframe class="milestoneImage" src="" frameborder="0" allow="autoplay; encrypted-media"
                    allowfullscreen></iframe>
                <br>
                <button id="previousBtn" class="btn btn-with-background">Previous</button>
                <button id="nextBtn" class="btn btn-with-background">Next</button>
                <?php
                if (!$noContent) {
                    ?>
                    <h1 class="title">
                        <?php echo $courseName; ?>
                    </h1>
                    <p class="details">
                        <?php echo $description; ?>
                    </p>
                <?php } else {
                    ?>
                    <h1 class="title">
                        <?php echo $courseName; ?>
                    </h1>
                    <p class="details">No Content Available right now!</p>
                <?php } ?>

            </div>
            <!-- course details end -->

            <!-- all milestones & modules start -->
            <div>
                <div class="milestones">
                    <?php
                    $module_index = 0;
                    $lectureDescription = "";
                    foreach ($modules as $module) {
                        ?>
                        <div class="milestone border-b">
                            <div class="flex">
                                <div class="checkbox"><input type="checkbox"
                                        onclick="markMileStone(this, <?php echo $module_index; ?>)" /></div>
                                <div class="lecture-name">
                                    <p>
                                        <?php echo $module['name']; ?>
                                    </p>
                                    <p>
                                        <span><i class="fas fa-chevron-down"></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="hidden_panel">
                                <?php foreach ($module['lectures'] as $lecture) { ?>
                                    <div class="module border-b">
                                        <p>
                                            <a description="<?php echo $lecture['lectureDescription']; ?>"
                                                href="<?php echo $lecture['url']; ?>">
                                                <?php echo $lecture['name']; ?>
                                            </a>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        $module_index++;
                    }
                    ?>

                </div>
                <br>
                <br>
                <br>
                <b>Completed Modules</b>
                <div class="doneList">
                    <!-- done list will load here -->
                </div>
            </div>
            <!-- all milestones and modules end -->
        </section>
    </div>
    <!-- <script src="js/data.js"></script>
    <script src="js/main.js"></script> -->
    <script>
        const milestoneDivs = document.querySelectorAll(".milestone");
        const title = document.querySelector(".title");
        const details = document.querySelector(".details");

        milestoneDivs.forEach((milestoneDiv) => {
            const milestoneTitleDiv = milestoneDiv.querySelector(".lecture-name");
            const hiddenPanelDiv = milestoneDiv.querySelector(".hidden_panel");

            milestoneTitleDiv.addEventListener("click", () => {
                hiddenPanelDiv.classList.toggle("hidden_panel");
                milestoneTitleDiv.querySelector("span").classList.toggle("rotate");
            });
        });

        const videoImage = document.querySelector(".milestoneImage");

        const lectureLinks = document.querySelectorAll(".module a");
        // console.log(lectureLinks);

        lectureLinks.forEach((link) => {
            link.addEventListener("click", (event) => {
                const previousBtn = document.querySelector('#previousBtn').style.display = "inline";
                const nextBtn = document.querySelector('#nextBtn').style.display = "inline";
                document.querySelector(".milestoneImageTemp").style.display = "none";
                document.querySelector(".milestoneImage").style.display = "block";
                event.preventDefault();

                const videoUrl = link.getAttribute("href");
                // const videoUrl = link.getAttribute("description");
                videoImage.setAttribute("src", videoUrl);
                title.innerText = link.innerText;
                details.innerText = link.getAttribute("description");
            });
        });

    </script>
    <script>
        function markMileStone(checkbox, moduleIndex) {
            const moduleSection = document.querySelectorAll('.milestone')[moduleIndex];
            const hiddenPanel = moduleSection.querySelector('.hidden_panel');
            const milestoneImage = document.querySelector('.milestoneImage');
            if (checkbox.checked) {
                // Move the module with its lecture videos to the "done list" section
                const doneList = document.querySelector('.doneList');
                doneList.appendChild(moduleSection);
                hiddenPanel.classList.remove('hidden_panel');
                milestoneImage.style.display = 'none';
            } else {
                // Move the module back to the original section
                const milestones = document.querySelector('.milestones');
                milestones.appendChild(moduleSection);
                hiddenPanel.classList.add('hidden_panel');
                milestoneImage.style.display = 'block';
            }
        }

    </script>
    <script>
        let currentVideoIndex = 0;
        const videos = document.querySelectorAll('.module a');
        const videoPlayer = document.querySelector('.milestoneImage');
        const previousBtn = document.querySelector('#previousBtn');
        const nextBtn = document.querySelector('#nextBtn');

        // function to update the video player
        function updateVideoPlayer(videoUrl) {
            videoPlayer.src = videoUrl;
        }

        // function to handle next button click
        function handleNextButtonClick() {
            if (currentVideoIndex < videos.length - 1) {
                currentVideoIndex++;
                updateVideoPlayer(videos[currentVideoIndex].href);
            }
            if (currentVideoIndex === videos.length - 1) {
                nextBtn.disabled = true;
            }
            previousBtn.disabled = false;
        }

        // function to handle previous button click
        function handlePreviousButtonClick() {
            if (currentVideoIndex > 0) {
                currentVideoIndex--;
                updateVideoPlayer(videos[currentVideoIndex].href);
            }
            if (currentVideoIndex === 0) {
                previousBtn.disabled = true;
            }
            nextBtn.disabled = false;
        }

        // add event listeners to the next and previous buttons
        nextBtn.addEventListener('click', handleNextButtonClick);
        previousBtn.addEventListener('click', handlePreviousButtonClick);

        // add event listeners to the module video links to update the current video index and video player
        videos.forEach((video, index) => {
            video.addEventListener('click', (event) => {
                event.preventDefault();
                currentVideoIndex = index;
                updateVideoPlayer(video.href);
                previousBtn.disabled = currentVideoIndex === 0;
                nextBtn.disabled = currentVideoIndex === videos.length - 1;
            });
        });
    </script>
</body>

</html>