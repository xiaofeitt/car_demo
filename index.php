<?php
/**
 * Created by PhpStorm.
 * User: dllo
 * Date: 17/1/12
 * Time: 下午4:40
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        html,body{
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<iframe src="" frameborder="0" id="ifr"></iframe>
<script type="text/javascript">
    var ifr = document.getElementById("ifr");
    ifr.width = document.body.clientWidth;
    ifr.height = document.body.clientHeight;
    one();
    function one() {
        ifr.src = "1.html";
    }
    function two() {
        ifr.src = "2.html";
    }

</script>

</body>
</html>
