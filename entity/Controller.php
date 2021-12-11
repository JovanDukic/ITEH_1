<?php

require "../entity/CovidTest.php";
require "../entity/UserTest.php";

session_start();

class Controller
{
    public static $covidTests;
    public static $userTests;

    public static function loadCovidTests(mysqli $connection)
    {
        self::$covidTests = CovidTest::loadCovidTests($connection);
    }

    public static function loadUserTests(mysqli $connection)
    {
        self::$userTests = UserTest::loadUserTests($_SESSION["ID"], $connection);
    }
}
