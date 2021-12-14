<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

session_start();

if (isset($_SESSION["ID"])) {
    Controller::getController()->loadUserTests($_SESSION["userID"], $connection);
    Controller::getController()->loadCovidTests($connection);
    $_SESSION["controller"] = Controller::getController();
    $user = Controller::getController()->loadUser($_SESSION["userID"], $connection);
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
    <title>User tests</title>

    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/link.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/adminUserTests.js"></script>
    <script src="../js/logout.js"></script>
</head>

<body>

    <div class="navbar">
        <a href="admin.php">HOMEPAGE</a>
        <a href="#" id="logout">LOGOUT</a>
    </div>

    <div class="container">

        <div class="title">User: <?php echo $user->firstname . " " . $user->lastname ?></div>

        <div class="toolbar">
            <div class="ambulanceFilter">
                <div>
                    <label for="search">Search:</label>
                </div>
                <div class="search">
                    <input type="text" name="search" id="search">
                </div>
                <div class="filter">
                    <select id="filterValue">
                        <option value="date">Date</option>
                        <option value="testID">Type</option>
                        <option value="ambulance">Ambulance</option>
                        <option value="result">Result</option>
                    </select>
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
            <table id="table1">

                <thead>
                    <tr>
                        <th>TestID</th>
                        <th>UserID</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Ambulance</th>
                        <th>Result</th>
                        <th>Action</th>
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
                            <td><a href="#" class="delete">DELETE</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>