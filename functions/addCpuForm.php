<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $number = $_POST["number"];
        $brand = $_POST["brand"];
 
        if (empty($number) || empty($brand)) {
	        echo "None field can be empty!";
	        exit();
        }

        if (CanAddEditCpu($conn, $number, $brand) != 0) {
	        echo "A CPU with this name and brand already exists!";
	        exit();
        }

        AddCpu($conn, $number, $brand);
    }
?>