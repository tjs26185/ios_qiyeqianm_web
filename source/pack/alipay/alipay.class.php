<?php
error_reporting(0);
class AlipayService
{
    protected $appId;
    protected $returnUrl;
    protected $notifyUrl;
    protected $charset;
    protected $signType;
    protected $privateKey;
    public function __construct($appid, $returnUrl, $notifyUrl, $signType, $privateKey)
    {
        $this->appId = $appid;
        $this->returnUrl = $returnUrl;
        $this->notifyUrl = $notifyUrl;
        $this->charset = 'utf8';
        $this->signType = $signType;
        $this->privateKey = $privateKey;
    }
    public function doPay($totalFee, $outTradeNo, $orderName, $returnUrl, $notifyUrl)
    {
        $requestConfigs = array('partner' => $this->appId, 'service' => 'create_direct_pay_by_user', '_input_charset' => strtolower($this->charset), 'sign_type' => strtoupper($this->signType), 'return_url' => $returnUrl, 'notify_url' => $notifyUrl, 'out_trade_no' => $outTradeNo, 'total_fee' => $totalFee, 'subject' => $orderName, 'payment_type' => 1, 'seller_id' => $this->appId);
        return $this->buildRequestForm($requestConfigs);
    }
    function buildRequestForm($para_temp)
    {
        $para = $this->buildRequestPara($para_temp);
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='https://mapi.alipay.com/gateway.do?_input_charset=" . trim(strtolower($this->charset)) . "' method='post'>";
        while (list($key, $val) = each($para)) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }
        $sHtml = $sHtml . "<input type='submit'  value='提交' style='display:none;'></form>";
        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";
        return $sHtml;
    }
    function buildRequestPara($para_temp)
    {
        $para_filter = $this->paraFilter($para_temp);
        $para_sort = $this->argSort($para_filter);
        $mysign = $this->buildRequestMysign($para_sort);
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = strtoupper(trim($this->signType));
        return $para_sort;
    }
    function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }
    private function buildRequestMysign($para_sort)
    {
        $prestr = $this->createLinkstring($para_sort);
        $mysign = "";
        switch (strtoupper(trim($this->signType))) {
            case "MD5":
                $mysign = $this->md5Sign($prestr, $this->privateKey);
                break;
            case "RSA":
            default:
                $mysign = $this->rsaSign($prestr, $this->privateKey);
                break;
        }
        return $mysign;
    }
    private function rsaSign($data, $private_key)
    {
        $private_key = str_replace("-----BEGIN RSA PRIVATE KEY-----", "", $private_key);
        $private_key = str_replace("-----END RSA PRIVATE KEY-----", "", $private_key);
        $private_key = str_replace("\n", "", $private_key);
        $private_key = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($private_key, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";
        $res = openssl_get_privatekey($private_key);
        if ($res) {
            openssl_sign($data, $sign, $res);
        } else {
            echo "您的私钥格式不正确!" . "<br/>" . "The format of your private_key is incorrect!";
            exit;
        }
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }
    function md5Sign($prestr, $key)
    {
        $prestr = $prestr . $key;
        return md5($prestr);
    }
    private function createLinkstring($para)
    {
        $arg = "";
        while (list($key, $val) = each($para)) {
            $arg .= $key . "=" . $val . "&";
        }
        $arg = substr($arg, 0, count($arg) - 2);
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }
    private function paraFilter($para)
    {
        $para_filter = array();
        while (list($key, $val) = each($para)) {
            if ($key == "sign" || $key == "sign_type" || $val == "") {
                continue;
            } else {
                $para_filter[$key] = $para[$key];
            }
        }
        return $para_filter;
    }
}
?>