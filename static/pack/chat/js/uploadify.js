if(jQuery){(function(a){a.extend(a.fn,{uploadify:function(b){a(this).each(function(){settings=a.extend({id:a(this).attr("id"),uploader:"uploadify.swf",script:"uploadify.php",expressInstall:null,folder:"",height:30,width:110,cancelImg:"cancel.png",wmode:"opaque",scriptAccess:"sameDomain",fileDataName:"Filedata",method:"POST",queueSizeLimit:999,simUploadLimit:1,queueID:false,displayData:"percentage",onInit:function(){},onSelect:function(){},onQueueFull:function(){},onCheck:function(){},onCancel:function(){},onError:function(){},onProgress:function(){},onComplete:function(){},onAllComplete:function(){}},b);var e=location.pathname;e=e.split("/");e.pop();e=e.join("/")+"/";var f={};f.uploadifyID=settings.id;f.pagepath=e;if(settings.buttonImg){f.buttonImg=escape(settings.buttonImg);}
if(settings.buttonText){f.buttonText=escape(settings.buttonText);}
if(settings.rollover){f.rollover=true;}
f.script=settings.script;f.folder=escape(settings.folder);if(settings.scriptData){var g="";for(var d in settings.scriptData){g+="&"+d+"="+settings.scriptData[d];}
f.scriptData=escape(g.substr(1));}
f.width=settings.width;f.height=settings.height;f.wmode=settings.wmode;f.method=settings.method;f.queueSizeLimit=settings.queueSizeLimit;f.simUploadLimit=settings.simUploadLimit;if(settings.hideButton){f.hideButton=true;}
if(settings.fileDesc){f.fileDesc=settings.fileDesc;}
if(settings.fileExt){f.fileExt=settings.fileExt;}
if(settings.multi){f.multi=true;}
if(settings.auto){f.auto=true;}
if(settings.sizeLimit){f.sizeLimit=settings.sizeLimit;}
if(settings.checkScript){f.checkScript=settings.checkScript;}
if(settings.fileDataName){f.fileDataName=settings.fileDataName;}
if(settings.queueID){f.queueID=settings.queueID;}
if(settings.onInit()!==false){a(this).css("display","none");a(this).after('<div id="'+a(this).attr("id")+'Uploader"></div>');swfobject.embedSWF(settings.uploader,settings.id+"Uploader",settings.width,settings.height,"9.0.24",settings.expressInstall,f,{quality:"high",wmode:settings.wmode,allowScriptAccess:settings.scriptAccess});if(settings.queueID==false){a("#"+a(this).attr("id")+"Uploader").after('<div id="'+a(this).attr("id")+'Queue" class="uploadifyQueue"></div>');}}
if(typeof settings.onOpen=="function"){a(this).bind("uploadifyOpen",settings.onOpen);}
a(this).bind("uploadifySelect",{action:settings.onSelect,queueID:settings.queueID},function(j,h,i){if(j.data.action(j,h,i)!==false){var k=Math.round(i.size/1024*100)*.01;var l="KB";if(k>1e3){k=Math.round(k*.001*100)*.01;l="MB";}
var m=k.toString().split(".");if(m.length>1){k=m[0]+"."+m[1].substr(0,2);}else{k=m[0];}
if(i.name.length>10){fileName=i.name.substr(0,10)+"...";}else{fileName=i.name;}
queue="#"+a(this).attr("id")+"Queue";if(j.data.queueID){queue="#"+j.data.queueID;}
a(queue).html(fileName+" ("+k+l+')<span id="percentage"></span><a class="cancel_title_btn cancel_btn" title="取消" onclick="jQuery(\'#'+a(this).attr("id")+"').uploadifyCancel('"+h+"')\"></a>");}});if(typeof settings.onSelectOnce=="function"){a(this).bind("uploadifySelectOnce",settings.onSelectOnce);}
a(this).bind("uploadifyQueueFull",{action:settings.onQueueFull},function(h,i){if(h.data.action(h,i)!==false){alert("The queue is full.  The max size is "+i+".");}});a(this).bind("uploadifyCheckExist",{action:settings.onCheck},function(m,l,k,j,o){var i=new Object();i=k;i.folder=e+j;if(o){for(var h in k){var n=h;}}
a.post(l,i,function(r){for(var p in r){if(m.data.action(m,l,k,j,o)!==false){var q=confirm("Do you want to replace the file "+r[p]+"?");if(!q){document.getElementById(a(m.target).attr("id")+"Uploader").cancelFileUpload(p,true,true);}}}
if(o){document.getElementById(a(m.target).attr("id")+"Uploader").startFileUpload(n,true);}else{document.getElementById(a(m.target).attr("id")+"Uploader").startFileUpload(null,true);}},"json");});a(this).bind("uploadifyCancel",{action:settings.onCancel},function(l,h,k,m,j){if(l.data.action(l,h,k,m,j)!==false){var i=j==true?0:250;a("#send_tips").fadeOut(i,function(){a(this).show().text("按 Enter 键快捷发送");});}});if(typeof settings.onClearQueue=="function"){a(this).bind("uploadifyClearQueue",settings.onClearQueue);}
var c=[];a(this).bind("uploadifyError",{action:settings.onError},function(l,h,k,j){if(l.data.action(l,h,k,j)!==false){var i=new Array(h,k,j);c.push(i);a("#percentage").text(" - "+j.type+" Error");}});a(this).bind("uploadifyProgress",{action:settings.onProgress,toDisplay:settings.displayData},function(j,h,i,k){if(j.data.action(j,h,i,k)!==false){if(j.data.toDisplay=="percentage"){displayData=" - "+k.percentage+"% - "+k.speed+"KB/s";}
if(j.data.toDisplay=="speed"){displayData=" - "+k.speed+"KB/s";}
if(j.data.toDisplay==null){displayData=" ";}
if(k.percentage>99){displayData=" 正在保存,请稍等...";}
a("#percentage").text(displayData);}});a(this).bind("uploadifyComplete",{action:settings.onComplete},function(k,h,j,i,l){if(k.data.action(k,h,j,unescape(i),l)!==false){a("#percentage").text(" - Completed");}});if(typeof settings.onAllComplete=="function"){a(this).bind("uploadifyAllComplete",{action:settings.onAllComplete},function(h,i){if(h.data.action(h,i)!==false){c=[];}});}});},uploadifySettings:function(f,j,c){var g=false;a(this).each(function(){if(f=="scriptData"&&j!=null){if(c){var i=j;}else{var i=a.extend(settings.scriptData,j);}
var l="";for(var k in i){l+="&"+k+"="+escape(i[k]);}
j=l.substr(1);}
g=document.getElementById(a(this).attr("id")+"Uploader").updateSettings(f,j);});if(j==null){if(f=="scriptData"){var b=unescape(g).split("&");var e=new Object();for(var d=0;d<b.length;d++){var h=b[d].split("=");e[h[0]]=h[1];}
g=e;}
return g;}},uploadifyUpload:function(b){a(this).each(function(){document.getElementById(a(this).attr("id")+"Uploader").startFileUpload(b,false);});},uploadifyCancel:function(b){a(this).each(function(){document.getElementById(a(this).attr("id")+"Uploader").cancelFileUpload(b,true,false);});},uploadifyClearQueue:function(){a(this).each(function(){document.getElementById(a(this).attr("id")+"Uploader").clearFileUploadQueue(false);});}});})(jQuery);}
$(document).ready(function(){$("#uploadify").uploadify({uploader:in_path+"static/pack/upload/uploadify.swf",script:in_path+"source/pack/chat/uploadify.php",wmode:"transparent",folder:"UploadFile",method:"GET",scriptData:{uid:in_uid},buttonImg:in_path+"static/pack/chat/icon/uploadify.gif",width:"17",height:"16",queueID:"send_tips",auto:true,multi:false,fileExt:"*.jpg;*.gif;*.png;*.rar;*.zip",fileDesc:"选择*.jpg;*.gif;*.png;*.rar;*.zip文件",sizeLimit:200*1024*1024,onError:function(a,b,c,d){if(d.status==404){$("#send_tips").text("上传异常，请重试！");}else if(d.type==="HTTP"){$("#send_tips").text("error "+d.type+" : "+d.status);}else if(d.type==="File Size"){$("#send_tips").text("上传失败，大小不能超过200MB！");}else{$("#send_tips").text("error "+d.type+" : "+d.text);}
$("#send_tips").fadeOut(6000,function(){$(this).show().text("按 Enter 键快捷发送");});},onComplete:function(event,queueID,fileObj,response,data){if(response==0){$("#send_tips").text("上传出错，请重试！");}else{$("#textarea").val($("#textarea").val()+response);$("#textarea").focus();$("#send_tips").text("恭喜，文件上传成功！");}
$("#send_tips").fadeOut(6000,function(){$(this).show().text("按 Enter 键快捷发送");});}});});