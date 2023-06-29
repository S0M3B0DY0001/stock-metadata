<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $id = $_POST["id"];
        $number = $_POST["number"];
        $location_id = $_POST["location_id"];
        $notes = $_POST["notes"];
        $rack_profile_id = $_POST["rack_profile_id"];
        $private_user_id = $_POST["private_user_id"];
        $last_power_usage = $_POST["last_power_usage"];
        $last_power_update = $_POST["last_power_update"];

        if (empty($last_power_usage)) $last_power_usage = "NULL";
 
        if (empty($number)) {
	        echo "The name field can't be empty!";
	        exit();
        }

        if (empty($location_id) || !LocationExists($conn, $location_id)) {
	        echo "There is no matching location with this ID!";
	        exit();
        }

        if (empty($rack_profile_id) || !Rack_profileExists($conn, $rack_profile_id)) {
	        echo "There is no matching rack profile with this ID!";
	        exit();
        }

        if ($private_user_id == 0) $private_user_id = "NULL";
        elseif (empty($private_user_id) || !UserExists($conn, $private_user_id)) {
	        echo "There is no matching user with this ID!";
	        exit();
        }

        if (empty($id) || !RackExists($conn, $id)) {
	        echo "There is no matching rack with this ID!";
	        exit();
        }

        $canEdit = CanAddEditRack($conn, $number, $location_id, $rack_profile_id, $private_user_id);
        if ($canEdit != 0 && $canEdit != $id) {
	        echo "A rack with this name, location, rack_profile and user combination already exists!";
	        exit();
        }

        EditRack($conn, $id, $number, $location_id, $notes, $rack_profile_id, $private_user_id, $last_power_usage, $last_power_update);
    }
?>