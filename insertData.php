<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 17/1/11
 * Time: 上午11:34
 */

$username = $_POST["username"];
$count = $_POST["count"];

$mysqli = new mysqli(SAE_MYSQL_HOST_M,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB,SAE_MYSQL_PORT);
if ($mysqli->connect_errno){
    die($mysqli->connect_error);
}
//给当前用户的此次过障碍数进行排名
$mysqli->query("set names utf8");
$sql = "SELECT * FROM car";
$result = $mysqli->query($sql);
$arr = [];
while ($rows =  $result->fetch_assoc()){
    $arr[] = $rows;
}
//$index记录排名 $num记录总人数,即数据的条数
$index = count($arr);
$num = count($arr);
if (count($arr)!=0){
    //对原有数据库数据进行排名
    //冒泡排序 把$arr里的关联数组按,count的大小进行从大到小的排序
    for ($i=0;$i<count($arr) - 1;$i++){
        for ($j=0;$j<count($arr) - 1 - $i;$j++){
            if (intval($arr[$j]["count"])<intval($arr[$j+1]["count"])){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
    //给当前用户的此次过障碍数进行排名
    for ($i=0;$i<count($arr);$i++){
        if (intval($count)>intval($arr[$i]["count"])){
            $index = $i;
            break;
        }
    }

}
//如果数据库有该用户,则保留分数高的,没有就直接插入
//判断有没有该用户的数据
$isBool = false;
//即路该用户原始数据的位置
$inNum = 0;
if ($arr != 0){
    for ($i=0;$i<count($arr);$i++){
        if ($arr[$i]["username"] == $username){
            $isBool = true;
            $inNum = $i;
            break;
        }

    }
}

if ($isBool){
    if (intval($arr[$inNum]["count"]) < intval($count)){
        $sql1 = "UPDATE car SET count = '{$count}' WHERE username = '{$username}'";
       $mysqli->query($sql1);
    }
}else{
    $sql = "INSERT INTO car VALUES(NULL,'{$username}','{$count}')";
    $mysqli->query($sql);
}

$mysqli->close();

echo json_encode(["rank"=>$index,"total"=>$num,"count"=>$count]);