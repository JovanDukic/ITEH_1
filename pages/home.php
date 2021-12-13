<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["ID"])) {
    Controller::getController()->loadUserTests($_SESSION["ID"], $connection);
    Controller::getController()->loadCovidTests($connection);
    $_SESSION["controller"] = Controller::getController();
} else {
    header("Location: ../pages/login.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/home.js"></script>
    <script src="../js/logout.js"></script>
</head>

<body>

    <div class="navbar">
        <a href="test.php">TESTING</a>
        <a href="profile.php">PROFILE</a>
        <a href="#" id="logout">LOGOUT</a>
    </div>

    <div class="container">

        <div class="title">Test results</div>

        <div class="toolbar">
            <div class="ambulanceFilter">
                <div>
                    <label for="search">Ambulance filter: </label>
                </div>
                <div class="search">
                    <input type="text" name="search" id="search">
                </div>
            </div>

            <div class="other">
                <div class="part">
                    <label>Sort criteria: </label>
                </div>

                <div class="part">
                    <label for="sortDate">date</label>
                    <input type="checkbox" name="sortDate" id="sortDate">
                </div>

                <div class="part">
                    <label for="sortType">type</label>
                    <input type="checkbox" name="sortType" id="sortType">
                </div>

                <div class="part">
                    <label for="sortAmbulance">ambulance</label>
                    <input type="checkbox" name="sortAmbulance" id="sortAmbulance">
                </div>

                <div class="part">
                    <label for="sortResult">result</label>
                    <input type="checkbox" name="sortResult" id="sortResult">
                </div>
            </div>
        </div>

        <div class="data">
            <table id="table">

                <thead>
                    <tr>
                        <th>TestID</th>
                        <th>UserID</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Ambulance</th>
                        <th>Result</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (Controller::getController()->userTests as $userTest => $value) { ?>
                        <tr>
                            <td><?php echo $value->ID ?></td>
                            <td><?php echo $value->userID ?></td>
                            <td><?php echo $value->date ?></td>
                            <td><?php echo CovidTest::getTypeFromID($value->testID) ?></td>
                            <td><?php echo $value->ambulance ?></td>
                            <td><?php echo $value->result ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>