<?php
		
		/*print_r($_POST);

	
        if ($_FILES["cert"]["error"] > 0)
        {
            echo "错误：" . $_FILES["cert"]["error"] . "<br>";
        }
        else
        {
            echo "上传文件名: " . $_FILES["cert"]["name"] . "<br>";
            echo "文件类型: " . $_FILES["cert"]["type"] . "<br>";
            echo "文件大小: " . ($_FILES["cert"]["size"] / 1024) . " kB<br>";
            echo "文件临时存储的位置: " . $_FILES["cert"]["tmp_name"];
        }*/

		$data = array (
		'password' => $_POST['password'], 
		'file[cert]' => $_FILES['cert'], 
		'file[provision]' =>$_FILES['provision']
		);
	
		//print_r($data);

	    function curl_form($post_data,$sumbit_url,$http_url){
        //初始化
        $ch = curl_init();
        //设置变量
        curl_setopt($ch, CURLOPT_URL, $sumbit_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type'=>'application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_HEADER, 1);//参数设置，是否显示头部信息，1为显示，0为不显示
        curl_setopt($ch, CURLOPT_REFERER, $http_url);
        //表单数据，是正规的表单设置值为非0
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);//设置curl执行超时时间最大是多少
        //使用数组提供post数据时，CURL组件大概是为了兼容@filename这种上传文件的写法，
        //默认把content_type设为了multipart/form-data。虽然对于大多数web服务器并
        //没有影响，但是还是有少部分服务器不兼容。本文得出的结论是，在没有需要上传文件的
        //情况下，尽量对post提交的数据进行http_build_query，然后发送出去，能实现更好的兼容性，更小的请求数据包。
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //执行并获取结果
        //    释放cURL句柄
        $response = curl_exec($ch);
		$err = curl_error($ch);
		 
		curl_close($ch);
		 
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
        
        return $data.$response;
    }
 

    $res = curl_form($data,'https://www.pgyer.com/tools/certificate','');
?>
