$(document).ready(isThisAccountBannedFunc);

function isThisAccountBannedFunc() {
    $.get('/source/index/ajax_profile.php?ac=accountIsBan').success(function (data) {
        // console.log('isThisAccountBannedFunc data', data);
        // var dataJson = JSON.parse(data);
        if (data.code === '200') {
            showBanedAlert();
        }
    })
}

function showBanedAlert() {
    alert('因发布的APP不符合审核规则，已停用账号发布功能', function () {
        // 是否在上传页，在上传页跳转到列表
        if(isUploadPage == 1) {
            window.location.href = '/index.php/apps';
        }
    });
    // var element_cover = document.createElement('div');
    // element_cover.innerHTML =
    // '<div class="banedcover" style="position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(30,30,30,0.5);z-index:2100000000;">'
    // +   '<div style="width: 300px;height: 150px; background-color:#fafafa;margin: -75px -150px;top:50%;left:50%;position:absolute;border-radius: 5px;border: #999 1px solid">'
    // +     '<div style="height: 30px; width: 100%; text-align: center; border-bottom: 1px solid #ccc; background-color:#f1f1f1;line-height:30px;border-radius: 5px 5px 0 0;color:#333;">'
    // +       '<span style="font-size: 16px">&nbsp;&nbsp;&nbsp;提示</span>'
    // +       '<span class="banedcoverclose" style="float:right; border-radius:50%;color: #fff;height: 20px;width: 20px;line-height:19px;text-align:center;margin: 5px;background-color: #aaa; cursor: pointer">×</span>'
    // +      '</div>'
    // +     '<div style="padding: 25px 25px;color:#f00;font-size: 14px">因发布的APP不符合审核规则，<br />已停用账号发布功能！</div>'
    // +   '</div>'
    // + '</div>'
    //
    // document.body.appendChild(element_cover);
    // $('.banedcover .banedcoverclose').click(function(){
    //   document.body.removeChild(element_cover);
    // });
}