<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 17/1/11
 * Time: 下午3:34
 */

$username = $_POST["username"];

$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
if ($mysqli->connect_errno){
    die($mysqli->connect_error);
}

//查询数据库所有数据并排序
$mysqli->query("set names utf8");
$sql = "SELECT * FROM car";
$result = $mysqli->query($sql);
$arr = [];
while ($rows =  $result->fetch_assoc()){
    $arr[] = $rows;
}
//排序
for ($i=0;$i<count($arr) - 1;$i++){
    for ($j=0;$j<count($arr) - 1 - $i;$j++){
        if (intval($arr[$j]["count"])<intval($arr[$j+1]["count"])){
            $temp = $arr[$j];
            $arr[$j] = $arr[$j+1];
            $arr[$j+1] = $temp;
        }
    }
}
//找到当前用户的位置
$indexNum = 0;
for ($i=0;$i<count($arr);$i++){
    if ($username == $arr[$i]["username"]){
        $indexNum = $i+1;
        //当前用户过的历史障碍数
        $count = $arr[$i]["count"];
        $arr[] = ["indexNum"=>$indexNum,"count"=>$count,"username"=>$username];
        break;
    }
}


$mysqli->close();
echo json_encode($arr);