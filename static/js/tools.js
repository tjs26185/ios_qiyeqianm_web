var invite = new Array();
$("#backtop").click(function() {
  if (location.href.indexOf("/index.html#2") > -1 || location.href.indexOf("/index.html#3") > -1 || location.href.indexOf("/index.html#4") > -1 || location.href.indexOf("/index.html#5") > -1) {
    window.location.href = "/index.html#1"
  } else {
    $('body,html').animate({
      scrollTop: 0
    });
  }
});
$(window).resize(function() {
  invite[1] = ($(window).width() - 500) / 2;
  invite[2] = ($(window).height() - 500) / 2;
  if ($(".invite").width() == 500) {
    $(".invite").animate({
      right: invite[1],
      bottom: invite[2],
    },
    0);
  }
});
var online = [];
$(".tools li").mouseenter(function() {
  sideLi($(this).find("p"), 166);
});
$(".tools li").mouseleave(function() {
  sideLi($(this).find("p"), 0);
});
function sideLi(obj, width) {
  $(obj).stop(true, true);
  $(obj).animate({
    width: width + "px"
  },
  250);
}
function closeDialog() {
  $(".mask").fadeOut(250);
  $(".dialog").fadeOut(250);
}
$(document).ready(function() {
  var t = ["当前离线", "当前在线"];
  for (var i = 0; i < online.length; i++) {
    var d = $(".qq p a:eq(" + i + ")");
    d.addClass("ol" + String(online[i]));
    d.attr("title", t[online[i]]);
    d.find("img").attr("src", "/templets/pc/images/button" + online[i] + ".png");
  }
});