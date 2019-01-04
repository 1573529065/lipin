<!DOCTYPE html>
<html>
<head>
    <title>用户注册</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>

    <script type="text/javascript" src="{{asset('/home/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.form.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/jquery.validate.min.js')}}"></script>

    <script src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <script src="{{asset('home/js/jquery.cookie.js')}}"></script>

    <style>
        *, body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

<div id="regPage" data-role="page">
    <script type="text/javascript">
        var path = "";
        $(document).on("pageinit", "#regPage", function () {
            $("#regButton").hide();
            $("#agreement").removeAttr("checked");
            jQuery.validator.addMethod("mobile", function (value, element) {
                var pattern = /^1[3|4|5|7|8]\d{9}$/gi;
                return this.optional(element) || (pattern.test(value));
            }, "非法的手机号码!");
            jQuery.validator.addMethod("isAgree", function (value, element) {
                //	alert($(this).attr('checked'));
                return this.optional(element) || $(this).attr('checked') == 'checked';
            }, "必须同意协议!");
            $("#agreement").on("click", function () {
                var checked = $(this).attr("checked");
                if (checked == undefined) {
                    $(this).attr("checked", "checked");
                    $("#regButton").show();
                } else {
                    $(this).removeAttr("checked");
                    $("#regButton").hide();
                }
            });
            /*仿刷新：检测是否存在cookie*/
            if ($.cookie("captcha")) {
                var count = $.cookie("captcha");

                var btn = $('#getting');
                btn.val(count + '秒后可重新获取').attr('disabled', true).css('cursor', 'not-allowed');
                var resend = setInterval(function () {
                    count--;
                    if (count > 0) {
                        btn.val(count + '秒后可重新获取').attr('disabled', true).css('cursor', 'not-allowed');
                        $.cookie("captcha", count, {path: '/', expires: (1 / 86400) * count});
                    } else {
                        clearInterval(resend);
                        btn.val("获取验证码").removeClass('disabled').removeAttr('disabled');
                    }
                }, 1000);
            }

            /*点击改变按钮状态，已经简略掉ajax发送短信验证的代码*/
            $('#getting').click(function () {
                var btn = $(this);
                var mobile = $.trim($("#reg_mobile").val());
                if (mobile != '') {
                    $.ajax({
                        url: path + '/user/getCheckCode.php',
                        data: {mobile: mobile},
                        success: function (data) {
                        }
                    });
                }
                var count = 60;
                var resend = setInterval(function () {
                    count--;
                    if (count > 0) {
                        btn.val(count + "秒后可重新获取");
                        $.cookie("captcha", count, {path: '/', expires: (1 / 86400) * count});
                    } else {
                        clearInterval(resend);
                        btn.val("获取验证码").removeAttr('disabled');
                    }
                }, 1000);
                btn.attr('disabled', true).css('cursor', 'not-allowed');
            });

            $("#regForm").validate({
                rules: {
                    mobile: {
                        required: true,
                        mobile: true
                    },
                    yzm: {
                        required: true
                    },
                    nickName: {
                        required: true
                    },
                    pwd: {
                        required: true
                    }/* ,
						agreement:{
							required:true,
							isAgree:true
						} */
                },
                messages: {
                    mobile: {
                        required: '手机号码必须填写!',
                        mobile: '手机号码不合法!'
                    },
                    yzm: {
                        required: '验证码必须填写!'
                    },
                    nickName: {
                        required: '昵称必须填写!'
                    },
                    pwd: {
                        required: '密码必须填写!'
                    }/* ,
						agreement:{
							required:'必须选择协议!',
							isAgree:'必须同意协议!'
						} */
                }
            });

        });

        function registerUser() {

            if ($("#regForm").valid()) {
                $("#regForm").ajaxSubmit({
                    url: "{{url('/user/registerUser')}}",
                    type: "post",
                    dataType: "json",
                    success: function (map) {
                        var resultCode = map.resultCode;
                        //	alert(map);
                        // console.log(resultCode);
                        // return false;
                        if (resultCode == '1') {
                            window.location.href = "{{url('/user/toLogin')}}";
                        } else if (resultCode == '-1') {
                            //	$("#show_dialog_content").html("验证码必须填写!");
                            //	goTo('#showDiag');
                            showMyPopup("验证码必须填写!", 1);
                        } else if (resultCode == '-2') {
                            //	$("#show_dialog_content").html("验证码不准确!");
                            //	goTo('#showDiag');
                            showMyPopup("验证码不准确!", 1);
                        } else if (resultCode == '-3') {
                            //	$("#show_dialog_content").html("注册失败,此手机号码已经存在了!");
                            //	goTo('#showDiag');
                            showMyPopup("注册失败,此手机号码已经存在了!", 1);
                        } else {
                            //$("#show_dialog_content").html("服务器忙！稍后再试！");
                            //goTo('#showDiag')
                            showMyPopup("服务器忙！稍后再试！", 0);
                        }
                    }
                });
            }

        }
    </script>
    <div data-role="header">
        <h2>用户注册</h2>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">

        <form method="post" id="regForm">
            <input type="text" name="mobile" id="reg_mobile" placeholder="手机号码" class="required"/>

            <div>
                <input type="text" name="checkCode" id="yzm" placeholder="验证码"
                       class="required" data-role="none" style="width: 50%;"/>
                <input id="getting" value="获取验证码" data-role="none" type="button" style="width: 35%">
            </div>

            <input type="text" name="nickName" id="reg_nickName" placeholder="昵   称"/>
            <input type="password" name="pwd" id="reg_pwd" placeholder="密   码"/>

            <input type="checkbox" id="agreement" name="agreement" data-role="none"/>
            <label for="agreement" style="display: inline;">用户违反法律法规造成的后果，本平台不承担任何责任！</label>

            <div class="reg_btn_div">
                <a href="#" id="regButton" onclick="registerUser();"
                   class="ui-btn ui-btn-inline" data-role="button" data-theme="a">注册</a>
                <a href="#loginPage" data-role="button" class="ui-btn ui-btn-inline" data-theme="c">取消</a>
            </div>
        </form>

    </div>
</div>
</body>
</html>