<?php
    include_once 'shared/header.php';
    
    if (isset($_GET["id"]) && ChassisExists($conn, $_GET["id"])) $chassis = GetChassis($conn, $_GET["id"]);
    else {
        echo "There is no matching chassis with this ID!";
        include 'shared/footer.php';
        exit();
    }
    
    echo "<br><form action=\"functions/editChassisForm.php\" method=\"post\">" .
            "<input type=\"hidden\" name=\"id\" value=\"" . $chassis['id'] . "\">" .
            "<label>Name:</label> <input type=\"text\" name=\"number\" value=\"" . $chassis['number'] . "\">" .
            "<br><label>Height:</label> <input style=\"width:96%;\" type=\"number\" name=\"height\" value=\"" . $chassis['height'] . "\">" .
            "<br><label>Length:</label> <input style=\"width:96%;\" type=\"number\" name=\"length\" value=\"" . $chassis['length'] . "\">" .
            "<br><label>PSU position:</label> <select name=\"psu_position\">";
                for ($counter = 1; $counter <= 4; $counter++) {
                    echo "<option value='" . $counter . "'";
                    if($chassis['psu_position'] == $counter) echo "selected=\"selected\"";
                    echo ">";
                    
                    switch ($counter) {
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
                    
                    echo "</option>";
                }
            echo "</select>" .
            "<br><button type=\"submit\" name=\"submit\">Edit</button>" .
        "</form>";
    
    include_once 'shared/footer.php';
?>