<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    if (isset($_POST['info'])) {
        $flag = $_POST['flag'];
        $info = stripslashes($_POST['info']);
        $arr = json_decode($info, true);
        if ($arr == null) {
            $flag = "n1";
        } else {
            require_once 'include/mysqlconnect.php';
            switch ($flag) {
                // UPDATE Person SET Address = 'Zhongshan 23', City = 'Nanjing'
                // WHERE LastName = 'Wilson'
                case "1":
                    $user_name = $arr["user_name"];
                    $password = $arr["password"];
                    $name = $arr["name"];
                    $telephone = $arr["telephone"];
                    $query = "update yardmanagement set password = '$password',name = '$name',telephone = '$telephone' where user_name = '$user_name'";
                    $return_flag = "y1";
                    break;
                case "2":
                    $user_name = $arr["user_name"];
                    $password = $arr["password"];
                    $department = $arr["department"];
                    $query = "update departmanagement set 
                    password = '$password',
                    department = '$department' 
                    where user_name = '$user_name'";
                    $return_flag = "y2";
                    break;
                default:
                    $user_name = $arr["user_name"];
                    $password = $arr["password"];
                    $name = $arr["name"];
                    $department = $arr['department'];
                    $email = $arr["email"];
                    $telephone = $arr["telephone"];
                    $sex = $arr["sex"];
                    $birthday = $arr["birthday"];
                    $query = "update teacher set 
                    password = '$password',
                    name = '$name', 
                    department = '$department' ,
                    email = '$email',
                    telephone = '$telephone',
                    sex = '$sex',
                    birthday = '$birthday' 
                    where user_name = '$user_name'";
                    $return_flag = "y3";
            }
            $result = mysql_query($query);
            if ($result == false || mysql_affected_rows($connection) == 0) {
                $return_flag = "n2";
            } else {}
            mysql_close($connection);
        }
    } else {
        $return_flag = "n1";
    }
} else {
    $return_flag = "n1";
}
$return_arr = array(
    "return_flag" => $return_flag
);
echo json_encode($return_arr);
?>