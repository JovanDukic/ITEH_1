<?php

class CovidTest
{
    public $ID;
    public $date;
    public $type;
    public $ambulance;
    public $result;
    public $userID;

    public function __construct($ID = null, $date = null, $type = null, $ambulance = null, $result = null, $userID = null)
    {
        $this->ID = $ID;
        $this->date = $date;
        $this->type = $type;
        $this->ambulance = $ambulance;
        $this->result = $result;
        $this->userID = $userID;
    }

    public static function createTest(CovidTest $covidTest, mysqli $connection)
    {
        $query = "INSERT INTO CovidTest (date, type, ambulance, result, userID) VALUES (?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("ssssi", $covidTest->date, $covidTest->type, $covidTest->ambulance, $covidTest->result, $covidTest->userID);

        return $stmt->execute();
    }

    public static function loadTests($ID, mysqli $connection)
    {
        $query = "SELECT * FROM CovidTest where userID = '$ID'";

        $rs = $connection->query($query);

        if (!empty($rs) && $rs->num_rows > 0) {
            $tests = array();
            while ($row = $rs->fetch_array()) {
                array_push($tests, new CovidTest($row["ID"], $row["date"], $row["type"], $row["ambulance"], $row["result"]));
            }
            return $tests;
        } else {
            return null;
        }
    }
}
