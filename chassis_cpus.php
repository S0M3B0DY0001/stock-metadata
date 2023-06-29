<?php
    include_once 'shared/header.php';
?>
<br>
<form action="functions/addChassis_cpuForm.php" method="post">
    <label>Chassis:</label> <select name="chassis_id"><option value=''>Choose a chassis</option>
        <?php
            $result = GetChassises($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['number'] . "</option>";
            }
        ?>
    </select>
    <br>
    <label>CPU:</label> <select name="cpu_id"><option value=''>Choose a CPU</option>
        <?php
            $result = GetCpus($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<option value='" . $row['id'] . "'>" . $row['number'] . "</option>";
            }
        ?>
    </select>
    <br>
    <label>Maximum power usage (Watt):</label> <input type="number" name="max_power_usage">
    <br>
    <button type="submit" name="submit">Add</button>
</form>
<br>
<table>
    <thead>
        <th>ID</th>
        <th>Chassis</th>
        <th>CPU</th>
        <th>Maximum power usage</th>
    </thead>
    <tbody>
        <?php
            $result = GetChassis_cpus($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<tr><td><a href=\"editChassis_cpu.php?id=" . $row['id'] . "\">" . $row['id'] . "</a></td>" .
                         "<td>" . GetChassis($conn, $row['chassis_id'])['number'] . "</td>" .
                         "<td>" . GetCpu($conn, $row['cpu_id'])['number'] . "</td>" .
                         "<td>" . $row['max_power_usage']*1000 . " Watt</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php
    include_once 'shared/footer.php';
?>