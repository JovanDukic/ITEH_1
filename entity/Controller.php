<?php

require "../entity/CovidTest.php";
require "../entity/UserTest.php";
require "../entity/User.php";

class Controller
{
    public $covidTests = array();
    public $userTests = array();
    public $users = array();
    public $sortedArray = array();
    private $sortArray = array();

    public $user;

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

    public function loadUsers(mysqli $connection)
    {
        $this->users = User::loadUsers($connection);
    }

    public function loadUserTests($userID, mysqli $connection)
    {
        $this->userTests = UserTest::loadUserTests($userID, $connection);
    }

    public function loadUser($userID, mysqli $connection)
    {
        return User::getUser($userID, $connection);
    }

    public function searchForUserTests($text, $filter, $userID, mysqli $connection)
    {
        $this->userTests = UserTest::search($text, $filter, $userID, $connection);
    }

    public function searchForUsers($text, $filter, $userID, mysqli $connection)
    {
        $this->users = User::search($text, $filter, $userID, $connection);
    }

    public function deleteUser($userID, mysqli $connection)
    {
        User::deleteUser($userID, $connection);
    }

    public function deleteUserTest($userID, $testID, mysqli $connection)
    {
        UserTest::deleteTest($userID, $testID, $connection);
    }

    public function sortUsers($flag)
    {
        $this->sortedArray = $this->users;
        $this->sortArray = array();

        $chunks = explode(":", $flag);

        foreach ($chunks as $chunk) {
            switch ($chunk) {
                case "firstname":
                    array_push($this->sortArray, array($this, "compareFirstname"));
                    break;
                case "lastname":
                    array_push($this->sortArray, array($this, "compareLastname"));
                    break;
                case "age":
                    array_push($this->sortArray, array($this, "compareAge"));
                    break;
                case "gender":
                    array_push($this->sortArray, array($this, "compareGender"));
                    break;
                default:
                    break;
            }
        }

        usort($this->sortedArray, array($this, "cmp"));
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

    // ============== CMP function ==============
    function cmp($obj1, $obj2)
    {
        foreach ($this->sortArray as $sort) {
            $res = $sort($obj1, $obj2);
            if ($res != 0) {
                return $res;
            }
        }
        return 0;
    }

    // ============== UserTest compare funtions ============== 
    function compareDates($test1, $test2)
    {
        if ($test1->date == $test2->date) {
            return 0;
        } else if ($test1->date > $test2->date) {
            return 1;
        } else {
            return -1;
        }
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

    // ============== User compare funtions ============== 
    function compareFirstname($user1, $user2)
    {
        return strcmp($user1->firstname, $user2->firstname);
    }

    function compareLastname($user1, $user2)
    {
        return strcmp($user1->lastname, $user2->lastname);
    }

    function compareAge($user1, $user2)
    {
        if ($user1->age == $user2->age) {
            return 0;
        } else if ($user1->age > $user2->age) {
            return 1;
        } else {
            return -1;
        }
    }

    function compareGender($user1, $user2)
    {
        return strcmp($user1->gender, $user2->gender);
    }
}
