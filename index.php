<?php
    include_once 'shared/header.php';

    echo "<br>";
    $result = GetLocations($conn);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        echo "<h1 style='display: inline-block; text-align: center; width: 100%;'>" . $row['number'] . "</h1>" .
        "<table style=\"width: 97.5%;\">" .
            "<thead>" .
                "<th>Name</th>" .
                "<th>Rack profile</th>" .
                "<th>Notes</th>" .
                "<th>Owner</th>" .
                "<th>Total U's free</th>" .
                "<th>Theoretical maximum usage</th>" .
                "<th>Theoretical usage percentage</th>" .
                "<th>Current usage</th>" .
                "<th>Current usage percentage</th>" .
            "</thead>" .
            "<tbody>";
        $result2 = GetRackList($conn);
        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
        {
            if ($row2['location'] == $row['number']) {
                echo "<tr><td><a href=\"rackOverview.php?rack=" . $row2['id'] . "\">" . $row2['number'] . "</a></td>" .
                
                     "<td>" . $row2['rack_type'] . " - " . $row2['space'] . "U - "  . $row2['ampere'] . "A max - PDU's (L:R) " . $row2['pdus_left'] . ":" . $row2['pdus_right'] . " - " . $row2['cooling_capacity'] . "kWh max capacity - " . $row2['speed']/1000 . "G";
                     if ($row2['unmetered'] > 0) echo " unmetered";
                     else echo " metered";
                     if ($row2['local_speed'] > 0) echo " - " . $row2['local_speed']/1000 . "G Local";
                     if ($row2['wen'] > 0) echo " - WEN";
                     echo "</td>" .
                     "<td>" . $row2['notes'] . "</td>" .
                     "<td>";
                     if ($row2['private_user'] == NULL) echo "Worldstream";
                     else echo $row2['private_user'];
                     echo "</td>" .
                     "<td style='background-color: hsl(" . 100 - ($row2['total_u_used'] / $row2['space'] * 100) . " 100% 50%);'>" . $row2['space'] - $row2['total_u_used'] . "</td>" .
                     "<td>" . $row2['theoretical_max_power_usage'] . "</td>" .
                     "<td style='background-color: hsl(" . 100 - $row2['theoretical_power_percentage'] . " 100% 50%);'>" . $row2['theoretical_power_percentage'] . "</td>" .
                     "<td>" . $row2['current_usage'] . "</td>" .
                     "<td style='background-color: hsl(" . 100 - $row2['current_power_percentage'] . " 100% 50%);'>" . $row2['current_power_percentage'] . "</td></tr>";
            }
        }
        echo "</tbody></table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }


    include_once 'shared/footer.php';
?>