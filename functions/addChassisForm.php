<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $number = $_POST["number"];
        $height = $_POST["height"];
        $length = $_POST["length"];
        $psu_position = $_POST["psu_position"];
 
        if (empty($number) || empty($height) || empty($length) || empty($psu_position)) {
	        echo "None field can be empty!";
	        exit();
        }

        if (CanAddEditChassis($conn, $number) != 0) {
	        echo "A chassis with this name already exists!";
	        exit();
        }

        AddChassis($conn, $number, $height, $length, $psu_position);
    }
?>