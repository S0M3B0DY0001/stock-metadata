<?php
    include_once 'shared/header.php';
?>
<br>
<form action="functions/addCpuForm.php" method="post">
    <label>Name:</label> <input type="text" name="number">
    <br><label>Brand:</label> <input type="text" name="brand">
    <br><button type="submit" name="submit">Add</button>
</form>
<br>
<table>
    <thead>
        <th>Name</th>
        <th>Brand</th>
    </thead>
    <tbody>
        <?php
            $result = GetCpus($conn);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                echo "<tr><td><a href=\"editCpu.php?id=" . $row['id'] . "\">" . $row['number'] . "</a></td>";
                echo "<td>" . $row['brand'] . "</td></tr>";
            }
        ?>
    </tbody>
</table>

<?php
    include_once 'shared/footer.php';
?>