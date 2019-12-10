var p = new Array();
p[50] = $.cookie('customername');
if (p[50] != undefined) {
  $('#user1').html(p[50]);
  $('#user1').attr("title", p[50]);
  $('#user2').html("退出");
  $('#user2').attr("href", '/DnionCloud/login/loginOut')
}
if (window.location.pathname.indexOf(eval("/login/")) >= 0) {
  if ($.cookie('username')) {
    $('#UserName').val($.cookie('username'));
    $('#remember').prop('checked', true);
    $(".placeholder").hide();
    $('.text').attr('style', 'filter:alpha(opacity=100)');
  }
  if ($.cookie('password')) {
    $('#PassWord').val($.cookie('password'));
    $('#remember').prop('checked', true);
    $(".placeholder").hide();
    $('.text').attr('style', 'filter:alpha(opacity=100)');
  }
}
var p = new Array();
p[50] = $.cookie('customername');
if (p[50] != undefined) {
  $('#user1').html(p[50]);
  $('#user1').attr("title", p[50]);
  $('#user2').html("退出");
  $('#user2').attr("href", '/DnionCloud/login/loginOut')
}
if (window.location.pathname.indexOf(eval("/login/")) >= 0) {
  if ($.cookie('username')) {
    $('#UserName').val($.cookie('username'));
    $('#remember').prop('checked', true);
    $(".placeholder").hide();
    $('.text').attr('style', 'filter:alpha(opacity=100)');
  }
  if ($.cookie('password')) {
    $('#PassWord').val($.cookie('password'));
    $('#remember').prop('checked', true);
    $(".placeholder").hide();
    $('.text').attr('style', 'filter:alpha(opacity=100)');
  }
}
if (navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)) {
  if (dragPass == false) {
    dragPass = true;
    $("#drag").hide();
  }
}