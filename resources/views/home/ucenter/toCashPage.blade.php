<!DOCTYPE html>
<html>
<head>
    <title>金币提现</title>
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
            list-style: none;
        }
    </style>
</head>

<body>

<div data-role="page" id="cashPage">
    <script type="text/javascript">
        var path = "";
        $(document).on("pageinit", "#cashPage", function () {
            $("#cashForm").validate({
                rules: {
                    gold: {
                        required: true,
                        min: 100
                    },
                    alipayAccount: {
                        required: true
                    },
                    alipayName: {
                        required: true
                    }
                },
                messages: {
                    gold: {
                        required: "<font style='color:red;font-size:0.75em;'>金币数必须填写!</font>",
                        min: "最少100个金币!"
                    },
                    alipayAccount: {
                        required: "<font style='color:red;font-size:0.75em;'>支付宝账户必须填写!</font>"
                    },
                    alipayName: {
                        required: "<font style='color:red;font-size:0.75em;'>支付宝姓名必须填写!</font>"
                    }
                }
            });

            $("#cash_form_gold").bind("change", function () {
                var val = $(this).val();
                val = parseInt(val);
                $("#cash_form_money").val(Math.floor(val * 0.7));
            });
            $("#addCashBtn").bind("click", function () {

                var $form = $("#cashForm");
                if ($form.valid()) {
                    $form.ajaxSubmit({
                        url: path + "/ucenter/addCash.php",
                        dataType: "json",
                        type: "post",
                        success: function (map) {
                            var resultCode = map.resultCode;
                            if (resultCode == '1') {
                                showMyPopup("申请成功!", 0);
                                window.location.href = path + "/ucenter/toCenter.php";
                            } else if (resultCode == '-1') {
                                showMyPopup("<font color='red'>对不起你的金币数不足!</font><br/><font><a href='/ucenter/toChargePage.php'>请到个人中心充值</a></font>", 0);
                            } else {
                                showMyPopup("申请失败!", 1);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <div data-role="header">
        <h2>金币提现</h2>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <form id="cashForm">
            <div>
                <input type="number" required="true" data-role="none" min="100"
                       style="text-decoration: none;border-radius:5px;height:2em;" placeholder="提现金币至少100金币"
                       id="cash_form_gold" name="gold"/><span
                        style="margin-left:0.5em;font-weight:bold;font-size:0.75em;">你有[0]金币</span>
            </div>
            <input type="text" placeholder="到账金额" readonly="readonly" id="cash_form_money" name="price"/>
            <input type="text" placeholder="支付宝账号" id="cash_form_alipay_account" name="alipayAccount"/>
            <input type="text" placeholder="支付宝姓名" id="cash_form_alipay_name" name="alipayName"/>
            <a href="#" data-role="button" id="addCashBtn" class="ui-btn ui-btn-inline">提交</a>
        </form>

        <div style="font-size:0.5em;color:red;">
            <p>友情提示:</p>
            <p>1.到账金额为扣除30%手续费后的实际金额</p>
            <p>2.申请提现后24小时到账(法定节假日除外)</p>
        </div>
    </div>
</div>
</body>
</html>