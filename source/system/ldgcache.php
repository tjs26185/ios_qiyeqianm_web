<?php
class LdgShortUrl
{
    public $redis = null;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1',6379);
        $this->redis->auth('');
    }
    function GetShortUrl($url)
    {
    	$short=$this->getData($url);
    	if(empty($short))
    	{
			$short=$this->GetShort($url);
			if(!empty($short))
			{
				$this->setData($url,$short);
			}
    	}
    	if(empty($short))
    	{
			return "暂无预览地址";
    	}
    	//return $short;
    	return $url;
    }
    public function GetShort($url){
    	$apiurl="http://vfh.dzzv.cn//dwz.php?dwzapi=3&longurl=".urlencode($url);
    	//$apiurl=$url;
    	$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept: text/html, application/xhtml+xml, */*\r\n" .
		              "ContentType: text/html\r\n".
		              "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 SE 2.X MetaSr 1.0
\r\n"
		  )
		);

		$context = stream_context_create($opts);
		$html= file_get_contents($apiurl, false, $context);
    
    	$data = json_decode($html,true);
    	
    	if($data)
    	{
    		if($data['dz_url'])
    		{
    			return $data['dz_url'];
    		}
    	}
    	return "";
    }
    public function getData($url)
    {
        //判断缓存的键是否还存在
        if(!$this->redis->exists("cache:".$url))
        {
        	return "";
            
        }
        $short = $this->redis->get("cache:".$url);
        return $short;
    }
    public function setData($url,$short)
    {
        //存入redis
        $this->redis->set("cache:".$url,$short);
        //设置过期时间24小时
        $this->redis->expire("cache:".$url,60*60*60*24);
    }
}
$shorturl=new LdgShortUrl();
?>