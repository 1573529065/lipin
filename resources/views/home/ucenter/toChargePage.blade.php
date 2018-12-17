<!DOCTYPE html>
<html>
<head>
    <title>金币充值</title>
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

<div data-role="page" id="chargePage">
    <script type="text/javascript">
        var path = "";
        $(document).on("pageinit", "#chargePage", function () {
            $("#mkOrderBtn").hide();
            $("#money").val("");
            $("#gold").bind("change", function () {
                var val = $(this).val();
                if (val == '0') {
                    $("#mkOrderBtn").hide();
                    $("#money").val("");
                } else {
                    $("#money").val(val + "元");
                    $("#mkOrderBtn").show();
                }
            });
        });


        function makeOrder() {
            $("#makeOrderForm").ajaxSubmit({
                type: "post",
                dataType: "json",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        goTo(path + '/wxpay/toShowOrder.php');
                    }
                    else {

                        showMyPopup("生成订单失败,请稍后再试!", 0);
                    }
                }
            });
        }
    </script>
    <div data-role="header">
        <h2>金币充值</h2>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <form id="makeOrderForm" action="/wxpay/makeOrder.php">
            <select name="score" id="gold">
                <option value="0">--选择金币数--</option>
                <option value="10">10金币</option>
                <option value="20">20金币</option>
                <option value="50">50金币</option>
                <option value="100">100金币</option>
            </select>

            <input type="text" name="money" id="money" readonly="readonly"/>
            <a href="#" data-role="button" id="mkOrderBtn" onclick="makeOrder();" class="ui-btn ui-btn-inline">我要充值</a>
        </form>
        <div style="color:red;padding-left:2em;font-size:0.75em;">
            友情提醒:请关注公众号buyerunion进行充值
        </div>
    </div>
</div>
</body>
</html>