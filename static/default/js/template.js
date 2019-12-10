$(function () {
    var windowWidth = $(window).width();
    function setRem () {
        var windowWidth = $(window).width();
        if (windowWidth <= 750) {
            var fs = windowWidth/750 * 6.25 * 100;
            $('html').css('font-size', fs + '%');   // 1rem = 100px;
        }
    };
    setRem();
    $(window).resize(setRem);

    // 举报 单选
    $("#reportModal .report ul li").click(function () {
        $("#reportModal .report ul li").find(".icon").removeClass("icon-radio-checked").siblings("input[type=radio]").prop("checked", false);
        $(this).find(".icon").addClass("icon-radio-checked").siblings("input[type=radio]").prop("checked", true);
        // console.log($("#reportModal :checked").val());
    });

    // 举报保存
    $("#reportModal .report .save").click(function () {
        var checkedRadio = $("#reportModal .report ul");
        var textarea = $("#reportModal .report textarea");
        var email = $("#reportModal .report input[name=email]");
        var emailValidation = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;

        if (checkedRadio.find(":checked").length > 0) {
            checkedRadio.parents(".form-group").removeClass("form-error");
        } else {
            checkedRadio.parents(".form-group").addClass("form-error");
        }

        if (textarea.val().length > 0) {
            textarea.parents(".form-group").removeClass("form-error");
        } else {
            textarea.parents(".form-group").addClass("form-error");
        }

        if (emailValidation.test(email.val())) {
            email.parents(".form-group").removeClass("form-error");
        } else {
            email.parents(".form-group").addClass("form-error");
        }

        var errorLength = $("#reportModal .report .form-error").length;
        if (errorLength > 0) {
            $("#reportModal").modal("show");
            $("#reportSuccess").modal("hide");
        } else {
            $("#reportModal").modal("hide");
            $("#reportSuccess").modal("show");
        }
    });
    $("body").css("padding-top", 0);
});
function screenWidthFun() {
    // 截图宽度
    var screenWidth = 0;
    $(".template-common .app-screen ul li").each(function () {
        var $img = $(this).find("img");
        var ml = parseInt($(this).css("margin-right"));
        var imgWidth = 0;
        if ($img.get(0).complete) {
            // $img.css("width", $img.width());
            // imgWidth = parseInt($img.css("width")) + 20;
            imgWidth = $img.width() + ml;
            screenWidth += imgWidth;
            $(".template-common .app-screen ul").width(screenWidth + 5);
            // console.log("图片已加载");
            // console.log("imgWidth: " + imgWidth);
            // console.log("screenWidth " + screenWidth);
        } else {
            $img.load(function () {
                // $(this).css("width", this.width);
                // imgWidth = parseInt($img.css("width")) + 20;
                imgWidth = $(this).width() + ml;
                screenWidth += imgWidth;
                $(".template-common .app-screen ul").width(screenWidth + 5);

                // console.log("图片未加载");
                // console.log("imgWidth: " + imgWidth);
                // console.log("screenWidth " + screenWidth);
            });
        }
    });
};
screenWidthFun();
// 弹窗
var Modal = function() { // Modal为匿名函数执行完的返回值
    function templateModal(obj) {
        $("#templateModal").remove();
        var templateModalHtml = '<div class="modal fade ms-modal" id="templateModal" tabindex="-1" role="dialog">\n' +
            '    <div class="modal-dialog modal-sm" role="document">\n' +
            '        <div class="modal-content">\n' +
            '            <div class="modal-body">\n' +
            '                <div class="template-modal">\n' +
            '                    <div class="m-top">\n' +
            '                        <div class="title1"></div>\n' +
            '                        <div class="title2"></div>\n' +
            '                    </div>\n' +
            '                    <div class="modal-p"></div>\n' +
            '                    <button type="button" class="ms-btn ms-btn-primary modal-btn" data-dismiss="modal"></button>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>\n';

        $("body").append(templateModalHtml);
        $("#templateModal").find(".m-top").css("background-image", "url(./static/img/" + obj.imgName +")");
        $("#templateModal").find(".title1").text(obj.title1);
        $("#templateModal").find(".title2").html(obj.title2);
        $("#templateModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#templateModal").find(".modal-btn").text(obj.btnText).addClass(obj.btnClass);
        $("#templateModal").modal('show');
    }
    function generalModal(obj) { // 通用弹窗
        $("#generalModal").remove();
        var generalModalHtml = '<div class="modal fade ms-modal" id="generalModal" tabindex="-1" role="dialog">\
            <div class="modal-dialog modal-sm" role="document">\
                    <div class="modal-content">\
                        <div class="modal-body">\
                            <div class="text-center">\
                                <div class="modal-icon"><span class="icon icon-class mb5"></span></div>\
                                <div class="color-333 bold font16 title"></div>\
                                <div class="color-333 modal-p"></div>\
                                <div class="">\
                                    <a href="javascript:;" class="ms-btn cancel-btn"></a>\
                                    <button type="button" class="ms-btn ms-btn-primary success-btn"></button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>';

        $("body").append(generalModalHtml);
        $("#generalModal").find(".icon-class").addClass(obj.iconClass);
        $("#generalModal").find(".title").text(obj.title);
        $("#generalModal").find(".modal-p").html(obj.p).css("text-align", obj.align);
        $("#generalModal").find(".success-btn").text(obj.successBtnText);
        $("#generalModal").find(".cancel-btn").text(obj.cancelBtnText);
        if (obj.backdrop) {
            $("#generalModal").modal({backdrop: 'static', keyboard: false});
        } else {
            $("#generalModal").modal("show");
        }
        $("#generalModal").find(".success-btn").click(obj.successCallback);
        $("#generalModal").find(".cancel-btn").click(obj.cancelCallback);
        var iconClassLength = $("#generalModal").find(".icon-class").attr("class").replace(/\s*/g,"").length;
        // console.log(iconClassLength);
        if (iconClassLength == 17) {
            $("#generalModal").find(".modal-icon").hide();
        } else {
            $("#generalModal").find(".modal-icon").show();
        }

        // 点击按钮是否关闭弹窗
        $("#generalModal").find(".success-btn").click(function () {
            if (obj.successBtnModal) {
                $("#generalModal").modal("hide");
            }
        });
        $("#generalModal").find(".cancel-btn").click(function () {
            if (obj.cancelBtnModal) {
                $("#generalModal").modal("hide");
            }
        });
    };

    return {
        templateModal: templateModal, // 带确定按钮 弹窗
        generalModal: generalModal // 带确定按钮 弹窗

    }
}();
/*
Modal.templateModal({
    imgName: "modal-bg-2.jpg",
    title1: '提示1',
    title2: '该账户尚未实名，每天只能下载5次',
    p: '建议您：<br>尽快登录第八区网站，点击右上角未实名认证，进行认证。<br>认证通过每天将免费获得1000次下载。',
    align: 'left', // 居左 left, 居中 center, 居右 right
    btnText: '知道了',
    btnClass: "modal-btn1"
});
*/

