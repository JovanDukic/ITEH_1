<?php

require "../entity/Controller.php";

if (isset($_POST["text"])) {
    Controller::$userTests = null;
}
?>

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