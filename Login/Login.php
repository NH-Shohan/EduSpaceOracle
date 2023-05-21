<?php
    include('../model/database.php');
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
    <?php include "./../../ADMS/Shared/Navbar.php" ?>
    <div class="login-container">
        <div class="container">
            <div class="login-inside">
                <form method="POST">
                    <div>
                        <fieldset>
                            <legend>
                                <h3>Login</h3>
                            </legend>
                        </fieldset>
                    </div>
                    <p>
                        <label for="email">Email:</label><br />
                        <input type="text" id="email" name="email"><br />
                    </p> <br />
                    <p>
                        <label for="password">Password:</label><br />
                        <input type="password" id="password" name="password">
                    </p> <br />
                    <p>
                    <div class="submit-btn">
                        <input class="auth-submit-button" type="submit" name="login" value="Submit">
                    </div>
                    <br />

                    <span class="error">
                            
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