<?php
/**
 * 功能：接收网站参数 并创建订单
 * 版本：4.4
 * 修改日期：2018-3-27
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究接口使用，只是提供一个参考。
 *
 *
 *************************注意*****************
 * 如果您是软件版您必须制作并先上传收款码或者是金额的二维码。 否则提示无二维码
 * 1、支付宝二维码制作教程：http://codepay.fateqq.com:52888/help/rknXG3lFx.html
 * 2、微信二维码制作教程：http://codepay.fateqq.com:52888/help/ByLyU3bFl.html
 * 其他操作教程：http://codepay.fateqq.com:52888/help/web/
 *
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心：http://codepay.fateqq.com:52888/apiword/
 *2、商户帮助中心：http://codepay.fateqq.com:52888/help/
 *3、联系客服：http://codepay.fateqq.com:52888/msg.html
 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
 **********************************************
 */
//ob_clean(); //清空缓冲区 防止UTF-8 BOM头报错
//session_start(); //开启session
require_once("codepay_config.php"); //导入配置文件

/**
 * 接收表单的数据 无需改动
 * 需要注意：pay_id 云端限制字符长度为100；太长会返回too long错误
 */


if (empty($_POST)) $_POST = $_GET; //如果为GET方式访问


$user = $_POST['user'];//提交的用户  也可以去session或者cookie中取登录用户 $_SESSION['uid']
$pay_id = $user; //网站唯一标识 需要充值的用户名，用户ID或者自行创建订单 建议传递用户的ID


$price = (float)$_POST["price"]; //提交的价格

$param = $_POST['param']; //自定义参数  可以留空 传递什么返回什么 用于区分游戏分区或用户身份

$type = (int)$_POST["type"]; //支付方式

if ($type < 1) $type = 1; //默认支付方式 支付宝


if ($price <= 0) $price = (float)$_POST["money"]; //如果没提供自定义输入金额则使用money参数

$codepay_path = $codepay_config['path']; //设置codepay静态资源使用路径

/**
 *
 * 增加付款记录到数据库的方法演示代码
 * require_once("includes/MysqliDb.class.php");//导入mysqli连接
 * require_once("includes/M.class.php");//导入mysqli操作类
 * $m=new M(); //创建连接数据库类
 *
 * //以下4个参数是为了演示向数据库插入记录
 * $pay_no=time();
 * $pay_time=time();
 * $creat_time=time();
 * $status=0;
 *
 * $sql="INSERT INTO `codepay_order` (`pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`)values(?,?,?,?,?,?,?,?,?,?)";
 * $rs = $m->execSQL( $sql, array('sddissisii', $pay_id, $price, $price, $type, $pay_no, $param, $pay_time, $pay_tag, $status, $creat_time), true); //$rs返回是否执行成功 true表示返回是否成功
 *
 *
 * 查询1条信息演示代码
 * $order_id=$_GET['order_id'];
 * $sql="select * from `codepay_order` where pay_no=?";
 * $rs = $m->getOne( $sql, array('s', $order_id), false); //$rs返回查询到的结果 没有结果则返回false
 *
 *
 */


if ($price < $codepay_config['min']) exit('最低限制' . $codepay_config['min'] . '元'); //检查最低限制

$price = number_format($price, 2, '.', '');// 四舍五入只保留2位小数。

if (empty($codepay_config) || (int)$codepay_config['id'] <= 1) {
    exit('请修改配置文件codepay_config.php  或进入<a href="install.php">install.php</a> 安装码支付接口测试数据');
}


/**
 * 一些防攻击的方法 需要先session_start();
 * 3秒内禁止刷新页面
 * 验证表单是否合法
 */

//$_SESSION["codepay_count"] += 1;
//if ($_SESSION["codepay_count"] > 20 || ($_SESSION["codepay_endTime"] + 3) > time()) {
//    $_SESSION["codepay_count"] = 0;
//    exit("您的操作太频繁请 <a href='javascript:history.go(-1);'>返回重试</a><script>setTimeout(function() {
//  history.back(-1)
//},3000);</script>");
//}
//$_SESSION["endTime"] = time();
//
//$salt = $_POST["salt"]; //验证表单合法性的参数
//
//if ($salt <> md5($_SESSION["uuid"])) exit('表单验证失败 请重新提交'); //防止跨站攻击


if (empty($pay_id)&&empty($_POST['pay_id'])) exit('需要充值的用户唯一标识不能为空'); //唯一用户标识 不能为空 如果是登录状态可以直接取session中的ID或用户名

if ($codepay_config['pay_type'] == 1 && $type == 1) $codepay_config["qrcode_url"] = ''; //支付宝默认不走本地化二维码


//获取客户端IP地址
function getIp()
{ //取IP函数
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $realip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            $realip = getenv('HTTP_CLIENT_IP') ? getenv('HTTP_CLIENT_IP') : getenv('REMOTE_ADDR');
        }
    }
    return $realip;
}


