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
        $query = "SELECT * FROM UserTest WHERE userID = ?";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("i", $userID);

        $stmt->execute();

        $rs = $stmt->get_result();

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

    public static function search($text, $filter, $userID, mysqli $connection)
    {
        $query = null;

        if ($filter == "testID") {
            $query = "SELECT * FROM UserTest u INNER JOIN CovidTest t ON u.testID = t.ID where t.type LIKE ? AND u.userID = ?";
        } else {
            $query = "SELECT * FROM UserTest WHERE $filter LIKE ? AND userID = ?";
        }

        $var = "%$text%";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("si", $var, $userID);

        $stmt->execute();

        $rs = $stmt->get_result();

        $userTests = array();

        if (!empty($rs) && $rs->num_rows > 0) {
            while ($row = $rs->fetch_array()) {
                array_push($userTests, new UserTest($row["ID"], $row["userID"], $row["testID"], $row["date"], $row["ambulance"], $row["result"]));
            }
        }

        return $userTests;
    }

    public static function deleteTest($userID, $testID, mysqli $connection)
    {
        $query = "DELETE FROM UserTest WHERE userID = '$userID' AND ID = '$testID'";

        return $connection->query($query);
    }
}
