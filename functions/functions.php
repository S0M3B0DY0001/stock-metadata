<?php
    // CPU
    function GetCpus($conn) {
        $query = "SELECT * FROM `cpus`;";
        return mysqli_query($conn, $query);
    }

    function AddCpu($conn, $number, $brand) {
        $query = "INSERT INTO `cpus` (`id`, `number`, `brand`) VALUES (NULL, '$number', '$brand');";
        mysqli_query($conn, $query);
        header("location: ../cpus.php");
    }

    function GetCpu($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `cpus` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function EditCpu($conn, $id, $number, $brand) {
        $query = "UPDATE `cpus` SET `number` = '$number', `brand` = '$brand' WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../cpus.php");
    }

    function CpuExists($conn, $id) {
        $query = "SELECT * FROM `cpus` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }

    function CanAddEditCpu($conn, $number, $brand) {
        $query = "SELECT `id` FROM `cpus` WHERE `number` = '$number' AND `brand` = '$brand';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) == 0) return 0;
        else return mysqli_fetch_assoc($result)['id'];
    }



    // Chassis
    function GetChassises($conn) {
        $query = "SELECT * FROM `chassis`;";
        return mysqli_query($conn, $query);
    }

    function AddChassis($conn, $number, $height, $length, $psu_position) {
        $query = "INSERT INTO `chassis` (`id`, `number`, `height`, `length`, `psu_position`) VALUES (NULL, '$number', $height, $length, $psu_position);";
        mysqli_query($conn, $query);
        header("location: ../chassis.php");
    }

    function GetChassis($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `chassis` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function EditChassis($conn, $id, $number, $height, $length, $psu_position) {
        $query = "UPDATE `chassis` SET `number` = '$number', `height` = $height, `length` = $length, `psu_position` = $psu_position WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../chassis.php");
    }

    function ChassisExists($conn, $id) {
        $query = "SELECT * FROM `chassis` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }

    function CanAddEditChassis($conn, $number) {
        $query = "SELECT `id` FROM `chassis` WHERE `number` = '$number';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) == 0) return 0;
        else return mysqli_fetch_assoc($result)['id'];
    }



    // Chassis-CPU
    function GetChassis_cpus($conn) {
        $query = "SELECT * FROM `chassis_cpus`;";
        return mysqli_query($conn, $query);
    }

    function AddChassis_cpu($conn, $chassis_id, $cpu_id, $max_power_usage) {
        $query = "INSERT INTO `chassis_cpus` (`id`, `chassis_id`, `cpu_id`, `max_power_usage`) VALUES (NULL, $chassis_id, $cpu_id, $max_power_usage);";
        mysqli_query($conn, $query);
        header("location: ../chassis_cpus.php");
    }

    function GetChassis_cpu($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `chassis_cpus` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function EditChassis_cpu($conn, $id, $chassis_id, $cpu_id, $max_power_usage) {
        $query = "UPDATE `chassis_cpus` SET `chassis_id` = $chassis_id, `cpu_id` = $cpu_id, `max_power_usage` = $max_power_usage WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../chassis_cpus.php");
    }

    function Chassis_cpuExists($conn, $id) {
        $query = "SELECT * FROM `chassis_cpus` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }

    function CanAddEditChassis_cpu($conn, $chassis_id, $cpu_id) {
        $query = "SELECT `id` FROM `chassis_cpus` WHERE `chassis_id` = '$chassis_id' AND `cpu_id` = $cpu_id;";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) == 0) return 0;
        else return mysqli_fetch_assoc($result)['id'];
    }



    // Server
    function GetServers($conn) {
        $query = "SELECT * FROM `servers`;";
        return mysqli_query($conn, $query);
    }

    function AddServer($conn, $number, $service_tag, $chassis_cpu_id, $rack_id, $u_number) {
        $query = "INSERT INTO `servers` (`id`, `number`, `service_tag`, `chassis_cpu_id`, `rack_id`, `u_number`) VALUES (NULL, '$number', '$service_tag', $chassis_cpu_id, $rack_id, $u_number);";
        mysqli_query($conn, $query);
        header("location: ../servers.php");
    }

    function GetServer($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `servers` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function EditServer($conn, $id, $number, $service_tag, $chassis_cpu_id, $rack_id, $u_number) {
        $query = "UPDATE `servers` SET `number` = '$number', `service_tag` = '$service_tag', `chassis_cpu_id` = $chassis_cpu_id, `rack_id` = $rack_id, `u_number` = $u_number WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../servers.php");
    }

    function ServerExists($conn, $id) {
        $query = "SELECT * FROM `servers` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }

    function CanAddEditServer($conn, $number, $service_tag, $chassis_cpu_id, $rack_id, $u_number) {
        $query = "SELECT `id` FROM `servers` WHERE `number` = '$number' AND `service_tag` = '$service_tag' AND `chassis_cpu_id` = $chassis_cpu_id AND `rack_id` = $rack_id AND `u_number` = $u_number;";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) == 0) return 0;
        else return mysqli_fetch_assoc($result)['id'];
    }



    // Rack
    function GetRacks($conn) {
        $query = "SELECT * FROM `racks`;";
        return mysqli_query($conn, $query);
    }

    function AddRack($conn, $number, $location_id, $notes, $rack_profile_id, $private_user_id) {
        $query = "INSERT INTO `racks` (`id`, `number`, `location_id`, `notes`, `rack_profile_id`, `private_user_id`) VALUES (NULL, '$number', $location_id, '$notes', $rack_profile_id, $private_user_id);";
        mysqli_query($conn, $query);
        header("location: ../racks.php");
    }

    function GetRack($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `racks` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function EditRack($conn, $id, $number, $location_id, $notes, $rack_profile_id, $private_user_id, $last_power_usage, $last_power_update) {
        $query = "UPDATE `racks` SET `number` = '$number', `location_id` = $location_id, `notes` = '$notes', `rack_profile_id` = $rack_profile_id, `private_user_id` = $private_user_id, `last_power_usage` = $last_power_usage, `last_power_update` = '$last_power_update' WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../racks.php");
    }

    function RackExists($conn, $id) {
        $query = "SELECT * FROM `racks` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }

    function CanAddEditRack($conn, $number, $location_id, $rack_profile_id, $private_user_id) {
        $query = "SELECT `id` FROM `racks` WHERE `number` = '$number' AND `location_id` = $location_id AND `rack_profile_id` = $rack_profile_id AND `private_user_id` ";
        if ($private_user_id != "NULL") $query .= "= $private_user_id;";
        else $query .= "IS NULL;";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) == 0) return 0;
        else return mysqli_fetch_assoc($result)['id'];
    }

    function UpdateCurrentRackPowerUsage($conn, $id, $last_power_usage) {
        $query = "UPDATE `racks` SET `last_power_usage` = $last_power_usage, `last_power_update` = CURRENT_TIMESTAMP WHERE `id` = $id;";
        mysqli_query($conn, $query);
        header("location: ../racks.php");
    }



    // Rack profile
    function GetRack_profiles($conn) {
        $query = "SELECT * FROM `rack_profiles`;";
        return mysqli_query($conn, $query);
    }

    function GetRack_profile($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `rack_profiles` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function Rack_profileExists($conn, $id) {
        $query = "SELECT * FROM `rack_profiles` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }



    // Location
    function GetLocations($conn) {
        $query = "SELECT * FROM `locations`;";
        return mysqli_query($conn, $query);
    }

    function GetLocation($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `locations` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function LocationExists($conn, $id) {
        $query = "SELECT * FROM `locations` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }



    // User
    function GetUsers($conn) {
        $query = "SELECT * FROM `users`;";
        return mysqli_query($conn, $query);
    }

    function GetUser($conn, $id) {
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = $id;");
        return mysqli_fetch_array($result);
    }

    function UserExists($conn, $id) {
        $query = "SELECT * FROM `users` WHERE `id` = '$id';";
        $result = mysqli_query($conn, $query);
        if ($result) if(mysqli_num_rows($result) > 0) return true;
        else return false;
    }



    // Other
    function GetOccupiedPlacesInRack($conn, $rack_id) {
        $query = "SELECT S.`id`, S.`u_number`, C.`height` FROM `servers` S LEFT JOIN `chassis_cpus` CC on S.`chassis_cpu_id` = CC.`id` LEFT JOIN `chassis` C on C.`id` = CC.`chassis_id` WHERE S.`rack_id` = $rack_id;";
        return mysqli_query($conn, $query);
    }

    function GetRackList($conn) {
        $query = "SELECT R.`id`, L.`number` as 'location', R.`number`, RP.`rack_type`, RP.`ampere`, RP.`pdus_left`, RP.`pdus_right`, RP.`cooling_capacity`, RP.`space`, RP.`unmetered`, RP.`speed`, RP.`local_speed`, RP.`wen`, R.`notes`, U.`name` as 'private_user', SUM(C.`height`) as 'total_u_used', RP.`cooling_capacity`, IF(COUNT(S.`id`) > 0, SUM(CC.`max_power_usage`), 0) as 'theoretical_max_power_usage', IF(COUNT(S.`id`) > 0, ROUND(SUM(CC.`max_power_usage`) / RP.`cooling_capacity` * 100, 2), 0) as 'theoretical_power_percentage', R.`last_power_usage` as 'current_usage', ROUND(R.`last_power_usage` / RP.`cooling_capacity` * 100, 2) as 'current_power_percentage' FROM `racks` R LEFT JOIN `locations` L on L.`id` = R.`location_id` LEFT JOIN `users` U on U.`id` = R.`private_user_id` LEFT JOIN `rack_profiles` RP on RP.`id` = R.`rack_profile_id` LEFT JOIN `servers` S on S.`rack_id` = R.`id` LEFT JOIN `chassis_cpus` CC on CC.`id` = S.`chassis_cpu_id` LEFT JOIN `chassis` C on C.`id` = CC.`chassis_id` WHERE RP.`rack_type` = 'Dedicated' GROUP BY R.`id`;";
        return mysqli_query($conn, $query);
    }

    function GetRackInformation($conn, $rack_id) {
        $query = "SELECT R.`id`, R.`number`, RP.`pdus_left`, RP.`pdus_right`, RP.`cooling_capacity`, SUM(CC.`max_power_usage`) as 'total_max_power_usage', RP.`space` FROM `racks` R LEFT JOIN `rack_profiles` RP on RP.`id` = R.`rack_profile_id` LEFT JOIN `servers` S on R.`id` = S.`rack_id` LEFT JOIN `chassis_cpus` CC on S.`chassis_cpu_id` = CC.`id` WHERE R.`id` = $rack_id GROUP BY R.`id`;";
        return mysqli_query($conn, $query);
    }

    function GetRackOverview($conn, $rack_id) {
        $query = "SELECT S.`id`, S.`number` as 'number', S.`u_number`, CC.`max_power_usage`, C.`number` as 'chassis_number', C.`height`, C.`length`, C.`psu_position`FROM `servers` S LEFT JOIN `chassis_cpus` CC on CC.`id` = S.`chassis_cpu_id` LEFT JOIN `chassis` C on C.`id` = CC.`chassis_id` WHERE S.`rack_id` = $rack_id ORDER BY S.`u_number` DESC;";
        return mysqli_query($conn, $query);
    }
?>