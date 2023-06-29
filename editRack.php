<?php
    include_once 'shared/header.php';
    
    if (isset($_GET["id"]) && RackExists($conn, $_GET["id"])) $rack = GetRack($conn, $_GET["id"]);
    else {
        echo "There is no matching rack with this ID!";
        include 'shared/footer.php';
        exit();
    }
    
    echo "<br><form action=\"functions/editRackForm.php\" method=\"post\">" .
            "<input type=\"hidden\" name=\"id\" value=\"" . $rack['id'] . "\">" .

            "<label>Name:</label> <input type=\"text\" name=\"number\" value=\"" . $rack['number'] . "\">" .

            "<br><label>Location:</label> <select name=\"location_id\">";
                $result = GetLocations($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($rack['location_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['number'] . "</option>";
                }
            echo "</select>" .

            "<br><label>Notes:</label> <input type=\"text\" name=\"notes\" value=\"" . $rack['notes'] . "\">" .

            "<br><label>Rack profile:</label> <select name=\"rack_profile_id\">";
                $result = GetRack_profiles($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($rack['rack_profile_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['rack_type'] . " - " . $row['space'] . "U - " . $row['ampere'] . "A max - PDU's (L:R) " . $row['pdus_left'] . ":" . $row['pdus_right'] . " - " . $row['cooling_capacity'] . "kWh max capacity - " . $row['speed']/1000 . "G";
                    if ($row['unmetered'] > 0) echo " unmetered";
                    else echo " metered";
                    if ($row['local_speed'] > 0) echo " - " . $row['local_speed']/1000 . "G Local";
                    if ($row['wen'] > 0) echo " - WEN";
                    echo "</option>";
                }
            echo "</select>" .

            "<br><label>Owner:</label> <select name=\"private_user_id\"><option value='0'";
                if ($rack['private_user_id'] == NULL) echo " selected=\"selected\"";
                echo ">Worldstream</option>";

                $result = GetUsers($conn);
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo "<option value='" . $row['id'] . "'";
                    if($rack['private_user_id'] == $row['id']) echo "selected=\"selected\"";
                    echo ">" . $row['name'] . "</option>";
                }
            echo "</select>" .

            "<br><label>Last power reading value (kWh):</label> <input type=\"number\" step=\"0.001\" min=\"0\" name=\"last_power_usage\" value=\"" . $rack['last_power_usage'] . "\">" .

            "<br><label>Last power reading date:</label> <input type=\"datetime-local\" name=\"last_power_update\" value=\"" . $rack['last_power_update'] . "\">" .

            "<br><button type=\"submit\" name=\"submit\">Edit</button>" .
        "</form>";
    
    include_once 'shared/footer.php';
?>