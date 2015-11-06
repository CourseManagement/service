<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    $flag = $_POST['flag'];
    require_once 'include/mysqlconnect.php';
    switch ($flag) {
        case "1":
            $query = "select * from departmanagement";
            $return_flag = "y2";
            break;
        default:
            $query = "select * from teacher";
            $return_flag = "y3";
    }
    $result = mysql_query($query);
    if (! $result) {
        $return_flag = "n2";
        $result_arr = "";
    } else {
        if (! mysql_num_rows($result)) {
            $return_flag = "n4";
            $result_arr = "";
        } else {
            $result_arr = array();
            switch ($flag) {
                case "1":
                    while ($result_row = mysql_fetch_row(($result))) {
                        $user_name = $result_row[1];
                        $password = $result_row[2];
                        $department = $result_row[3];
                        $tem_arr = array(
                            "user_name" => $user_name,
                            "password" => $password,
                            "department" => $department
                        );
                        array_push($result_arr, $tem_arr);
                    }
                    $return_flag = "y2";
                    break;
                default:
                    while ($result_row = mysql_fetch_row(($result))) {
                        $user_name = $result_row[1];
                        $password = $result_row[2];
                        $name = $result_row[3];
                        $department = $result_row[4];
                        $email = $result_row[5];
                        $telephone = $result_row[6];
                        $sex = $result_row[7];
                        $birthday = $result_row[8];
                        $tem_arr = array(
                            "user_name" => $user_name,
                            "password" => $password,
                            "name" => $name,
                            "email" => $email,
                            "telephone" => $telephone,
                            "sex" => $sex,
                            "birthday" => $birthday
                        );
                        array_push($result_arr, $tem_arr);
                    }
                    $return_flag = "y3";
            }
        }
    }
    mysql_close($connection);
} else {
    $return_flag = "n2";
    $result_arr = "";
}

$return_arr = array(
    "return_flag" => $return_flag,
    "result_arr" => $result_arr
);
echo json_encode($return_arr);
?>