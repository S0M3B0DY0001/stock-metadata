<?php
    include_once 'shared/header.php';
    
    if (isset($_GET["id"]) && CpuExists($conn, $_GET["id"])) $cpu = GetCpu($conn, $_GET["id"]);
    else {
        echo "There is no matching cpu with this ID!";
        include 'shared/footer.php';
        exit();
    }
    
    echo "<br><form action=\"functions/editCpuForm.php\" method=\"post\">" .
             "<input type=\"hidden\" name=\"id\" value=\"" . $cpu['id'] . "\">" .
             "<label>Name:</label> <input type=\"text\" name=\"number\" value=\"" . $cpu['number'] . "\">" .
             "<br><label>Brand:</label> <input style=\"width:96%;\" type=\"text\" name=\"brand\" value=\"" . $cpu['brand'] . "\">" .
             "<br><button type=\"submit\" name=\"submit\">Edit</button>" .
         "</form>";
    
    include_once 'shared/footer.php';
?>