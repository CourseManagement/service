<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    if (isset($_POST['user_name'])) {
        $flag = $_POST['flag'];
        $user_name = $_POST['user_name'];
        require_once 'include/mysqlconnect.php';
        switch ($flag) {
            case "1":
                $query = "select * from yardmanagement where user_name = '$user_name'";
                $return_flag = "y1";
                break;
            case "2":
                $query = "select * from departmanagement where user_name = '$user_name'";
                $return_flag = "y2";
                break;
            default:
                $query = "select * from teacher where user_name = '$user_name'";
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
                switch ($flag) {
                    case "1":
                        while ($result_row = mysql_fetch_row(($result))) {
                            $password = $result_row[2];
                            $name = $result_row[3];
                            $telephone = $result_row[4];
                            $result_arr = array(
                                "user_name" => $user_name,
                                "password" => $password,
                                "name" => $name,
                                "telephone" => $telephone
                            );
                        }
                        $return_flag = "y1";
                        break;
                    case "2":
                        while ($result_row = mysql_fetch_row(($result))) {
                            $password = $result_row[2];
                            $department = $result_row[3];
                            $result_arr = array(
                                "user_name" => $user_name,
                                "password" => $password,
                                "department" => $department
                            );
                        }
                        $return_flag = "y2";
                        break;
                    default:
                        while ($result_row = mysql_fetch_row(($result))) {
                            $password = $result_row[2];
                            $name = $result_row[3];
                            $department = $result_row[4];
                            $email = $result_row[5];
                            $telephone = $result_row[6];
                            $sex = $result_row[7];
                            $birthday = $result_row[8];
                            $result_arr = array(
                                "user_name" => $user_name,
                                "password" => $password,
                                "name" => $name,
                                "department" => $department,
                                "email" => $email,
                                "telephone" => $telephone,
                                "sex" => $sex,
                                "birthday" => $birthday
                            );
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