/**
 * 这里可以自行创建站内订单将用户提交的数据保存到数据库生成订单号
 *
 * 嫌麻烦pay_id直接传送用户ID或用户名(中文用户名请确认编码一致)
 * 我们支持GBK,gb2312,utf-8 如发送中文遇到编码困扰无法解决 可以尽量使用UTF-8
 * 万能解决方法：base64或者urlencode加密后发送我们. 处理业务的时候转回来
 */
//构造要请求的参数数组，无需改动
if($_POST['sign']){ //来自代理网关 验证签名
    ksort($_POST); //排序post参数
    reset($_POST); //内部指针指向数组中的第一个元素

    $sign = ''; //加密字符串初始化

    foreach ($_POST AS $key => $val) {
        if ($val == '' || $key == 'sign') continue; //跳过这些不签名
        if ($sign) $sign .= '&'; //第一个字符串签名不加& 其他加&连接起来参数
        $sign .= "$key=$val"; //拼接为url参数形式
    }
    if (md5($sign .  $codepay_config['key']) != $_POST['sign']) { //不合法的数据
        exit('签名验证失败');
    }else{
        $parameter = $_POST; //验证签名成功后使用传入的参数 作为代理
    }
}else{
    $parameter = array(
        "id" => (int)$codepay_config['id'],//平台ID号
        "type" => $type,//支付方式
        "price" => (float)$price,//原价
        "pay_id" => $pay_id, //可以是用户ID,站内商户订单号,用户名
        "param" => $param,//自定义参数
        "act" => (int)$codepay_config['act'],//此参数即将弃用
        "outTime" => (int)$codepay_config['outTime'],//二维码超时设置
        "page" => (int)$codepay_config['page'],//订单创建返回JS 或者JSON
        "return_url" => $codepay_config["return_url"],//付款后附带加密参数跳转到该页面
        "notify_url" => $codepay_config["notify_url"],//付款后通知该页面处理业务
        "style" => (int)$codepay_config['style'],//付款页面风格
        "pay_type" => $codepay_config['pay_type'],//支付宝使用官方接口
        "user_ip" => getIp(),//付款人IP
        "qrcode_url" => $codepay_config['qrcode_url'],//本地化二维码
        "chart" => trim(strtolower($codepay_config['chart']))//字符编码方式
        //其他业务参数根据在线开发文档，添加参数.文档地址:https://codepay.fateqq.com/apiword/
        //如"参数名"=>"参数值"
    );
}


//简单的创建订单方式
//ksort($parameter); //重新排序$data数组
//reset($parameter); //内部指针指向数组中的第一个元素
//
//$sign = ''; //初始化需要签名的字符为空
//$urls = ''; //初始化URL参数为空
//
//foreach ($parameter AS $key => $val) { //遍历需要传递的参数
//    if ($val == ''||$key == 'sign') continue; //跳过这些不参数签名
//    if ($sign != '') { //后面追加&拼接URL
//        $sign .= "&";
//        $urls .= "&";
//    }
//    $sign .= "$key=$val"; //拼接为url参数形式
//    $urls .= "$key=" . urlencode($val); //拼接为url参数形式并URL编码参数值
//
//}
//$query = $urls . '&sign=' . md5($sign .$codepay_config['key']); //创建订单所需的参数
//$url = "http://api2.fateqq.com:52888/creat_order/?{$query}"; //支付页面
//
//header("Location:{$url}"); //跳转到支付页面


/**
 * 加密函数
 * @param $params 需要加密的数组
 * @param $codepay_key //码支付密钥
 * @param string $host //使用哪个域名
 * @return array
 */
function create_link($params, $codepay_key, $host = "")
{
    ksort($params); //重新排序$data数组
    reset($params); //内部指针指向数组中的第一个元素
    $sign = '';
    $urls = '';
    foreach ($params AS $key => $val) {
        if ($val == '') continue;
        if ($key != 'sign') {
            if ($sign != '') {
                $sign .= "&";
                $urls .= "&";
            }
            $sign .= "$key=$val"; //拼接为url参数形式
            $urls .= "$key=" . urlencode($val); //拼接为url参数形式
        }
    }

    $key = md5($sign . $codepay_key);//开始加密
    $query = $urls . '&sign=' . $key; //创建订单所需的参数
    $apiHost = ($host ? $host : "http://api2.fateqq.com:52888/creat_order/?"); //网关
    $url = $apiHost . $query; //生成的地址
    return array("url" => $url, "query" => $query, "sign" => $sign, "param" => $urls);
}

$back = create_link($parameter, $codepay_config['key']);


switch ((int)$type) {
    case 1:
        $typeName = '支付宝';
        break;
    case 2:
        $typeName = 'QQ';
        break;
    default:
        $typeName = '微信';
}

//准备传给前端输出的JSON
$user_data = array(
    "return_url" => $parameter["return_url"],
    "type" => $parameter['type'],
    "outTime" => $parameter["outTime"],
    "codePay_id" => $parameter["id"],
    "out_trade_no" => $parameter["param"],
    "price" => $parameter['price'],
    'money'=>$parameter['price'],
    'order_id'=>$parameter["param"],
    "subject"=>'',//商品名字
); //传给网页JS去执行

$user_data["qrcode_url"] = $codepay_config["qrcode_url"]; //本地二维码控制器

