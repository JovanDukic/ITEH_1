<?php

require "../database/databaseManager.php";
require "../entity/CovidTest.php";

session_start();

if (isset($_POST["type"]) && isset($_POST["ambulance"]) && isset($_POST["date"])) {
    $val = rand(2);
    $result = $val == 0 ? "negative" : "positive";
    $covidTest = new CovidTest(null, $_POST["date"], $_POST["type"], $_POST["ambulance"], $result, $_SESSION["ID"]);

    $res = CovidTest::createTest($covidTest, $connection);

    if ($res) {
        echo "success";
    } else {
        echo "failed";
    }
}
