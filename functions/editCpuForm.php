<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $id = $_POST["id"];
        $number = $_POST["number"];
        $brand = $_POST["brand"];

        if (empty($number) || empty($brand)) {
	        echo "None field can be empty!";
	        exit();
        }

        if (empty($id) || !CpuExists($conn, $id)) {
	        echo "There is no matching cpu with this ID!";
	        exit();
        }

        $canEdit = CanAddEditCpu($conn, $number, $brand);
        if ($canEdit != 0 && $canEdit != $id) {
	        echo "A CPU with this name and brand already exists!";
	        exit();
        }
        
        EditCpu($conn, $id, $number, $brand);
    }
?>