//中间那logo 默认为2秒后隐藏
//改为自己的替换img目录下的use_开头的图片 你要保证你的二维码遮挡不会影响扫码
//二维码容错率决定你能遮挡多少部分
$user_data["logoShowTime"] = $user_data["qrcode_url"]?1:2*1000;

/**
 * 高级模式 云端创建订单。(注意不要外泄密钥key)
 * 可自行根据订单返回的参数做一些高级功能。 以下demo只是简单的功能 其他需要自行开发
 * 比如根据money type 参数调用本地的二维码图片。
 * 比如根据云端订单状态创建失败 展示自定义转账的二维码。
 * 比如可自行开发付款后的同步通知实现。
 * 比如可自行开发软件端某个支付方式掉线。 自动停用该付款方式。
 * 如使用云端同步通知  请附带必要的参数 码支付的用户id,pay_id,type,money,order_id,tag,notiry_key
 * 必须将notiry_key参数返回 因为该参数为服务解密参数(会随时变化)。否则影响云端同步通知
 */

if ($parameter['page'] != 3) { //只要不为3 返回JS 就去服务器加载资源
    $parameter['page'] = "4"; //设置返回JSON
    $back = create_link($parameter, $codepay_config['key'], $codepay_config['gateway']); //生成支付URL
    if (function_exists('file_get_contents')) { //如果开启了获取远程HTML函数 file_get_contents
        $codepay_json = file_get_contents($back['url']); //获取远程HTML
    } else if (function_exists('curl_init')) {
        $ch = curl_init(); //使用curl请求
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $back['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $codepay_json = curl_exec($ch);
        curl_close($ch);
    }
}

if (empty($codepay_json)) { //如果没有获取到远程HTML 则走JS创建订单
    $parameter['call'] = "callback";
    $parameter['page'] = "3";
    $back = create_link($parameter, $codepay_config['key'], 'https://codepay.fateqq.com/creat_order/?');
    $codepay_html = '<script src="' . $back['url'] . '"></script>'; //JS数据
} else { //获取到了JSON
    $codepay_data = json_decode($codepay_json);
    $qr = $codepay_data ? $codepay_data->qrcode : '';
    $codepay_html = "<script>callback({$codepay_json})</script>"; //JSON数据
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo $typeName ?>扫码支付</title>
    <link href="<?php echo $codepay_path ?>/css/wechat_pay.css" rel="stylesheet" media="screen">
    <link href="<?php echo $codepay_path?>/css/toastr.min.css" rel="stylesheet">
    <link href="<?php echo $codepay_path?>/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo $type ?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo $price ?></div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img id='show_qrcode' alt="加载中..." src="<?php echo $qr ?>" width="210" height="210"
                         style="display: block;">
                    <img onclick="$('#use').hide()" id="use"
                         src="<?php echo $codepay_path ?>/img/use_<?php echo $type ?>.png"
                         style="position: absolute;top: 50%;left: 50%;width:32px;height:32px;margin-left: -21px;margin-top: -21px">
                </div>
            </div>


        </div>
        <!-- 这里可以输入你想要的提示!-->
        <div class="time-item" id="msg">
            <h1>二维码过期时间</h1>
            <strong id="hour_show">0时</strong>
            <strong id="minute_show">0分</strong>
            <strong id="second_show">0秒</strong>
        </div>

        <div class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用<?php echo $typeName ?>扫一扫</p>
                <p>扫描二维码完成支付</p>
                <p><div id="kf" ></div></p>
            </div>
        </div>

        <div class="detail" id="orderDetail">
            <dl class="detail-ct" id="desc" style="display: none;">

                <dt>状态</dt>
                <dd id="createTime">订单创建</dd>

            </dl>
            <a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在<?php echo $typeName ?>扫一扫中选择“相册”即可</p>
        </div>
    </div>

</div>
<div class="copyRight">

</div>

<!--注意下面加载顺序 顺序错乱会影响业务-->
<script src="<?php echo $codepay_path ?>/js/jquery-1.10.2.min.js"></script>
<!--[if lt IE 8]>
<script src="<?php echo $codepay_path ?>/js/json3.min.js"></script><![endif]-->
<script>
    var user_data =<?php echo json_encode($user_data);?>
</script>
<script src="<?php echo $codepay_path ?>/js/notify.js"></script>
<script src="<?php echo $codepay_path ?>/js/codepay_util.js"></script>
<?php echo $codepay_html; ?>
<script src="<?php echo $codepay_path?>/js/toastr.min.js"></script>
<script src="<?php echo $codepay_path?>/js/clipboard.min.js"></script>
<script>
    setTimeout(function () {
        $('#use').hide() //2秒后隐藏中间那LOGO
    }, user_data.logoShowTime || 2000);
    var clipboard = new Clipboard('.copy');
    clipboard.on('success', function (e) {
        toastr.success("复制成功,可扫码付款时候粘贴到金额栏付款");

    });
    clipboard.on('error', function(e) {
        document.querySelector('.copy');
        toastr.warning("复制失败,请记住下必须付款的金额 不能多不能少否则不能成功");
    });
</script>
</body>
</html>
