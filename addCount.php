<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    if (isset($_POST['info'])) {
        $tab = $_POST['flag'];
        $info = stripslashes($_POST['info']);
        //echo $info;
        $arr = json_decode($info,true);
       // print_r($arr);
        if($arr == null){
            $flag = "n3";
        } else {
            include_once 'include/mysqlconnect.php';
            
           // print_r($arr);
            switch ($tab){
                case "1":
                    $user_name = $arr["user_name"];
                    $password = $arr["password"];
                    $department = $arr["department"];
                    $query = "insert into departmanagement(user_name,password,department) values('$user_name','$password','$department')";
                    //echo $query; //for test
                    break;
                default:
                    $query = "insert into teacher(user_name,password,name) values";
                    foreach ($arr as $temarr){
                        $user_name = $temarr["user_name"];
                        $password = $temarr["password"];
                        $name = $temarr["name"];
                        $temqury = "('$user_name','$password','$name'),";
                        $query .= $temqury;
                    }
                    $query = substr($query,0,-1);
                    $query .= ";";
                   // echo $query; //for test
            }
            $result = mysql_query($query);
            if($result === true){
                $flag = "y1";
            } else {
                $flag = "n1";
            }
            mysql_close($connection); 
        }
    } else {
        $flag = "n2";
    }
} else {
    $flag = "n2"; 
}
$arr = array("flag" => $flag);
echo json_encode($arr);
?>