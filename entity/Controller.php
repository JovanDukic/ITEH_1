<?php

require "../entity/CovidTest.php";
require "../entity/UserTest.php";
require "../entity/User.php";

class Controller
{
    public $covidTests = array();
    public $userTests = array();
    public $sortedArray = array();

    private $sortArray = array();

    private static $controller;

    private final function __construct()
    {
    }

    public static function getController()
    {
        if (!isset(self::$controller)) {
            self::$controller = new Controller();
        }
        return self::$controller;
    }

    public function loadCovidTests(mysqli $connection)
    {
        $this->covidTests = CovidTest::loadCovidTests($connection);
    }

    public function loadUserTests($userID, mysqli $connection)
    {
        $this->userTests = UserTest::loadUserTests($userID, $connection);
    }

    public function loadUser($userID, mysqli $connection)
    {
        return User::getUser($userID, $connection);
    }

    public function searchForUserTests($text, $userID, mysqli $connection)
    {
        $this->userTests = UserTest::search($text, $userID, $connection);
    }

    public function sortUserTests($flag)
    {
        $this->sortedArray = $this->userTests;
        $this->sortArray = array();

        $chunks = explode(":", $flag);

        foreach ($chunks as $chunk) {
            switch ($chunk) {
                case "date":
                    array_push($this->sortArray, array($this, "compareDates"));
                    break;
                case "type":
                    array_push($this->sortArray, array($this, "compareTypes"));
                    break;
                case "ambulance":
                    array_push($this->sortArray, array($this, "compareAmbulances"));
                    break;
                case "result":
                    array_push($this->sortArray, array($this, "compareResults"));
                    break;
                default:
                    break;
            }
        }

        usort($this->sortedArray, array($this, "cmp"));
    }

    function cmp($test1, $test2)
    {
        foreach ($this->sortArray as $sort) {
            $val = $sort($test1, $test2);
            if ($val != 0) {
                return $val;
            }
        }
        return 0;
    }

    function compareDates($test1, $test2)
    {
        return $test1->date > $test2->date;
    }

    function compareTypes($test1, $test2)
    {
        return $test1->testID > $test2->testID;
    }

    function compareAmbulances($test1, $test2)
    {
        return strcmp($test1->ambulance, $test2->ambulance);
    }

    function compareResults($test1, $test2)
    {
        return strcmp($test1->result, $test2->result);
    }
}
