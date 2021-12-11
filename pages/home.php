<?php

require "../database/databaseManager.php";
require "../entity/Controller.php";

Controller::loadCovidTests($connection);
Controller::loadUserTests($connection);

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

</head>

<body>

    <div class="navbar">
        <a href="test.html">Testing</a>
    </div>

    <div class="container">

        <div class="title">Test results</div>

        <div class="toolbar">
            <form>
                <label for="search">Ambulance filter: </label>
                <input type="text" name="search" id="search">
            </form>
        </div>

        <div class="data">
            <table>
                <thead>
                    <tr>
                        <td>TestID</td>
                        <td>UserID</td>
                        <td>Date</td>
                        <td>Type</td>
                        <td>Ambulance</td>
                        <td>Result</td>
                    </tr>
                </thead>>

                <tbody>
                    <?php foreach (Controller::$userTests as $userTest => $value) { ?>
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

    <div class="footer"></div>

</body>

</html>