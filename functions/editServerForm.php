<?php
    include_once 'shared/header.php';

    if (isset($_POST["submit"])) {
        $id = $_POST["id"];
        $number = $_POST["number"];
        $service_tag = $_POST["service_tag"];
        $chassis_cpu_id = $_POST["chassis_cpu_id"];
        $rack_id = $_POST["rack_id"];
        $u_number = $_POST["u_number"];
 
        if (empty($number) || empty($service_tag) || empty($u_number)) {
	        echo "None field can be empty!";
	        exit();
        }

        if (empty($chassis_cpu_id) || !Chassis_cpuExists($conn, $chassis_cpu_id)) {
	        echo "There is no matching chassis_cpu with this ID!";
	        exit();
        }

        if (empty($rack_id) || !RackExists($conn, $rack_id)) {
	        echo "There is no matching rack with this ID!";
	        exit();
        }

        if (empty($id) || !ServerExists($conn, $id)) {
	        echo "There is no matching server with this ID!";
	        exit();
        }

        $height = GetChassis($conn, GetChassis_cpu($conn, $chassis_cpu_id)['chassis_id'])['height'];
        if ($u_number < 1 || $u_number + $height > GetRack_profile($conn, GetRack($conn, $rack_id)['rack_profile_id'])['space']) {
            echo "This U number is outside of the borders of this rack!";
	        exit();
        }

        if ($u_number != GetServer($conn, $id)['u_number'] || $rack_id != GetServer($conn, $id)['rack_id']) {
            $height = GetChassis($conn, GetChassis_cpu($conn, $chassis_cpu_id)['chassis_id'])['height'];
            $result = GetOccupiedPlacesInRack($conn, $rack_id);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id'] == $id) continue;
                for ($u = 0; $u < $row['height']; $u++) {
                    for ($u2 = 0; $u2 < $height; $u2++) {
                        if ($u_number + $u2 == $row['u_number'] + $u) {
                            echo "This U number is already occupied!";
                            exit();
                        }
                    }
                }
            }
        }

        $canEdit = CanAddEditServer($conn, $number, $service_tag, $chassis_cpu_id, $rack_id, $u_number);
        if ($canEdit != 0 && $canEdit != $id) {
	        echo "A server with this information already exists!";
	        exit();
        }

        EditServer($conn, $id, $number, $service_tag, $chassis_cpu_id, $rack_id, $u_number);
    }
?>