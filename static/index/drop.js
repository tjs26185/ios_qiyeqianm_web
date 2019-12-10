$(function() {
	$(document).on({
		dragleave: function(e) {
			e.preventDefault();
			$("#_drop1").show();
			$("#_drop2").hide();
		},
		drop: function(e) {
			e.preventDefault();
		},
		dragenter: function(e) {
			e.preventDefault();
		},
		dragover: function(e) {
			e.preventDefault();
			$("#_drop1").hide();
			$("#_drop2").show();
		}
	});
	$("upload-card")[0].addEventListener("drop",
	function(e) {
		e.preventDefault();
		var fileList = e.dataTransfer.files;
		if (fileList.length == 0) {
			
			return false;
		}
		var upfile = fileList[0];
		$("#dialog-uploadify").show();
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
	},
	false);
});