<?php
// session_start();

// require_once './../../Controller/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace</title>
    <link rel="stylesheet" href="./../../ADMS/styles.css">

    <style>
        .select_role {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 15px;
        }

        .single_role {
            display: flex;
        }

        .single_role label {
            padding-inline: 7px;
        }
    </style>
</head>

<body>

    <?php

    $name = $email = $username = $password = "";

    $nameError = $emailError = $usernameError = $passwordError = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['name'])) {
            $nameError = "Name is required.";
        } else {
            $name = test_input($_POST['name']);
            $_SESSION['name'] = $name;
        }
        if (empty($_POST['email'])) {
            $emailError = "Email is required.";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format.";
        } else {
            $email = test_input($_POST['email']);
            $_SESSION['email'] = $email;
        }
        if (empty($_POST['username'])) {
            $usernameError = "Username is required.";
        } else {
            $username = test_input($_POST['username']);
            $_SESSION['username'] = $username;
        }
        if (empty($_POST['password'])) {
            $passwordError = "Password is required.";
        } else {
            $password = test_input($_POST['password']);
            $_SESSION['password'] = $password;
        }
        if (!empty($name) && !empty($email) && !empty($username) && !empty($password)) {
            $_SESSION["authEvent"] = "registration";
            header("Location: ./../../Controller/UserController.php");
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <div class="login-container">
        <div class="container">
            <div class="login-inside">
                <div class="container">
                    <div class="row">
                        <div class="column left"></div>
                        <div class="column right">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div>
                                    <fieldset>
                                        <legend>
                                            <h3>Registration</h3>
                                        </legend>
                                    </fieldset>
                                </div>
                                <label for="name">Name:</label><br />
                                <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                                <span class="error">
                                    <?php
                                    if (isset($nameError)) {
                                        echo $nameError;
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </span>
                                <br>
                                <br>

                                <label for="email">Email:</label><br />
                                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                                <span class="error">
                                    <?php
                                    if (isset($emailError)) {
                                        echo $emailError;
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </span>
                                <br>
                                <br>
                                <label for="username">Username:</label><br />
                                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                                <span class=" error">
                                    <?php
                                    if (isset($usernameError)) {
                                        echo $usernameError;
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </span>
                                <br>
                                <br>
                                <label for="password">Password:</label><br />
                                <input type="password" id="password" name="password">
                                <span class="error">
                                    <?php
                                    if (isset($passwordError)) {
                                        echo $passwordError;
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </span>
                                <br> <br>

                                <span class="error">
                                    <?php if (isset($_GET['error'])) {
                                    ?>
                                        <p class="error">
                                            <?php echo $_GET['error']; ?>
                                        </p>
                                    <?php
                                    } else {
                                        echo "";
                                    ?>

                                    <?php
                                    }
                                    ?>
                                </span>
                                <br />

                                <div class="select_role">
                                    <div class="single_role">
                                        <input type="radio" id="student" name="role">
                                        <label for="student">Student</label><br>
                                    </div>
                                    <div class="single_role">
                                        <input type="radio" id="teacher" name="role">
                                        <label for="teacher">Teacher</label><br>
                                    </div>
                                </div>

                                <div class="submit-btn">
                                    <input class="auth-submit-button" type="submit" name="submit" value="Register">
                                </div>
                                <br /> <br />
                                <p>Already have an account? <a href="./../../ADMS/Login/Login.php">Login here</a>.</p>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include "./../../ADMS/Shared/Footer.php" ?>
    <!-- for Navbar Responsive -->
    <script src="./../../ADMS/Shared/navbarScript.js"></script>
</body>

</html>