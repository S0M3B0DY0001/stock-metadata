<?php
    include_once 'shared/header.php';
?>

<style>
    .pduText {
        width: 10%;
        font-size: 150%;
        text-align: center;
    }

    .pduTextLeft {
        margin-right: 1%;
    }

    .pduTextRight {
        margin-left: 1%;
    }
</style>

<?php
    echo "<br>";
    if (!isset($_GET["rack"]) || !RackExists($conn, $_GET["rack"])) {
        echo "There is no matching rack with this ID!";
        include 'shared/footer.php';
        exit();
    }
    $rack = mysqli_fetch_assoc(GetRackInformation($conn, $_GET["rack"]));
    echo "<h1 style=\"display: inline-block; text-align: center; width: 100%;\">" . $rack['number'] . " (" . $rack['total_max_power_usage'] . " kWh total of " . $rack['cooling_capacity'] . " kWh max)</h1>";
?>

<div style="display: flex;">
    <h1 class="pduText pduTextLeft">PDU's left:<br><?php echo $rack['pdus_left']; ?></h1>

    <table>
        <thead>
            <tr>
                <th>U</th>
                <th>Server name</th>
                <th>Chassis</th>
                <th>Length</th>
                <th>PSU position</th>
                <th>Theoretical power usage</th>
            </tr>
        </thead>
        <tbody>
            <?php
                for ($x = $rack['space']; $x > 0; $x--) {
                    $uIsInUse = false;
                    $result = GetRackOverview($conn, $rack['id']);
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $isInUse = $x >= $row['u_number'] && $x <= $row['u_number'] + $row['height'] - 1;

                        if ($isInUse == true) {
                            $uIsInUse = true;
                            $max_power_usage_percentage = round($row['max_power_usage'] / $rack['total_max_power_usage'] * 100, 2);
                            $max_power_usage_color = ($max_power_usage_percentage <= 25) ? 100 - $max_power_usage_percentage * 4 : 0;
                            echo "<tr style=\"background-color:#696969\">" .
                                "<td >$x</td>" .
                                "<td><a href=\"editServer.php?id=" . $row['id'] . "\">" . $row['number'] . "</a></td>" .
                                "<td>" . $row['chassis_number'] . "</td>" .
                                "<td>" . $row['length'] . " MM</td>" .
                                "<td>";

                                switch ($row['psu_position']) {
                                    case 1:
                                        echo "Left";
                                        break;
                                    case 2:
                                        echo "Right";
                                        break;
                                    case 3:
                                        echo "Centre";
                                        break;
                                    default:
                                        echo "Other";
                                }

                                echo "</td>" .
                                "<td style='background-color: hsl(" . $max_power_usage_color . " 100% 50%);'>" . $row['max_power_usage'] . " kWh (" . $max_power_usage_percentage . "%)</td>" .
                            "</tr>";
                        }
                    }
                    if (!$uIsInUse) echo "<tr><td>$x</td><td></td><td></td><td></td><td></td><td></td></tr>";
                }
            ?>
        </tbody>
    </table>

    <h1 class="pduText pduTextRight">PDU's right:<br><?php echo $rack['pdus_right']; ?></h1>
</div>
<br><br><br><br><br>
<?php include_once 'shared/footer.php'; ?>