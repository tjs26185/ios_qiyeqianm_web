var app_xhr;
var app_ot;
var app_oloaded;
function upload_app() {
	var upfile = $("#upload_app")[0].files[0];
	$("#dialog-uploadify").show();
	$("#upbtn").hide();
	if (upfile.size > in_size * 1048576) {
		$("#speed-uploadify").text("上传失败，大小不能超过" + in_size + "MB！");
		return false;
	}
	if (upfile.size < 1048576) {
		var _size = Math.floor(upfile.size / 1024) + "kb";
	} else {
		var _fixed = upfile.size / 1048576;
		var _size = _fixed.toFixed(2) + "MB";
	}
	if (upfile.name.length > 10) {
		var _name = upfile.name.substr(0, 10) + "...";
	} else {
		var _name = upfile.name;
	}
	$("#speed-uploadify").html(_name + "(" + _size + ')<span id="percentage"></span>');
	$(".turbo-upload").html('<a class="ng-binding" href="javascript:cancle_app()">取消</a>');
	var fd = new FormData();
	fd.append("app", upfile);
	fd.append("time", in_time);
	app_xhr = new XMLHttpRequest();
	app_xhr.open("post", in_path + "source/pack/upload/index-uplog.php");
	app_xhr.onload = complete_app;
	app_xhr.onerror = failed_app;
	app_xhr.upload.onprogress = progress_app;
	app_xhr.upload.onloadstart = function(evt) {
		app_ot = new Date().getTime();
		app_oloaded = 0;
	};
	app_xhr.send(fd);
}
function progress_app(evt) {
	var nt = new Date().getTime();
	var pertime = (nt - app_ot) / 1e3;
	app_ot = new Date().getTime();
	var perload = evt.loaded - app_oloaded;
	app_oloaded = evt.loaded;
	var speed = perload / pertime;
	var units = "b/s";
	if (speed / 1024 > 1) {
		speed = speed / 1024;
		units = "k/s";
	}
	if (speed / 1024 > 1) {
		speed = speed / 1024;
		units = "M/s";
	}
	speed = speed.toFixed(1);
	var per = Math.round(evt.loaded / evt.total * 100);
	$(".growing").css("width", per + "%");
	$("#percentage").text(" - " + per + "% - " + speed + units);
	if (per > 99) {
		$("#percentage").text(" 正在保存,请稍等...");
	}
}
function complete_app(evt) {
	var response = evt.target.responseText;
	if (response == -1) {
		$("#speed-uploadify").text("文件不规范，请重新选择！");
		$(".growing").css("width", "0%");
		$(".turbo-upload").hide();
		$("#dialog-uploadify").hide();
		$("#upbtn").show();
	} else {
		ReturnValue(eval("(" + response + ")"));
	}
}
function failed_app() {
	$("#speed-uploadify").text("上传异常，请重试！");
	$(".growing").css("width", "0%");
	$(".turbo-upload").hide();
		$("#dialog-uploadify").hide();
		$("#upbtn").show();
}
function cancle_app() {
	app_xhr.abort();
	$("#speed-uploadify").fadeOut(1e3,
	function() {
		$(this).show().text("已取消上传");
		$(".growing").css("width", "0%");
		$("#dialog-uploadify").hide();
		$("#upbtn").show();
	});
}