<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css"/>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.form.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.validate.min.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <style>
        *, body {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            text-align: center;
        }

        input {
            margin-top: 4px;
        }

        label {
            font-weight: bold;
        }
    </style>

</head>

<body>
<div data-role="page" id="finisCompPage">
    <script>
        var path = "";

        function finishComp() {
            var $form = $("#finishCompForm");
            if ($form.valid()) {
                $form.ajaxSubmit({
                    url: path + "/vcom/finishComp.php",
                    type: "post",
                    dataType: "JSON",
                    success: function (map) {
                        var resultCode = map.resultCode;
                        if (resultCode == '1') {
                            window.location.href = path + "/vcom/toVcoms.php";
                        } else {
                            showMyPopup("完善公司信息失败!", 0);
                        }
                    }
                });
            }
        }

        $(document).on("pageinit", "#finisCompPage", function () {
            jQuery.validator.addMethod("mobile", function (value, element) {
                var pattern = /^1[3|5|7|8]\d{9}$/gi;
                return this.optional(element) || (pattern.test(value));
            }, "非法的手机号码!");
            $("#finishCompForm").validate({
                rules: {
                    companyName: {
                        required: true
                    },
                    contactor: {
                        required: true
                    },
                    contactorTitle: {
                        required: true
                    },
                    contactorMobile: {
                        required: true,
                        mobile: true
                    },
                    mainProducts: {
                        required: true
                    },
                    companyDesc: {
                        required: true
                    }
                },
                messages: {
                    companyName: {
                        required: "<font style='color:red;font-size:0.75em;'>公司名必须填写</font>"
                    },
                    contactor: {
                        required: "<font style='color:red;font-size:0.75em;'>姓名必须填写</font>"
                    },
                    contactorTitle: {
                        required: "<font style='color:red;font-size:0.75em;'>职务必须填写</font>"
                    },
                    contactorMobile: {
                        required: "<font style='color:red;font-size:0.75em;'>联系电话必须填写</font>",
                        mobile: "<font style='color:red;font-size:0.75em;'>手机号码不合法</font>"
                    },
                    mainProducts: {
                        required: "<font style='color:red;font-size:0.75em;'>主营产品必须填写</font>"
                    },
                    companyDesc: {
                        required: "<font style='color:red;font-size:0.75em;'>公司简介必须填写</font>"
                    }
                }
            });
            $("#finishCompBtn").on("click", function () {
                finishComp();
            });
        });
    </script>
    <div data-role="header">
        <h2>公司信息完善</h2>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>

    <div role="main" class="ui-content">
        <form id="finishCompForm">
            <div data-role="fieldcontain">
                <input type="hidden" value="20650" name="id"/>
                <label for="f_companyName"><font style="font-size:0.75em;font-weight:bold;">公 司 名</font></label>
                <input type="text" name="companyName" value="1" id="f_companyName" placeholder="公司名称">
                <label for="f_name"><font style="font-size:0.75em;font-weight:bold;">联 系 人</font></label>
                <input type="text" name="contactor" value="2" id="f_name" placeholder=联系人"/>
                <label for="f_contactorTitle"><font style="font-size:0.75em;font-weight:bold;">职 务</font></label>
                <input type="text" name="contactorTitle" id="f_contactorTitle" value="3" placeholder="职务"/>
                <label for="f_contactorMobile"><font style="font-size:0.75em;font-weight:bold;">联系电话</font></label>
                <input type="text" name="contactorMobile" id="f_contactorMobile" value="15612341234"
                       placeholder="联系电话"/>
                <label for="f_mainProducts"><font style="font-size:0.75em;font-weight:bold;">主营产品</font></label>
                <input type="text" name="mainProducts" id="f_mainProducts" placeholder="主营产品" value="5"/>
                <label for="f_companyDesc"><font style="font-size:0.75em;font-weight:bold;">公司简介</font></label>
                <textarea rows="2" cols="10" name="companyDesc" id="f_companyDesc" placeholder="公司简介">6</textarea>

                <a href="#" data-role="button" id="finishCompBtn" style="margin-top:1em;margin-left:3em;"
                   class="ui-btn ui-btn-inline">提交</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>