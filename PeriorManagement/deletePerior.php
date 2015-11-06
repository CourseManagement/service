<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['periodid'])) {
    $periodid = $_POST['periodid'];
    include_once '../include/mysqlconnect.php';
    // 1
    $query = "delete from period where periodid = '$periodid'";
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
    $query = "drop table " . $periodid . "courseInfo";
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
    $query = "drop table " . $periodid . "selectInfo";
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
    $query = "delete from checks where periodid = '$periodid'";
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
