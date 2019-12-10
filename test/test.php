<?php
    function curl_form($post_data,$sumbit_url,$http_url){
        //初始化
        $ch = curl_init();
        //设置变量
        curl_setopt($ch, CURLOPT_URL, $sumbit_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_HEADER, 0);//参数设置，是否显示头部信息，1为显示，0为不显示
        curl_setopt($ch, CURLOPT_REFERER, $http_url); 
        //表单数据，是正规的表单设置值为非0
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);//设置curl执行超时时间最大是多少
        //使用数组提供post数据时，CURL组件大概是为了兼容@filename这种上传文件的写法，
        //默认把content_type设为了multipart/form-data。虽然对于大多数web服务器并
        //没有影响，但是还是有少部分服务器不兼容。本文得出的结论是，在没有需要上传文件的
        //情况下，尽量对post提交的数据进行http_build_query，然后发送出去，能实现更好的兼容性，更小的请求数据包。
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //执行并获取结果
        $output = curl_exec($ch);
        //if($outopt === FALSE){
           echo "cUrl Error:".curl_error($ch);
        //}
        //    释放cURL句柄
        curl_close($ch); 
    }
    $furl = "zhengshu.p12";//证书
    $furl1 = "EP.mobileprovision";//描述文件
     $post_data = array (
        "password"=>"fxqun771341322",
        "file[provision]" => $furl,
		"file[cert]"=>$furl1
     );
    $sumbit_url = "https:\/\/www.pgyer.com\/tools\/certificate"; 
    $http_url="https:\/\/www.pgyer.com";
    curl_form($post_data,$sumbit_url,$http_url);
?>