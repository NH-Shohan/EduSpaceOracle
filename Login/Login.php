<?php
// session_start();

// require_once './../../Controller/db_connect.php';

// $_SESSION["previousURL"] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSpace</title>
    <link rel="stylesheet" href="./../../ADMS/styles.css">
</head>

<body>
    <?php

    $name = $email = $username = $password = "";

    $nameError = $emailError = $usernameError = $passwordError = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['email'])) {
            $emailError = "Email is required.";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format.";
        } else {
            $email = test_input($_POST['email']);
            $_SESSION['email'] = $email;
        }
        if (empty($_POST['password'])) {
            $passwordError = "Password is required.";
        } else {
            $password = test_input($_POST['password']);
            $_SESSION['password'] = $password;
        }
        if (!empty($email) && !empty($password)) {
            $_SESSION["authEvent"] = "login";
            // $_SESSION["previousURL"] = "";
            // echo $_SESSION["previousURL"];
            // header("Location: ./../../Controller/UserController.php");
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
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div>
                        <fieldset>
                            <legend>
                                <h3>Login</h3>
                            </legend>
                        </fieldset>
                    </div>
                    <p>
                        <label for="email">Email:</label><br />
                        <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br />
                        <span class="error">
                            <?php
                            if (isset($emailError)) {
                                echo $emailError;
                            } else {
                                echo "";
                            }
                            ?>
                        </span>
                    </p> <br />
                    <p>
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
                    </p> <br />
                    <p>
                    <div class="submit-btn">
                        <input class="auth-submit-button" type="submit" name="submit" value="Submit">
                    </div>
                    <br />

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
                    <p>Not a user? <a href="./../../ADMS/Registration/Registration.php">Register here</a>.</p>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <?php include "./../../ADMS/Shared/Footer.php" ?>
    <!-- for Navbar Responsive -->
    <script src="./../../ADMS/Shared/navbarScript.js"></script>
</body>

</html>