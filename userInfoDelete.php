<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    if (isset($_POST['user_name'])) {
        $flag = $_POST['flag'];
        $user_name = $_POST['user_name'];
        require_once 'include/mysqlconnect.php';
        switch ($flag) {
            case "1":
                $query = "delete from departmanagement where user_name = '$user_name'";
                $return_flag = "y2";
                break;
            default:
                $query = "delete from teacher where user_name = '$user_name'";
                $return_flag = "y3";
        }
        $result = mysql_query($query);
        if (! $result) {
            $return_flag = "n2";
            $result_arr = "";
        } else {
            if ($result === false) {
                $return_flag = "n4";
                $result_arr = "";
            } else {}
        }
        mysql_close($connection);
    } else {
        $return_flag = "n2";
        $result_arr = "";
    }
} else {
    $return_flag = "n2";
    $result_arr = "";
}
$return_arr = array(
    "return_flag" => $return_flag
);
echo json_encode($return_arr);
?>