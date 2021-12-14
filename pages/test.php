<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (!isset($_SESSION["ID"])) {
    header("Location: ../pages/login.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/test.js"></script>
    <script src="../js/logout.js"></script>
</head>

<body>

    <div class="navbar">
        <a href="home.php">HOMEPAGE</a>
        <a href="profile.php">PROFILE</a>
        <a href="#" id="logout">LOGOUT</a>
    </div>

    <div class="container">

        <div class="title">CovidTest Form</div>

        <form action="#" method="POST" id="testForm">
            <div class="content">

                <div class="part-1">
                    <div class="test-part">
                        <label>Test type:</label>
                    </div>

                    <div class="test-part">
                        <label for="pcr">pcr-test</label>
                        <input type="radio" name="type" id="pcr" value="pcr" checked="checked">
                    </div>

                    <div class="test-part">
                        <label for="fast">quick-test</label>
                        <input type="radio" name="type" id="quick" value="quick">
                    </div>
                </div>

                <div class="part-2">
                    <div class="test-part">
                        <label for="ambulance">Ambulance:</label>
                    </div>

                    <div class="test-part">
                        <select name="ambulance" id="ambulance">
                            <option value="A-ambulance">A-ambulance</option>
                            <option value="B-ambulance">B-ambulance</option>
                            <option value="C-ambulance">C-ambulance</option>
                            <option value="D-ambulance">D-ambulance</option>
                            <option value="E-ambulance">E-ambulance</option>
                        </select>
                    </div>
                </div>

                <div class="part">
                    <input type="submit" name="button" id="submit" value="CREATE TEST">
                </div>


            </div>
        </form>

    </div>

</body>

</html>