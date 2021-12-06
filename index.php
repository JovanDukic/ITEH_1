<?php

require "database/databaseManager.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
</head>

<body>

    <div class="navbar">
        <a>Login</a>
    </div>

    <div class="container">

        <div class="title">Registration form</div>

        <div class="content">
            <form action="#" method="POST" id="registrationForm">
                <div class="register">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username">
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password">
                    <label for="firstname">Firstname:</label>
                    <input type="text" name="firstname" id="firstname">
                    <label for="lastname">Lastname:</label>
                    <input type="text" name="lastname" id="lastname">
                    <label for="age">Age:</label>
                    <input type="text" name="age" id="age">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                    <br>
                    <input type="submit" name="submit" id="submit">
                </div>
            </form>
        </div>

    </div>

    <div class="footer"></div>

</body>

</html>