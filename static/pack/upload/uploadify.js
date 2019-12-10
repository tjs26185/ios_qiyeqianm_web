var xhr;var ot;var oloaded;function uploadify(){var upfile=$("#uploadify")[0].files[0];if(upfile.size>in_size*1048576){$(".uploadifyError").show().text("上传失败，大小不能超过"+in_size+"MB！");return false;}
if(upfile.size<1024){var _size=upfile.size+"b";}else if(upfile.size<1048576){var _size=Math.floor(upfile.size/1024)+"kb";}else{var _fixed=upfile.size/1048576;var _size=_fixed.toFixed(2)+"MB";}
if(upfile.name.length>10){var _name=upfile.name.substr(0,10)+"...";}else{var _name=upfile.name;}
$(".uploadifyError").hide();$(".uploadifySuccess").show();$(".fileName").text(_name+"("+_size+")");var fd=new FormData();fd.append("file",upfile);fd.append("post",in_post);xhr=new XMLHttpRequest();xhr.open("post",in_php);xhr.onload=complete;xhr.onerror=failed;xhr.upload.onprogress=progress;xhr.upload.onloadstart=function(evt){ot=new Date().getTime();oloaded=0;};xhr.send(fd);}
function progress(evt){var nt=new Date().getTime();var pertime=(nt-ot)/1e3;ot=new Date().getTime();var perload=evt.loaded-oloaded;oloaded=evt.loaded;var speed=perload/pertime;var units="b/s";if(speed/1024>1){speed=speed/1024;units="k/s";}
if(speed/1024>1){speed=speed/1024;units="M/s";}
speed=speed.toFixed(1);var per=Math.round(evt.loaded/evt.total*100);$(".uploadifyProgressBar").css("width",per+"%");$(".percentage").text(" - "+per+"% - "+speed+units);if(per>99){$(".percentage").text(" 正在保存,请稍等...");}}
function complete(evt){var response=evt.target.responseText;return_response(response);}
function failed(){$(".uploadifySuccess").hide();$(".uploadifyError").show().text("上传异常，请重试！");}
function cancle(){xhr.abort();$(".uploadifySuccess").fadeOut(1e3,function(){$(".uploadifyError").show().text("已取消上传");});}