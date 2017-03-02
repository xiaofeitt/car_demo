<?php
$appid = "wx6bb2e72c910b8a21";
$appsecret = "f05e0a6dc13abf957b1f9072113fccf8";
require_once "jssdk.php";
$jssdk = new JSSDK($appid, $appsecret);
$signPackage = $jssdk->GetSignPackage();
?>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

    wx.config({
        //debug:false 就是不弹出alert测试框
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            "onMenuShareTimeline"

        ]
    });
    wx.ready(function () {
        // 在这里调用 API
//        alert("有反应");
        wx.onMenuShareTimeline({
            title: '开车啦', // 分享标题
            link: 'http://xiaofei111.applinzi.com/20170110carhidden/index1.php&response_type=code&scope=snsapi_userinfo#wechat_redirect', // 分享链接
            imgUrl: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1484143671881&di=7def2fca7a27f9a74ce413600c9d646f&imgtype=0&src=http%3A%2F%2Fimg01.taopic.com%2F160328%2F240423-16032Q0012441.jpg', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });


    });

</script>
