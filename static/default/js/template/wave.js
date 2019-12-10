function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
}

(function () {
    var language = (/^zh/.test(navigator.language) ? "zh" : "en");

    var w = {
        zh: {
            AUTO_RETURN_HOME: "<label id='countdown'>{{countdown}}</label> 秒后发现新应用",
            LOADING: "加载中...",
            DOWNLOAD_INSTALL: "下载安装",
            DOWNLOAD_LOADING: "下载中",
            DOWNLOAD_ENTER: "立即进入",
            DATA_ERROR: "数据错误",
            DATA_INCOMPLETE: "请联系应用开发者, <a href='/publish'>去重新上传</p>",
            DATA_INCOMPLETE_IN_MOBILE: "请联系应用开发者重新上传",
            DOWNLOAD_FAILED: "刷新并重试",
            VIEW_IN_DESKTOP: "正在安装，请按 Home 键在桌面查看",
            VIEW_IN_BROWSER: "请在浏览器中查看下载进度",
            PLATFORM_NOT_MATCHING: "只支持 {{app|app_type}} 设备",
            CHANGELOG_PLACEHOLDER: "没有更新日志",
            FAILED_LOAD_APP: "加载失败",
            NOT_FOUND_TITLE: "404 - Not Found",
            NOT_FOUND_LOG: "您访问的 应用/页面 不存在",
            FORBIDDEN_TITLE: "403 - Forbidden",
            FORBIDDEN_TITLE_LOG: "您没有权限访问这个应用",
            REQUIRE_PWD: "请输入密码",
            PASSWORD_WRONG: "密码错误，请重新输入",
            SCAN_TIPS: "扫描二维码下载",
            DESC: "应用描述",
            CURRENT_VERSION: "当前版本",
            FILE_SIZE: "文件大小",
            UPDATED_AT: "更新于",
            RELEASES: "历史版本",
            CHANGELOG: "更新日志",
            VIEW_ALL_APP_RELEASES: "查看全部 {{app.histories|length}} 个历史版本",
            VIEW_ALL_APP_RELEASES_IOS: "查看全部 {{ios.histories|length}} 个历史版本",
            VIEW_ALL_APP_RELEASES_ANDROID: "查看全部 {{android.histories|length}} 个历史版本",
            FOLDING: "隐藏",
            VIEW_ALL_COMBOAPP_RELEASES: "查看全部 {{combo_app.releases|length}} 个历史版本",
            SCREENSHOTS: "应用截图",
            INHOUSE: "123",
            ADHOC: "内测版",
            CONFIRM: "确认",
            UNABLE_INSTALL: "微信/QQ 内无法下载应用",
            GO_OUT_WECHAT_TIP: "<span class=\"span1\">\n" +
                "            <img src=\"//pic.dibaqu.com/images/click_btn.png\">\n" +
                "        </span>\n" +
                "        <span class=\"span2\">\n" +
                "            <em>1</em> 点击右上角\n" +
                "            <img src=\"//pic.dibaqu.com/images/menu_android.png\">\n" +
                "            打开菜单\n" +
                "        </span>\n" +
                "        <span class=\"span2 android_open\">\n" +
                "            <em>2</em> 选择\n" +
                "            <img src=\"//pic.dibaqu.com/images/android.png\">\n" +
                "        </span>",
            GO_OUT_WECHAT_IOS_TIP: "<span class=\"span1\">\n" +
                "            <img src=\"//pic.dibaqu.com/images/click_btn.png\">\n" +
                "        </span>\n" +
                "        <span class=\"span2\">\n" +
                "            <em>1</em> 点击右上角\n" +
                "            <img src=\"//pic.dibaqu.com/images/menu.png\">\n" +
                "            打开菜单\n" +
                "        </span>\n" +
                "        <span class=\"span2\">\n" +
                "            <em>2</em> 选择\n" +
                "            <img src=\"//pic.dibaqu.com/images/safari.png\">\n" +
                "            用Safari打开下载\n" +
                "        </span>",
            FOOTER_SLOGAN: 'm.aeiuui.cn 是应用内测平台，请自行甄别应用风险，<wbr />如应用存在问题，<wbr />可点击“举报”按钮 <a class="one-key-report" href="javascript:;">举报!</a>',
            SAFE: "安全",
            SAFE_TEXT: "此应用已通过以下安全检测，可放心下载",
            VIRUS_PASS: "扫描通过",
            LOW_RISK: "低风险",
            HIGH_RISK: "高风险",
            VIRUS: "病毒",
            RISK: "有风险",
            RISK_TEXT: "此应用下载有风险，请谨慎下载",
            KING_SOFT: "猎豹安全大师",
            BAIDU: "百度手机卫士",
            POPULARIZE: "推荐应用",
            DOWNLOAD: "下载",
            REPORT_TITLE: "举报",
            REPORT_TIPS: "作为第三方内测分发平台，我们一直致力于打击违规应用，保护用户权益。非常感谢您的举报，我们会在第一时间安排专人处理您的举报问题。感谢您对我们的支持。",
            REPORT_RETUEN: "返回下载页",
            REPORT_SENDING: "正在发送，请稍后...",
            REPORT_EMAIL: "你的邮箱",
            REPORT_EMAIL_PLACEHOLDER: "Email",
            REPORT_EMAIL_ERROR: "请填写有效的邮箱，可及时了解举报结果",
            REPORT_REASON: "举报原因",
            REPORT_DB: "盗版",
            REPORT_HS: "黄色",
            REPORT_QZ: "欺诈",
            REPORT_OTHER: "其它",
            REPORT_REASON_ERROR: "请选择举报类型",
            REPORT_CONTENT_PLACEHOLDER: "补充举报原因",
            REPORT_CONTENT_ERROR: "请填写举报原因",
            REPORT_BUTTON: "举报",
            REPORT_THANKS: "感谢你的举报",
            REPORT_MESSAGE: "我们会尽快核实您的举报内容，将于 1-3 个工作日内处理。",
            LEGAL_FORBIDDEN: "因法律的要求<wbr />而被拒绝",
            LEGAL_FORBIDDEN_LOG: "该 APP 涉及盗版、欺诈、色情或其他不良信息",
            TRUST_DEVELOPER: "信任开发者",
            UNTRUSTED_ENTERPRISE_DEVELOPER: "<div style=\"text-align:center;padding:15px;\"><a target=\"_blank\" href=\"/guide.php\" style=\"color:#157df1;\"><span class=\"glyphicon glyphicon-hand-right\"></span>&nbsp;&nbsp;\"未受信任的企业级开发者\"的解决办法</a></div>",
            VERSION: "版本",
            SIZE: "大小",
            UPDATE_TIME: "更新时间",
            FOR_ANDROID: "适用于安卓手机",
            FOR_IOS: "适用于苹果手机",
            FOR_IOS_AND_ANDROID: "适用于苹果和安卓手机",
            DIBAQU: "领客云",
            DISCLAIMER: "免责声明",
            REPORT: "举报",
            APP_DESCRIPTION: "应用描述",
            APP_SCREENSHOTS: "应用截图",
            APP_CONTACT: "联系方式",
            APP_REMARK: "应用备注",
            APP_ILLEGAL: "该应用不存在或已被自动删除",
            APP_EXPIRED: "该应用不存在或已过期",
            APP_PASSWORD_ERROR: "下载密码错误",
            APP_DOWNLOAD_TIMES_OVER: "APP下载次数已耗尽，请联系应用所有者",
            BACK_HOME: "返回首页",
            REALNAME_LAYER_HINT: "提示",
            REALNAME_LAYER_TITLE: "账户尚未实名，请尽快操作实名认证",
            REALNAME_LAYER_CONTENT: "建议您：<br>尽快登录领客云网站，点击右上角未实名认证，进行认证。<br>未实名认证，下载链接有效期只有24小时，只能下载5次。",
            REALNAME_LAYER_BUTTON_TEXT: "知道了",
            BUTTON_OK: "确定"
        },
        en: {
            AUTO_RETURN_HOME: "Found new apps in <label id='countdown'>{{countdown}}</label> secs",
            LOADING: "Loading...",
            DOWNLOAD_INSTALL: "Download",
            DOWNLOAD_LOADING: "Loading",
            DOWNLOAD_ENTER: "Enter",
            DATA_ERROR: "Data Error",
            DATA_INCOMPLETE: "Please contact the app's owner, <a href='/publish'>upload again in Rio version</p>",
            DATA_INCOMPLETE_IN_MOBILE: "Please contact the app's owner upload again",
            DOWNLOAD_FAILED: "Refresh",
            VIEW_IN_DESKTOP: "Installing, please check on your home screen",
            VIEW_IN_BROWSER: "Please check the download progress in the browser",
            PLATFORM_NOT_MATCHING: "Only support {{app|app_type}} device",
            CHANGELOG_PLACEHOLDER: "There is no update log",
            FAILED_LOAD_APP: "Load failed",
            NOT_FOUND_TITLE: "404 - Not Found",
            NOT_FOUND_LOG: "Page does not exist",
            FORBIDDEN_TITLE: "403 - Forbidden",
            FORBIDDEN_TITLE_LOG: "You don't have permission to view this page",
            REQUIRE_PWD: "Please enter the password",
            PASSWORD_WRONG: "Password is not correct",
            SCAN_TIPS: "<span style=''>Scan the qrcode to download</span>",
            DESC: "Description",
            CURRENT_VERSION: "Current version",
            FILE_SIZE: "File size",
            UPDATED_AT: "Updated at",
            RELEASES: "Releases",
            CHANGELOG: "Changelog",
            VIEW_ALL_APP_RELEASES: "View all {{app.histories|length}} releases",
            VIEW_ALL_APP_RELEASES_IOS: "View all {{ios.histories|length}} releases",
            VIEW_ALL_APP_RELEASES_ANDROID: "View all {{android.histories|length}} releases",
            FOLDING: "Folding",
            SCREENSHOTS: "Screenshots",
            INHOUSE: "",
            ADHOC: "Adhoc",
            CONFIRM: "Confirm",
            UNABLE_INSTALL: "Can't downloads apps in WeChat/QQ",
            GO_OUT_WECHAT_IOS_TIP: "Open in Safari and install this app",
            GO_OUT_WECHAT_TIP: "Open in browser and install this app",
            FOOTER_SLOGAN: 'dibaqu.com provide beta app hosting service. If the app <wbr /> is suspicious, click the "report" button please.<a class="one-key-report" href="javascript:;">Report!</a>',
            SAFE: "Safe",
            SAFE_TEXT: "This application is already passing the security testing, you can start to download it.",
            VIRUS_PASS: "PASS",
            LOW_RISK: "Low Risk",
            HIGH_RISK: "High Risk",
            VIRUS: "Virus",
            RISK: "WARNING",
            RISK_TEXT: "We find out some unknown viruses in this app, please make sure this application is from someone you trust.",
            KING_SOFT: "CM Security",
            BAIDU: "Baidu Mobile Security",
            POPULARIZE: "Hot apps",
            DOWNLOAD: "Download",
            REPORT_TITLE: "Report",
            REPORT_TIPS: "As a third-party platform,we are committed to cracking down on illegal apps，protect the rights  of users。Thank you for your complaint. We will deal with it as soon as possible.Thanks for your support.",
            REPORT_RETUEN: "Back",
            REPORT_SENDING: "Sending...",
            REPORT_EMAIL: "Email",
            REPORT_EMAIL_PLACEHOLDER: "Your Email",
            REPORT_EMAIL_ERROR: "Please enter your email address. Once we have reviewed your report, we will notify you by email.",
            REPORT_REASON: "Reason for report",
            REPORT_DB: "Pirate",
            REPORT_HS: "Porn",
            REPORT_QZ: "Scam",
            REPORT_OTHER: "Other",
            REPORT_REASON_ERROR: "Please choose a topic you want to report.",
            REPORT_CONTENT_PLACEHOLDER: "Please provide details of the reported issue.",
            REPORT_CONTENT_ERROR: "Please tell us why you want to report this app.",
            REPORT_BUTTON: "Report",
            REPORT_THANKS: "Thank you for helping to make dibaqu.com better!",
            REPORT_MESSAGE: "We will review your report soon and the result will be processed within 1-3 working days",
            LEGAL_FORBIDDEN: "Unavailable For Legal Reasons",
            LEGAL_FORBIDDEN_LOG: "Unavailable For Legal Reasons",
            TRUST_DEVELOPER: "Trust developer",
            UNTRUSTED_ENTERPRISE_DEVELOPER: "<div style=\"text-align:center;padding:15px;\"><a target=\"_blank\" href=\"/guide.php\" style=\"color:#157df1;\">Untrusted enterprise developer</a></div>",
            VERSION: "Version",
            SIZE: "Size",
            UPDATE_TIME: "Update Time",
            FOR_ANDROID: "For Android",
            FOR_IOS: "For iOS",
            FOR_IOS_AND_ANDROID: "For iOS & Android",
            DIBAQU: 'mifengyun',
            DISCLAIMER: "Disclaimer",
            REPORT: "Report",
            APP_DESCRIPTION: "Description",
            APP_SCREENSHOTS: "Screenshots",
            APP_CONTACT: "Contact",
            APP_REMARK: "Remark",
            APP_ILLEGAL: "The APP has been removed because it contains illegal content",
            APP_EXPIRED: "The APP has expired and cannot be downloaded",
            APP_PASSWORD_ERROR: "wrong password",
            APP_DOWNLOAD_TIMES_OVER: "The APP download times have been exhausted, please contact the APP owner",
            BACK_HOME: "Back to home",
            REALNAME_LAYER_HINT: "Hint",
            REALNAME_LAYER_TITLE: "The account has not been verified.",
            REALNAME_LAYER_CONTENT: "please go to login to dibaqu website，click the button in the upper right corner to authentication。<br />If not , the download link is valid for download only 5 times in 24 hours.",
            REALNAME_LAYER_BUTTON_TEXT: "got it",
            BUTTON_OK: "OK"
        },
        "zh-tw": {
            AUTO_RETURN_HOME: "<label id='countdown'>{{countdown}}</label> 秒後發現新應用",
            LOADING: "加載中...",
            DOWNLOAD_INSTALL: "下載安裝",
            DOWNLOAD_LOADING: "下载中",
			DOWNLOAD_ENTER: "立即進入",
            DATA_ERROR: "數據錯誤",
            DATA_INCOMPLETE: "請聯系應用開發者, <a href='/publish'>去重新上傳</p>",
            DATA_INCOMPLETE_IN_MOBILE: "請聯系應用開發者重新上傳",
            DOWNLOAD_FAILED: "刷新並重試",
            VIEW_IN_DESKTOP: "正在安裝，請按 Home 鍵在桌面查看",
            VIEW_IN_BROWSER: "請在浏覽器中查看下載進度",
            PLATFORM_NOT_MATCHING: "只支持 {{app|app_type}} 設備",
            CHANGELOG_PLACEHOLDER: "没有更新日志",
            FAILED_LOAD_APP: "加載失敗",
            NOT_FOUND_TITLE: "404 - Not Found",
            NOT_FOUND_LOG: "您訪問的 應用/頁面 不存在",
            FORBIDDEN_TITLE: "403 - Forbidden",
            FORBIDDEN_TITLE_LOG: "您沒有權限訪問這個應用",
            REQUIRE_PWD: "請輸入密碼",
            PASSWORD_WRONG: "密碼錯誤，請重新輸入",
            SCAN_TIPS: "掃描二維碼下載",
            DESC: "應用描述",
            CURRENT_VERSION: "當前版本",
            FILE_SIZE: "文件大小",
            UPDATED_AT: "更新于",
            RELEASES: "曆史版本",
            CHANGELOG: "更新日志",
            VIEW_ALL_APP_RELEASES: "查看全部 {{app.histories|length}} 個曆史版本",
            VIEW_ALL_APP_RELEASES_IOS: "查看全部 {{ios.histories|length}} 個曆史版本",
            VIEW_ALL_APP_RELEASES_ANDROID: "查看全部 {{android.histories|length}} 個曆史版本",
            FOLDING: "隱藏",
            VIEW_ALL_COMBOAPP_RELEASES: "查看全部 {{combo_app.releases|length}} 個曆史版本",
            SCREENSHOTS: "應用截圖",
            INHOUSE: "123",
            ADHOC: "內測版",
            CONFIRM: "確認",
            UNABLE_INSTALL: "微信/QQ 內無法下載應用",
            GO_OUT_WECHAT_TIP: "請點擊右上角<br/>選擇“浏覽器中打開”",
            GO_OUT_WECHAT_IOS_TIP: "點擊右上角菜單在<br/>Safari 中打开并安装",
            FOOTER_SLOGAN: 'm.aeiuui.cn 是應用內測平台，請自行甄別應用風險，<wbr />如應用存在問題，<wbr />可點擊“舉報”按鈕 <a class="one-key-report" href="javascript:;">舉報!</a>',
            SAFE: "安全",
            SAFE_TEXT: "此應用已通過以下安全檢測，可放心下載",
            VIRUS_PASS: "掃描通過",
            LOW_RISK: "低風險",
            HIGH_RISK: "高風險",
            VIRUS: "病毒",
            RISK: "有風險",
            RISK_TEXT: "此應用下載有風險，請謹慎下載",
            KING_SOFT: "獵豹安全大師",
            BAIDU: "百度手機衛士",
            POPULARIZE: "推薦應用",
            DOWNLOAD: "下載",
			REPORT_TITLE: "舉報",
			REPORT_TIPS: "作為第三方內測分發平臺，我們壹直致力於打擊違規應用，保護用戶權益。非常感謝您的舉報，我們會在第壹時間安排專人處理您的舉報問題。感謝您對我們的支持。",
            REPORT_RETUEN: "返回下載頁",
            REPORT_SENDING: "正在發送，請稍後...",
            REPORT_EMAIL: "你的郵箱",
            REPORT_EMAIL_PLACEHOLDER: "Email",
            REPORT_EMAIL_ERROR: "請填寫有效的郵箱，可及時了解舉報結果",
            REPORT_REASON: "舉報原因",
            REPORT_DB: "盜版",
            REPORT_HS: "黃色",
            REPORT_QZ: "欺詐",
            REPORT_OTHER: "其它",
            REPORT_REASON_ERROR: "請選擇舉報類型",
            REPORT_CONTENT_PLACEHOLDER: "補充舉報原因",
            REPORT_CONTENT_ERROR: "請填寫舉報原因",
            REPORT_BUTTON: "舉報",
            REPORT_THANKS: "感謝你的舉報",
            REPORT_MESSAGE: "我們會盡快核實您的舉報內容，關于舉報的處理結果將于 1-3 個工作日內發送至你郵箱。",
            LEGAL_FORBIDDEN: "因法律的要求<wbr />而被拒絕",
            LEGAL_FORBIDDEN_LOG: "該 APP 涉及盜版、欺詐、色情或其他不良信息",
            TRUST_DEVELOPER: "信任開發者",
            UNTRUSTED_ENTERPRISE_DEVELOPER: "未受信任的企業開發者",
            VERSION: "版本",
            SIZE: "大小",
            UPDATE_TIME: "更新時間",
            FOR_ANDROID: "適用于安卓手機",
            FOR_IOS: "適用于蘋果手機",
            FOR_IOS_AND_ANDROID: "適用于蘋果和安卓手機",
            DIBAQU: "领客雲",
            DISCLAIMER: "免責聲明",
            REPORT: "舉報",
            APP_DESCRIPTION: "應用描述",
            APP_SCREENSHOTS: "應用截圖",
            APP_CONTACT: "聯系方式",
            APP_REMARK: "應用備注",
            APP_ILLEGAL: "該應用不存在或已被自動刪除",
            APP_EXPIRED: "該應用不存在或已過期",
            APP_PASSWORD_ERROR: "下載密碼錯誤",
            APP_DOWNLOAD_TIMES_OVER: "APP下載次數已耗盡，請聯系應用所有者",
            BACK_HOME: "返回首頁",
            REALNAME_LAYER_HINT: "提示",
            REALNAME_LAYER_TITLE: "賬戶尚未實名，請盡快操作實名認證",
            REALNAME_LAYER_CONTENT: "建議您：<br>盡快登錄第八區網站，點擊右上角未實名認證，進行認證。<br>未實名認證，下載鏈接有效期只有24小時，只能下載5次。",
            REALNAME_LAYER_BUTTON_TEXT: "知道了",
            BUTTON_OK: "確定"
        }
    };

    // var language = {
    //     AUTO_RETURN_HOME: "<label id='countdown'>{{countdown}}</label> 秒后发现新应用",
    //     LOADING: "加载中...",
    //     DOWNLOAD_INSTALL: "下载安装",
    //     DOWNLOAD_LOADING: "下载中",
    //     DATA_ERROR: "数据错误",
    //     DATA_INCOMPLETE: "请联系应用开发者, <a href='/apps/new'>去新版重新上传</p>",
    //     DATA_INCOMPLETE_IN_MOBILE: "请联系应用开发者重新上传",
    //     DOWNLOAD_FAILED: "刷新并重试",
    //     VIEW_IN_DESKTOP: "正在安装，请按 Home 键在桌面查看",
    //     VIEW_IN_BROWSER: "请在浏览器中查看下载进度",
    //     PLATFORM_NOT_MATCHING: "只支持 {{app|app_type}} 设备",
    //     CHANGELOG_PLACEHOLDER: "没有更新日志",
    //     FAILED_LOAD_APP: "加载失败",
    //     NOT_FOUND_TITLE: "404 - Not Found",
    //     NOT_FOUND_LOG: "您访问的 应用/页面 不存在",
    //     FORBIDDEN_TITLE: "403 - Forbidden",
    //     FORBIDDEN_TITLE_LOG: "您没有权限访问这个应用",
    //     REQUIRE_PWD: "请输入密码",
    //     PASSWORD_WRONG: "密码错误",
    //     SCAN_TIPS: "扫描二维码下载<br/>或用手机浏览器输入这个网址:&nbsp;&nbsp;<span class='text-black'>{{full_short}}</span>",
    //     DESC: "应用描述",
    //     CURRENT_VERSION: "当前版本",
    //     FILE_SIZE: "文件大小",
    //     UPDATED_AT: "更新于",
    //     RELEASES: "历史版本",
    //     CHANGELOG: "更新日志",
    //     VIEW_ALL_APP_RELEASES: "查看全部 {{app.histories|length}} 个历史版本",
    //     VIEW_ALL_APP_RELEASES_IOS: "查看全部 {{ios.histories|length}} 个历史版本",
    //     VIEW_ALL_APP_RELEASES_ANDROID: "查看全部 {{android.histories|length}} 个历史版本",
    //     FOLDING: "隐藏",
    //     VIEW_ALL_COMBOAPP_RELEASES: "查看全部 {{combo_app.releases|length}} 个历史版本",
    //     SCREENSHOTS: "应用截图",
    //     INHOUSE: "123",
    //     ADHOC: "内测版",
    //     CONFIRM: "确认",
    //     UNABLE_INSTALL: "微信/QQ 内无法下载应用",
    //     GO_OUT_WECHAT_TIP: "请点击右上角<br/>选择“浏览器中打开”",
    //     GO_OUT_WECHAT_IOS_TIP: "点击右上角菜单在<br/>Safari中打开并安装",
    //     FOOTER_SLOGAN: 'fir.im 是应用内测平台，请自行甄别应用风险，<wbr />如应用存在问题，<wbr />可点击“举报”按钮 <a class="one-key-report"href="javascript:;">举报!</a>',
    //     SAFE: "安全",
    //     SAFE_TEXT: "此应用已通过以下安全检测，可放心下载",
    //     VIRUS_PASS: "扫描通过",
    //     LOW_RISK: "低风险",
    //     HIGH_RISK: "高风险",
    //     VIRUS: "病毒",
    //     RISK: "有风险",
    //     RISK_TEXT: "此应用下载有风险，请谨慎下载",
    //     KING_SOFT: "猎豹安全大师",
    //     BAIDU: "百度手机士",
    //     POPULARIZE: "推荐应用",
    //     DOWNLOAD: "下载",
    //     REPORT_RETUEN: "返回下载页",
    //     REPORT_SENDING: "正在发送，请稍后...",
    //     REPORT_EMAIL: "你的邮箱",
    //     REPORT_EMAIL_PLACEHOLDER: "Email",
    //     REPORT_EMAIL_ERROR: "请填写有效的邮箱，可及时了解举报结果",
    //     REPORT_REASON: "举报原因",
    //     REPORT_DB: "盗版",
    //     REPORT_HS: "黄色",
    //     REPORT_QZ: "欺诈",
    //     REPORT_OTHER: "其它",
    //     REPORT_REASON_ERROR: "请选择举报类型",
    //     REPORT_CONTENT_PLACEHOLDER: "补充举报原因",
    //     REPORT_CONTENT_ERROR: "请填写举报原因",
    //     REPORT_BUTTON: "举报！",
    //     REPORT_THANKS: "感谢你的举报",
    //     REPORT_MESSAGE: "我们会尽快核实您的举报内容，关于举报的处理结果将于 1-3 个工作日内发送至你邮箱。",
    //     LEGAL_FORBIDDEN: "因法律的要求<br />而被拒绝",
    //     LEGAL_FORBIDDEN_LOG: "该 APP 涉及盗版、欺诈、色情或其他不良信息",
    // };


    $(function () {
        window.DAFU = {
            brand: "m.aeiuui.cn 3.1 - Rio",
            locale: 'zh',
            params: {},
            platform: {},
            config: {
                server: "/source/index/ajax.php?ac=jsonFormat&link="
            },
            data: {},
            APP: {},
            signPackage: {},
            AD: {},
            init: function () {

            },
            query: function () {
                var self = this;
                $.getJSON(this.config.server + this.getQuerySetting(), this.getQueryParams(), function (ret) {
                    if (ret.code != '200') {
                        alert(ret.msg);
                        return false;
                    }
                    self.APP = ret.data.info;
                    self.AD = ret.data.ad_config;
                    self.signPackage = ret.data.signPackage;
                    self.data = ret.data;
                    if (ret.data.info.template_language) {
                        language = ret.data.info.template_language;
                    }
                    if (w[language] == undefined) {
                        language = 'zh';
                    }

                    $.extend(Mark.includes, w[language]);
                    if (!self.APP.template) {
                        self.successVip();
                    } else if (['tmp1', 'tmp2', 'tmp3', 'tmp4', 'tmp5', 'tmp6'].indexOf(self.APP.template) > -1) {
                        self.successVip();
                    } else if (['error'].indexOf(self.APP.template) > -1) {
                        self.error(ret.data.msg);
                    }
                });
            },
            getQuerySetting: function () {
                var url = $('input[name="url"]').val();
                if (url) return url;

                var pathname = window.location.pathname.substring(1);
                pathname = pathname.split("?")[0];
                return pathname.replace(/show\//, "");

            },
            getQueryParams: function GetRequest() {
                var url = location.search;
                var theRequest = new Object();
                if (url.indexOf("?") != -1) {
                    var str = url.substr(1);
                    var strs = str.split("&");
                    for (var i = 0; i < strs.length; i++) {
                        theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
                    }
                }
                return theRequest;
            },

            successVip: function () {
                var tmp = Mark.up($('#title').html(), this.APP);
                $('head').append(tmp);
                var tmp = Mark.up($('#meta').html(), this.APP);
                $('head').append(tmp);

                this.APP.show_button = this.data.show_button;
                this.APP.checked = this.data.checked;

                this.APP.support_ios = (this.APP.support & 1) ? true : false;
                this.APP.support_android = (this.APP.support & 2) ? true : false;
                $('body').append(Mark.up($('#content').html(), this.APP));
                var clipboard = new Clipboard('#copy_button');
                clipboard.on('success', function (e) {
                    var msg = e.trigger.getAttribute('aria-label');
                    alert(msg);
                    e.clearSelection();
                });

                this.APP.show_guide = this.data.show_guide;

                if (this.APP.show_guide) {
                    $(w[language].UNTRUSTED_ENTERPRISE_DEVELOPER).insertBefore('.down_load');
                    $('.down_load').css('margin-top', 0);
                }

                $('body').append(Mark.up($('#copyright').html(), this.APP));

                var hostname = window.location.hostname;
                if (hostname.indexOf('m.aeiuui.cn') == -1) {
                    $('.template-footer .t-footer').hide();
                }

                this.showAd();
                this.showPopup();
                this.weixin();
                console.info(this.data);
                if (this.data.info.user.is_publish == 0) {
                    console.info(1);
                    Modal.templateModal({
                        imgName: "modal-bg-2.jpg",
                        title1: w[language].REALNAME_LAYER_HINT,
                        title2: w[language].REALNAME_LAYER_TITLE,
                        p: w[language].REALNAME_LAYER_CONTENT,
                        align: 'left', // 居左 left, 居中 center, 居右 right
                        btnText: w[language].REALNAME_LAYER_BUTTON_TEXT,
                        btnClass: "modal-btn1"
                    });
                }
            },
            error: function (msg) {
                $('body').append(Mark.up($('#error-content').html(), this.APP));
                $(".error-msg").html(w[language][msg]);
            },
            success: function () {
                var tmp = Mark.up($('#title').html(), this.APP);
                $('head').append(tmp);
                var tmp = Mark.up($('#meta').html(), this.APP);
                $('head').append(tmp);
                var top_title = Mark.up($('#top_title').html(), this.APP);
                $('body').append(top_title);

                this.APP.show_button = this.data.show_button;
                this.APP.checked = this.data.checked;
                var button = Mark.up($('#button').html(), this.APP);
                $('body').append(button);

                $('body').append(Mark.up($('#intro').html(), this.APP));
                $('body').append(Mark.up($('#qrcode').html(), this.APP));
                var clipboard = new Clipboard('#copy_button');
                clipboard.on('success', function (e) {
                    var msg = e.trigger.getAttribute('aria-label');
                    alert(msg);
                    e.clearSelection();
                });

                this.APP.show_guide = this.data.show_guide;
                $('body').append(Mark.up($('#copyright').html(), this.APP));


                this.weixin();
                this.showAd();
                this.showPopup();
            },

            showAd: function () {
                if (parseInt(this.data.show_ad) == 0) {
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "/source/index/ajax.php?ac=adsense&template=" + this.APP.template,
                    data: {'template': this.data.template},
                    dataType: 'html',
                    beforeSend: function (xhr) {
                    },
                    success: function (result, textStatus, jqXHR) {
                        if (result) {
                            $('body').append(result);
                            $('.template-footer').css("margin-bottom", "60px");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            },
            reportApp: function () {
                $("#reportModal").modal("show");
                // 举报 单选
                $(document).on('click', '.report ul li', function () {
                    $("#reportModal .report ul li").find(".icon").removeClass("icon-radio-checked").siblings("input[type=radio]").prop("checked", false);
                    $(this).find(".icon").addClass("icon-radio-checked").siblings("input[type=radio]").prop("checked", true);
                    // console.log($("#reportModal :checked").val());
                });

                // 举报保存
                $(document).on('click', (".report .save"), function () {
                    $(this).attr('disabled', true);
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
                    } else {
                        var app_id = DAFU.APP.id;
                        var app_name = DAFU.APP.app_name;
                        $.post('/source/index/ajax.php?ac=report', {
                            email: email.val(),
                            type: $.trim(checkedRadio.find(":checked").parent().text()),
                            message: textarea.val(),
                            app_id: app_id,
                            app_name: app_name
                        }, function (data) {
                            $('#report-sending').hide();
                            if (data.code == 200) {
                                $("#reportModal").modal("hide");
                                Modal.generalModal({
                                    backdrop: true, // 点击阴影是否关闭弹窗， // true 开启； false 关闭
                                    iconClass: "",  // success: icon-modal-success1,  error: icon-modal-error2
                                    title: w[language].REPORT_THANKS,  // 弹窗标题
                                    p: w[language].REPORT_MESSAGE, // 弹窗内容
                                    align: 'left', // 弹窗内容排列顺序 left center right
                                    cancelBtnText: "",    // 取消按钮文字
                                    successBtnText: w[language].BUTTON_OK,  // 确定按钮文字
                                    successBtnModal: true, // 点击确定按钮是否关闭弹窗 true 关闭 false 不关闭
                                    cancelBtnModal: true, // 点击取消按钮是否关闭弹窗 true 关闭 false 不关闭
                                    successCallback: function () {

                                    },
                                    cancelCallback: function () {

                                    }
                                });
                            } else {
                                alert(data.msg);
                            }
                        }, 'json');

                    }
                });

            },
            clickReport: function () {
                $('.dialog-close .icon-close').click(function () {
                    $('#reportDialog').hide();
                });
                $('#reportDialog').show();
                $('.custom-checkbox').click(function () {
                    $('.custom-checkbox').removeClass('active');
                    $(this).addClass('active');
                });
                $("#submit_report").click(function () {
                    var email = $('#report-email').val();
                    var type = $('div .active').html();
                    var message = $('#report-content').val();
                    var app_id = DAFU.APP.id;
                    var app_name = DAFU.APP.app_name;
                    if (!email) {
                        $('.email-error').show();
                        return false;
                    } else {
                        $('.email-error').hide();
                    }
                    if (!type) {
                        $('.type-error').show();
                        return false;
                    } else {
                        $('.type-error').hide();
                    }
                    if (!message) {
                        $('.message-error').show();
                        return false;
                    } else {
                        $('.message-error').hide();
                    }
                    $('#report-sending').show();
                    $.post('/source/index/ajax.php?ac=report', {
                        email: email,
                        type: type,
                        message: message,
                        app_id: app_id,
                        app_name: app_name
                    }, function (data) {
                        $('#report-sending').hide();
                        if (data.code == 200) {
                            $('#report-form').hide();
                            $('#report-feedback').show();
                        } else {
                            alert(data.msg);
                        }
                    }, 'json');

                });

            },
            showPopup: function () {
                var browser = {
                    versions: function () {
                        var u = navigator.userAgent, app = navigator.appVersion;
                        return {
                            trident: u.indexOf('Trident') > -1,
                            presto: u.indexOf('Presto') > -1,
                            webKit: u.indexOf('AppleWebKit') > -1,
                            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,
                            mobile: !!u.match(/AppleWebKit.*Mobile.*/) || !!u.match(/AppleWebKit/) && u.indexOf('QIHU') && u.indexOf('Chrome') < 0,
                            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                            android: u.indexOf('Android') > -1 || u.indexOf('Adr') > -1,
                            iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1,
                            iPad: u.indexOf('iPad') > -1,
                            webApp: u.indexOf('Safari') == -1,
                            ua: u
                        };
                    }(),
                    language: (navigator.browserLanguage || navigator.language).toLowerCase()
                };
                var weixin, weibo, isQQ, isiOS, isAndroid = false;
                if (browser.versions.mobile) {//判断是否是移动设备打开。browser代码在下面
                    var ua = navigator.userAgent.toLowerCase();//获取判断用的对象
                    if (ua.match(/MicroMessenger/i) == "micromessenger") {
                        weixin = true;
                    }

                    if ($.ua.browser.name.match(/WeChat/i)) {
                        weixin = true;
                    }

                    if (ua.match(/WeiBo/i) == "weibo") {
                        weibo = true;
                    }
                    if (ua.match(/QQ/i) == 'qq' && navigator.userAgent.indexOf("MQQBrowser") < 0) {
                        isQQ = true;
                    }

                    if ($.ua.os.name.match(/iOS/i)) {
                        isiOS = true;
                    }
                    if ($.ua.os.name.match(/android/i)) {
                        isAndroid = true;
                    }
                }
                var appType = (this.APP.ext == 'ipa') ? 'ios' : 'android';
                if (weixin == true) {
                    if (isiOS == true) {
                        $("#weixin_ios").show();
                        $("#weixin_android").hide();
                    } else {
                        $("#weixin_ios").hide();
                        $("#weixin_android").show();
                    }
                    return false;
                }

                if (isQQ) {
                    if (isiOS == true) {
                        $("#weixin_ios").show();
                        $("#weixin_android").hide();
                    } else {
                        $("#weixin_ios").hide();
                        $("#weixin_android").show();
                    }
                    return false;
                }

                if (appType == 'android' && isiOS) {
                    $('.down_load').attr('href', '#none').click(function () {
                        alert('该app只适用于android设备');
                        return false;
                    });
                } else if (appType == 'ios' && !isiOS) {
                    $('.down_load').attr('href', '#none').click(function () {
                        alert('该app只适用于IOS设备');
                        return false;
                    });
                } else {
                    var app_source = this.APP.source;
                    $('.down_load').click(function () {
                        var a = $.ua.browser.name;
                        var b = $.ua.device.type;
                        $(this).attr('style', 'display:none !important');
                        $("#showtext").show();
                        var c = a.match(/safari/gi);
                        var d = b.match(/mobile/gi);
                        if (c && d && "ios" == appType && app_source != 3) {
                            setTimeout(function () {
                                $("#showtext").hide();
                                var a = $("<a href='/static/app/app.mobileprovision' class='ms-btn template-btn clearfix pc-pwd' style='display:block;background-color:#40acf1; border: 1px solid #40acf1;margin: 15px'>" + w[language].TRUST_DEVELOPER + "</a>");
                                $("#showtext").after(a);
                            }, 6000);
                        }
                    });
                }
            }, weixin: function () {
                wx.config({
                    debug: false,
                    appId: this.signPackage["appId"],
                    timestamp: this.signPackage["timestamp"],
                    nonceStr: this.signPackage["nonceStr"],
                    signature: this.signPackage["signature"],
                    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ']
                });
                var this_app = this.APP;
                wx.ready(function () {
                    wx.onMenuShareAppMessage({
                        title: this_app.app_name,
                        desc: decodeURIComponent(encodeURIComponent('版本：' + this_app.version + '.' + this_app.version_code + '  大小：' + this_app.app_size).replace(/\+/g, '%20')),
                        link: "https://m.aeiuui.cn/" + this_app.url,
                        imgUrl: "https:" + this_app.icon_300
                    });
                    wx.onMenuShareTimeline({
                        title: this_app.app_name,
                        desc: decodeURIComponent(encodeURIComponent('版本：' + this_app.version + '.' + this_app.version_code + '  大小：' + this_app.app_size).replace(/\+/g, '%20')),
                        link: "https://m.aeiuui.cn/" + this_app.url,
                        imgUrl: "https:" + this_app.icon_300
                    });
                    wx.onMenuShareQQ({
                        title: this_app.app_name,
                        desc: decodeURIComponent(encodeURIComponent('版本：' + this_app.version + '.' + this_app.version_code + '  大小：' + this_app.app_size).replace(/\+/g, '%20')),
                        link: "https://m.aeiuui.cn/" + this_app.url,
                        imgUrl: "https:" + this_app.icon_300
                    });
                });
            },
            submitPwd: function () {
                url = this.getQuerySetting();
                password = $("input[name='pwd']").val();
                // 验证密码是否正确
                $.getJSON('/source/index/ajax.php?ac=check-password', {url: url, password: password}, function (data) {
                    if (data.code == 200) {
                        window.location.href = '/' + url + '?password=' + password;
                    } else {
                        $("#autoHideTemplateModal").find(".modal-dialog").addClass("modal-sm").find(".auto-hide .mt5").text(w[language].PASSWORD_WRONG);
                        autoHideModal('#autoHideTemplateModal', 3000);
                    }
                });

                //window.location.href = '/' + this.getQuerySetting() + '?password=' + $('#password').val();
            },
            showProvision: function () {
            }
        },
            DAFU.init(), DAFU.query();
    })
}).call(this);
