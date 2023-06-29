<?php
    include_once 'shared/header.php';
    
    if (isset($_GET["id"]) && ServerExists($conn, $_GET["id"])) $server = GetServer($conn, $_GET["id"]);
    else {
        echo "There is no matching server with this ID!";
        include 'shared/footer.php';
        exit();
    }
    
    echo "<br><form action=\"functions/editServerForm.php\" method=\"post\">" .
            "<input type=\"hidden\" name=\"id\" value=\"" . $server['id'] . "\">" .

            "<label>Name:</label> <input type=\"text\" name=\"number\" value=\"" . $server['number'] . "\">" .

            "<br><label>Service tag:</label> <input type=\"text\" name=\"service_tag\" value=\"" . $server['service_tag'] . "\">" .

            "<br><label>Chassis:</label> <select name=\"chassis_cpu_id\">";
                $result = GetChassis_cpus($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($server['chassis_cpu_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . GetChassis($conn, $row['chassis_id'])['number'] . " - " . GetCpu($conn, $row['cpu_id'])['number'] . "</option>";
                }
            echo "</select>" .

            "<br><label>Rack:</label> <select name=\"rack_id\">";
                $result = GetRacks($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($server['rack_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['number'] . "</option>";
                }
            echo "</select>" .

            "<br><label>U number in rack:</label> <input type=\"number\" name=\"u_number\" value=\"" . $server['u_number'] . "\">" .

            "<br><button type=\"submit\" name=\"submit\">Edit</button>" .
        "</form>";
    
    include_once 'shared/footer.php';
?>