<?php
    include_once 'shared/header.php';
?>
<br>
<form action="functions/addServerForm.php" method="post">
    <label>Name:</label> <input type="text" name="number">
    <br>
    <label>Service tag:</label> <input type="text" name="service_tag">
    <br>
    <label>Chassis and CPU:</label> <select name="chassis_cpu_id"><option value=''>Choose a chassis and CPU</option>
        <?php
            $result = GetChassis_cpus($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . GetChassis($conn, $row['chassis_id'])['number'] . " - " . GetCpu($conn, $row['cpu_id'])['number'] . "</option>";
            }
        ?>
    </select>
    <br>
    <label>Rack:</label> <select name="rack_id"><option value=''>Choose a Rack</option>
        <?php
            $result = GetRacks($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['number'] . "</option>";
            }
        ?>
    </select>
    <br>
    <label>U number in rack:</label> <input type="number" name="u_number">
    <br>
    <button type="submit" name="submit">Add</button>
</form>
<br>
<table>
    <thead>
        <th>Name</th>
        <th>Service tag</th>
        <th>Chassis and CPU</th>
        <th>Rack</th>
        <th>U number in rack</th>
    </thead>
    <tbody>
        <?php
            $result = GetServers($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<tr><td><a href=\"editServer.php?id=" . $row['id'] . "\">" . $row['number'] . "</a></td>" .
                         "<td>" . $row['service_tag'] . "</td>" .
                         "<td>" . GetChassis($conn, GetChassis_cpu($conn, $row['chassis_cpu_id'])['chassis_id'])['number'] . " - " . GetCpu($conn, GetChassis_cpu($conn, $row['chassis_cpu_id'])['id'])['number'] . "</td>" .
                         "<td>" . GetRack($conn, $row['rack_id'])['number'] . "</td>" .
                         "<td>" . $row['u_number'] . "</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php
    include_once 'shared/footer.php';
?>