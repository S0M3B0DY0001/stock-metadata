<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stock-metadata</title>
        <link rel="stylesheet" href="../shared/styles.css">
    </head>
    <body>
        <header>
            <a href="../index.php">Home</a>
            <a href="../racks.php">Racks</a>
            <a href="../servers.php">Servers</a>
            <a href="../chassis_cpus.php">Chassis and cpu combinations</a>
            <a href="../chassis.php">Chassis</a>
            <a href="../cpus.php">CPU's</a>
        </header>

        <?php
            require_once 'dbconnection.php';
            require_once 'functions.php';
            include_once '../shared/footer.php';
        ?>