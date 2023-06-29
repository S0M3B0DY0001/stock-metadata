<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $rack_id = $_POST["rack_id"];
        $last_power_usage = $_POST["last_power_usage"];
 
        if ($last_power_usage == "") {
	        echo "The power usage field cannot be empty!";
	        exit();
        }

        if ($last_power_usage < 0) {
	        echo "The power usage of this rack cannot be lower than 0 kWh!";
	        exit();
        }

        if (empty($rack_id) || !RackExists($conn, $rack_id)) {
	        echo "There is no matching rack with this ID!";
	        exit();
        }

        UpdateCurrentRackPowerUsage($conn, $rack_id, $last_power_usage);
    }
?>