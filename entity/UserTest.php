<?php

class UserTest
{
    public $ID;
    public $userID;
    public $testID;
    public $date;
    public $ambulance;
    public $result;

    public function __construct($ID = null, $userID = null, $testID = null, $date = null, $ambulance = null, $result = null)
    {
        $this->ID = $ID;
        $this->userID = $userID;
        $this->testID = $testID;
        $this->date = $date;
        $this->ambulance = $ambulance;
        $this->result = $result;
    }

    public static function createUserTest(UserTest $userTest, mysqli $connection)
    {
        $query = "INSERT INTO UserTest (userID, testID, date, ambulance, result) VALUES (?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("iisss", $userTest->userID, $userTest->testID, $userTest->date, $userTest->ambulance, $userTest->result);

        return $stmt->execute();
    }

    public static function loadUserTests($userID, mysqli $connection)
    {
        $query = "SELECT * FROM UserTest WHERE userID = '$userID'";

        $rs = $connection->query($query);

        $userTests = array();

        if (!empty($rs) && $rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                array_push($userTests, new UserTest($row["ID"], $row["userID"], $row["testID"], $row["date"], $row["ambulance"], $row["result"]));
            }
        }

        return $userTests;
    }

    public static function generateResult()
    {
        return rand(1, 100) % 2 == 0 ? "positive" : "negative";
    }
}
