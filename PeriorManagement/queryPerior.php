<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['flag'])) {
    $return_flag = $_POST['flag'];
    include_once '../include/mysqlconnect.php';
    if($return_flag != "1"){
        $flag = n1;
        $result_arr = array();
        $arr = array(
            "return_flag" => $return_flag,
            "result_arr" => $result_arr
        );
        echo json_encode($arr);
        exit();
    }
    // 1
    $result_arr = array();
    $query = "select * from period";
    $result = mysql_query($query);
    while ($result_row = mysql_fetch_row(($result))) {
        $periodid = $result_row[0];
        $flag = $result_row[3];
        $tem_arr = array(
            "periodid" => $periodid,
            "flag" => $flag,
        );
        array_push($result_arr, $tem_arr);
    }
    $return_flag = "y1"; 
    mysql_close($connection);
} else {
    $flag = "n1";
    $result_arr = array();
    $arr = array(
        "return_flag" => $return_flag,
        "result_arr" => $result_arr
    );
    echo json_encode($arr);
    exit();
}
$arr = array(
    "return_flag" => $return_flag,
    "result_arr" => $result_arr
);
echo json_encode($arr);
?>
