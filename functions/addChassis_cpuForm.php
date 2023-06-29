<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $chassis_id = $_POST["chassis_id"];
        $cpu_id = $_POST["cpu_id"];
        $max_power_usage_field = $_POST["max_power_usage"];
 
        if (empty($max_power_usage_field)) {
	        echo "The power usage field cannot be empty!";
	        exit();
        }
        $max_power_usage = $max_power_usage_field / 1000;

        if (empty($chassis_id) || !ChassisExists($conn, $chassis_id)) {
	        echo "There is no matching chassis with this ID!";
	        exit();
        }

        if (empty($cpu_id) || !CpuExists($conn, $cpu_id)) {
	        echo "There is no matching CPU with this ID!";
	        exit();
        }

        if (CanAddEditChassis_cpu($conn, $chassis_id, $cpu_id) != 0) {
	        echo "A chassis_cpu with this chassis and cpu combination already exists!";
	        exit();
        }

        AddChassis_cpu($conn, $chassis_id, $cpu_id, $max_power_usage);
    }
?>