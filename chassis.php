<?php
    include_once 'shared/header.php';
?>
<br>
<form action="functions/addChassisForm.php" method="post">
    <label>Name:</label> <input type="text" name="number">
    <br><label>Height:</label> <input type="number" name="height">
    <br><label>Length:</label> <input type="number" name="length">
    <br><label>PSU Position:</label> <select name="psu_position">
        <option value=''>Choose a position</option>
        <option value='1'>Left</option>
        <option value='2'>Right</option>
        <option value='3'>Centre</option>
        <option value='4'>Both sides</option>
        <option value='5'>Other</option>
    </select>
    <br><button type="submit" name="submit">Add</button>
</form>
<br>
<table>
    <thead>
        <th>Name</th>
        <th>Height</th>
        <th>Length</th>
        <th>PSU position</th>
    </thead>
    <tbody>
        <?php
            $result = GetChassises($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<tr><td><a href=\"editChassis.php?id=" . $row['id'] . "\">" . $row['number'] . "</a></td>";
                echo "<td>" . $row['height'] . "</td>";
                echo "<td>" . $row['length'] . "</td>";
                echo "<td>";
                switch ($row['psu_position']) {
                    case 1:
                        echo "Left";
                        break;
                    case 2:
                        echo "Right";
                        break;
                    case 3:
                        echo "Centre";
                        break;
                    default:
                        echo "Other";
                }
                echo "</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php
    include_once 'shared/footer.php';
?>