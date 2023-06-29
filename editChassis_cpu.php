<?php
    include_once 'shared/header.php';
    
    if (isset($_GET["id"]) && Chassis_cpuExists($conn, $_GET["id"])) $chassis_cpu = GetChassis_cpu($conn, $_GET["id"]);
    else {
        echo "There is no matching chassis_cpu with this ID!";
        include 'shared/footer.php';
        exit();
    }
    
    echo "<br><form action=\"functions/editChassis_cpuForm.php\" method=\"post\">" .
            "<input type=\"hidden\" name=\"id\" value=\"" . $chassis_cpu['id'] . "\">" .

            "<label>Chassis:</label> <select name=\"chassis_id\">";
                $result = GetChassises($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($chassis_cpu['chassis_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['number'] . "</option>";
                }
            echo "</select>" .

            "<br><label>CPU:</label> <select name=\"cpu_id\">";
                $result = GetCpus($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($chassis_cpu['cpu_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['number'] . "</option>";
                }
            echo "</select>" .

            "<br><label>Maximum power usage (Watt):</label> <input type=\"number\" name=\"max_power_usage\" value=\"" . $chassis_cpu['max_power_usage'] * 1000 . "\">" .

            "<br><button type=\"submit\" name=\"submit\">Edit</button>" .
        "</form>";
    
    include_once 'shared/footer.php';
?>