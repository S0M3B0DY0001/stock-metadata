<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $id = $_POST["id"];
        $number = $_POST["number"];
        $height = $_POST["height"];
        $length = $_POST["length"];
        $psu_position = $_POST["psu_position"];

        if (empty($number) || empty($height) || empty($length) || empty($psu_position)) {
	        echo "This field cannot be empty!";
	        exit();
        }

        if (empty($id) || !ChassisExists($conn, $id)) {
	        echo "There is no matching chassis with this ID!";
	        exit();
        }

        $canEdit = CanAddEditChassis($conn, $number);
        if ($canEdit != 0 && $canEdit != $id) {
	        echo "A chassis with this name already exists!";
	        exit();
        }
        
        EditChassis($conn, $id, $number, $height, $length, $psu_position);
    }
?>