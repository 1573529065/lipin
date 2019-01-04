

<!DOCTYPE html>
<html>
<head>
    <title>用户登录</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script type="text/javascript"
            src="{{asset('home/js/jquery.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.form.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.validate.min.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <script src="{{asset('home/js/jquery.cookie.js')}}"></script>

    <style>
        *,body{
            margin:0;
            padding:0;
        }
    </style>
</head>

<body>

<div id="forgotPage" data-role="page">
    <script type="text/javascript">
        var path = "";
        $(document).on("pageinit","#forgotPage",function(){

            jQuery.validator.addMethod("mobile", function (value, element) {
                var pattern = /^1[3|5|7|8]\d{9}$/gi;
                return this.optional(element) || (pattern.test(value));
            }, "非法的手机号码!");

            /*仿刷新：检测是否存在cookie*/
            if($.cookie("captcha")){
                var count = $.cookie("captcha");
                var btn = $('#getting');
                btn.val(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');
                var resend = setInterval(function(){
                    count--;
                    if (count > 0){
                        btn.val(count+'秒后可重新获取').attr('disabled',true).css('cursor','not-allowed');
                        $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
                    }else {
                        clearInterval(resend);
                        btn.val("获取验证码").removeClass('disabled').removeAttr('disabled');
                    }
                }, 1000);
            }

            /*点击改变按钮状态，已经简略掉ajax发送短信验证的代码*/
            $('#getting').click(function(){
                var btn = $(this);
                var mobile=$.trim($("#forgot_mobile").val());
                if(mobile!=''){
                    $.ajax({
                        url:path+'/user/getCheckCode.php',
                        data:{mobile:mobile},
                        success:function(data){
                        }
                    });
                }
                var count = 60;
                var resend = setInterval(function(){
                    count--;
                    if (count > 0){
                        btn.val(count+"秒后可重新获取");
                        $.cookie("captcha", count, {path: '/', expires: (1/86400)*count});
                    }else {
                        clearInterval(resend);
                        btn.val("获取验证码").removeAttr('disabled');
                    }
                }, 1000);
                btn.attr('disabled',true).css('cursor','not-allowed');
            });

            $("#forgotForm").validate({
                rules:{
                    mobile:{
                        required:true,
                        mobile:true
                    },
                    yzm:{
                        required:true
                    },
                    pwd:{
                        required:true
                    }
                },
                messages:{
                    mobile:{
                        required:'手机号码必须填写!',
                        mobile:'手机号码不合法!'
                    },
                    yzm:{
                        required:'验证码必须填写!'
                    },
                    pwd:{
                        required:'密码必须填写!'
                    }
                }
            });

        });

        function updateUserPwd(){

            if($("#forgotForm").valid()){
                $("#forgotForm").ajaxSubmit({
                    url:path+"/user/updateUserPwd.php",
                    type:"post",
                    dataType:"json",
                    success:function(map){
                        var resultCode = map.resultCode;
                        if(resultCode == '1'){
                            window.location.href = path+'/user/toLogin.php';
                        }else if(resultCode=='-1'){
                            showMyPopup("验证码必须填写!",0);
                        }else if(resultCode=='-2'){
                            showMyPopup("验证码不正确",0);
                        }else{
                            showMyPopup("服务器忙！稍后再试！",0);
                        }
                    }
                });
            }

        }
    </script>
    <div data-role="header">
        <h2>忘记密码</h2>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <form method="post" id="forgotForm">
            <input type="text" name="mobile" id="forgot_mobile" placeholder="手机号码"
                   class="required" />

            <div>
                <input type="text" name="checkCode" id="yzm" placeholder="验证码"
                       class="required" data-role="none" style="width: 50%;" /> <input
                        id="getting" value="获取验证码" data-role="none" type="button"
                        style="width: 35%">
            </div>

            <input type="password" name="pwd"
                   id="forgot_pwd" placeholder="密   码"  class="required"/>

            <div>
                <a href="#" id="regButton" onclick="updateUserPwd();"
                   class="ui-btn ui-btn-inline" data-role="button" data-theme="a">确定</a>

            </div>
        </form>


    </div>
</div>
</body>
</html>