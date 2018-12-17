<!DOCTYPE html>
<html>
<head>
    <title>已发采购信息</title>
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

        span.sbold {
            font-weight: bold;
        }

        ul {
            border: 1px solid #ccc;
            margin: 1em;

        }

        ul li {
            border-bottom: 1px solid #ccc;
            margin-top: 5px;
            list-style: none;
        }
    </style>
</head>

<body>

<div data-role="page" id="myPurchaseBillsPage">
    <script type="text/javascript">
        var path = "";

        function stopPub(id) {
            $.ajax({
                url: path + "/bill/stopPubPurchaseBill.php",
                data: {id: id},
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        window.location.href = path + "/ucenter/toMyPurchaseBills.php";
                    } else {
                        showMyPopup("停止发布采购单失败!", 0);
                    }
                }

            });
        }

        var tr = "<li><p><span class='sbold'>发布时间:</span><span style='margin-left:5px;'>{0}</span> {4} <a style='float:right'>好评: {1} 次</a></p><p><span class='sbold'>采购标题:</span><span style='margin-left:5px;'>{2}</span> <a style='float:right'>差评: {3} 次</a></p></li>"
        var mya = "<a href='#' data-role='button' style='margin-left:1.5em;line-height:0.75em;' class='ui-btn ui-btn-inline' onclick='stopPub({0})'>终止采购</a>"

        function listBills(bills) {
            var $list = $("#myPurchaseBillsList");
            $list.empty();
            for (var i = 0; i < bills.length; i++) {
                var bill = bills[i];
                var status = bill.status;
                var mtr = tr.replace("{0}", bill.pubTimeStr);
                mtr = mtr.replace("{1}", bill.goodCommentQty);
                mtr = mtr.replace("{2}", bill.title);
                mtr = mtr.replace("{3}", bill.badCommentQty);
                if (status == '1') {
                    var ma = mya.replace("{0}", bill.id);
                    mtr = mtr.replace("{4}", ma);
                } else {
                    mtr = mtr.replace("{4}", "");
                }
                $list.append($(mtr));
            }
            $list.listview("refresh");
        }

        function getMyPurchaseBills() {
            $.ajax({
                url: path + "/bill/listMyBills.php",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        listBills(map.data);
                        var info = map.billInfoMap;
                        $("#totalBillQty").html(info.totalBillQty);
                        $("#finishedQty").html(info.finishedQty);
                        $("#goingQty").html(info.goingQty);
                        $("#goodCommentQty").html(info.goodCommentQty);
                        $("#badCommentQty").html(info.badCommentQty);
                    } else {
                        showMyPopup("获取数据发生异常!", 1);
                    }
                }
            });
        }

        $(document).on("pageinit", "#myPurchaseBillsPage", function () {
            getMyPurchaseBills();
        });
    </script>
    <div data-role="header">
        <h1>已发采购信息</h1>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>

    <div role="main" class="ui-content" style="padding:0.2em;">
        <div>
            <div style="margin-top:0.5em;text-align:center;"><span class="sbold">共计发布</span>:<font
                        id="totalBillQty">10</font> 条, <span class="sbold">进行中</span>:<font id="goingQty">1</font>
                条,<span class="sbold">已完成</span>: <font id="finishedQty">9</font>条
            </div>
            <div style="margin-top:0.5em;text-align:center;"><span class="sbold">评价数据</span> 好评: <span
                        class="sbold"><font color="green" id="goodCommentQty"> 10 </font> 次, 差评: <font color="red"
                                                                                                       id="badCommentQty">3</font> 次</span>
            </div>

            <ul data-role="listview" id="myPurchaseBillsList" style="margin-top:1em;" data-inset="true">
                <!-- <li>
                    <p>	<span class="sbold">发布时间:</span><span style="margin-left:5px;">2017-09-15 02:30</span> <a style="float:right">好评: 0 次</a></p>
                    <p>	<span class="sbold">采购标题:</span><span style="margin-left:5px;">骑着老虎去逛街！</span> <a style="float:right">差评: 1 次</a></p>
                </li> -->

            </ul>
        </div>

    </div>

    <div data-role="footer" data-position="fixed">
        <div style="width:100%;height:70px;">
            <img src="{{asset('home/images/ad1.jpg')}}" style="height:70px;width:100%;">
        </div>
    </div>
</div>

</body>
</html>