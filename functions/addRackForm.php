<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $number = $_POST["number"];
        $location_id = $_POST["location_id"];
        $notes = $_POST["notes"];
        $rack_profile_id = $_POST["rack_profile_id"];
        $private_user_id = $_POST["private_user_id"];
 
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

        if (CanAddEditRack($conn, $number, $location_id, $rack_profile_id, $private_user_id) != 0) {
	        echo "A rack with this name, location, rack_profile and user combination already exists!";
	        exit();
        }

        AddRack($conn, $number, $location_id, $notes, $rack_profile_id, $private_user_id);
    }
?>