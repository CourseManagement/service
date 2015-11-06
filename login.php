<?php
if (isset($_POST['username'])) {
    if (isset($_POST['pswd'])) {
        $pswd = $_POST['pswd'];
        $username = $_POST['username'];
        require_once './include/mysqlconnect.php';
        switch (substr( $username, 0, 1 )) {
            case 'y':
                $query = "select password from yardmanagement where user_name = '$username'";
                $flag = "y1";
                break;
            case 'x':
                $query = "select password from departmanagement where user_name = '$username'";
                $flag = "y2";
                break;
            default:
                $query = "select password from teacher where user_name = '$username'";
                $flag = "y3";
        }
        $result = mysql_query($query); 
        if (! $result) { 
            $flag = "n2";
        } else {
            if (! mysql_num_rows($result)) { 
                $flag = "n4";
            } else {
                while ($result_row = mysql_fetch_row(($result))) { 
                    $mpswd = $result_row[0];
                    if (strcmp($pswd, $mpswd) == 0) { 
                    } else {
                        $flag = "n1";
                    }
                }
            }
        }
        mysql_close($connection); 
    } else {
        $flag = "n3";
    }
} else {
    $flag = "n3";
}
$arr = array("flag" => $flag);
echo json_encode($arr);
?>