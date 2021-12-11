<?php

require "../database/databaseManager.php";
require "../entity/UserTest.php";
require "../entity/CovidTest.php";

session_start();

if (isset($_POST["type"]) && isset($_POST["ambulance"])) {
    $userTest = new UserTest(null, $_SESSION["ID"], CovidTest::getIDFromType($_POST["type"]), date("Y-m-d"), $_POST["ambulance"], UserTest::generateResult());

    $res = UserTest::createUserTest($userTest, $connection);

    if ($res) {
        echo "success";
    } else {
        echo "failed";
    }
}
