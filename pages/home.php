<?php

require "../database/databaseManager.php";
require "../entity/CovidTest.php";

session_start();

$covidTests;

if (isset($_SESSION["ID"])) {
    $covidTests = CovidTest::loadTests($_SESSION["ID"], $connection);
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

</head>

<body>

    <div class="navbar">
        <a href="test.html">Testing</a>
    </div>

    <div class="container">

        <div class="title">Test results</div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Date</td>
                        <td>Type</td>
                        <td>Ambulance</td>
                        <td>Result</td>
                    </tr>
                </thead>>

                <tbody>
                    <?php foreach ($covidTests as $covidTest => $value) { ?>
                        <tr>
                            <td><?php echo $value->ID ?></td>
                            <td><?php echo $value->date ?></td>
                            <td><?php echo $value->type ?></td>
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