<?php
    include_once 'shared/header.php';
?>
<br>
<form action="functions/addRackForm.php" method="post">
    <label>Name:</label> <input type="text" name="number">
    <br>
    <label>Location:</label> <select name="location_id"><option value=''>Choose a location</option>
        <?php
            $result = GetLocations($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['number'] . "</option>";
            }
        ?>
    </select>
    <br>
    <label>Notes:</label> <input type="text" name="notes">
    <br>
    <label>Rack profile:</label> <select name="rack_profile_id"><option value=''>Choose a rack profile</option>
        <?php
            $result = GetRack_profiles($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['rack_type'] . " - " . $row['space'] . "U - " . $row['ampere'] . "A max - PDU's (L:R) " . $row['pdus_left'] . ":" . $row['pdus_right'] . " - " . $row['cooling_capacity'] . "kWh max capacity - " . $row['speed']/1000 . "G";
                if ($row['unmetered'] > 0) echo " unmetered";
                else echo " metered";
                if ($row['local_speed'] > 0) echo " - " . $row['local_speed']/1000 . "G Local";
                if ($row['wen'] > 0) echo " - WEN";
                echo "</option>";
            }
        ?>
    </select>
    <br>
    <label>Owner:</label> <select name="private_user_id"><option value=''>Choose an user</option><option value='0'>Worldstream</option>
        <?php
            $result = GetUsers($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
        ?>
    </select>
    <br>
    <button type="submit" name="submit">Add</button>
</form>
<br>
<table>
    <thead>
        <th>Name</th>
        <th>Location</th>
        <th>Notes</th>
        <th>Rack profile</th>
        <th>Owner</th>
        <th>Last power reading</th>
        <th>Update power reading</th>
    </thead>
    <tbody>
        <?php
            $result = GetRacks($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $rack_profile = GetRack_profile($conn, $row['rack_profile_id']);
                echo "<tr><td><a href=\"editRack.php?id=" . $row['id'] . "\">" . $row['number'] . "</a></td>" .
                         "<td>" . GetLocation($conn, $row['location_id'])['number'] . "</td>" .
                         "<td>" . $row['notes'] . "</td>" .
                         "<td>" . $rack_profile['rack_type'] . " - " . $rack_profile['space'] . "U - "  . $rack_profile['ampere'] . "A max - PDU's (L:R) " . $rack_profile['pdus_left'] . ":" . $rack_profile['pdus_right'] . " - " . $rack_profile['cooling_capacity'] . "kWh max capacity - " . $rack_profile['speed']/1000 . "G";
                         if ($rack_profile['unmetered'] > 0) echo " unmetered";
                         else echo " metered";
                         if ($rack_profile['local_speed'] > 0) echo " - " . $rack_profile['local_speed']/1000 . "G Local";
                         if ($rack_profile['wen'] > 0) echo " - WEN";
                         echo "</td>";
                         
                         if ($row['private_user_id'] == NULL) echo "<td>Worldstream</td>";
                         else echo "<td>" . GetUser($conn, $row['private_user_id'])['name'] . "</td>";

                         echo "<td>" . $row['last_power_usage'] . " kWh on " . $row['last_power_update'] . "</td>" .
                              "<td><form action=\"functions/updatePowerUsageForm.php\" method=\"post\">" .
                                  "<input type=\"hidden\" name=\"rack_id\" value=\"" . $row['id'] . "\">" .
                                  "<input type=\"number\" step=\"0.001\" min=\"0\" name=\"last_power_usage\" placeholder=\"Power usage (kWh)\" style=\"width: 72.5%;\">" .
                                  "<button type=\"submit\" name=\"submit\" style=\"width: 27.5%;\">Update</button>" .
                              "</form></td>" .
                        "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
    include_once 'shared/footer.php';
?>