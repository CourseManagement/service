<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['periodid'])) {
    $periodid = $_POST['periodid'];
    include_once '../include/mysqlconnect.php';
    // 1
    $query = "insert into period(periodid,flag) values('$periodid',1);";
    $result = mysql_query($query);
    if (result === false) {
        $flag = n1;
        $arr = array(
            "flag" => $flag
        );
        echo json_encode($arr);
        exit();
    }
    // 2
    $query = "create table " . $periodid . "courseInfo as select * from course";
    $result = mysql_query($query);
    if (result === false) {
        $flag = n1;
        $arr = array(
            "flag" => $flag
        );
        echo json_encode($arr);
        exit();
    }
    // 3
    $query = "create table " . $periodid . "selectInfo as select * from selects";
    $result = mysql_query($query);
    if (result === false) {
        $flag = n1;
        $arr = array(
            "flag" => $flag
        );
        echo json_encode($arr);
        exit();
    }
    // 4
    $query = "insert into checks(situation,periodid,major) values
    (0,'$periodid','计算机(实验班)'),
    (0,'$periodid','计算机(卓越班)'),
    (0,'$periodid','计算机专业'),
    (0,'$periodid','软件工程专业'),
    (0,'$periodid','数学类(实验班)'),
    (0,'$periodid','数学类'),
    (0,'$periodid','网络工程专业'),
    (0,'$periodid','信息安全专业');";
    $result = mysql_query($query);
    if (result === false) {
        $flag = n1;
        $arr = array(
            "flag" => $flag
        );
        echo json_encode($arr);
        exit();
    }
    $flag = "y1";
    mysql_close($connection);
} else {
    $flag = "n1";
}
$arr = array(
    "flag" => $flag
);
echo json_encode($arr);
?>
