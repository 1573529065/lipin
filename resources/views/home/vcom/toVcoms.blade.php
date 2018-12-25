<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('home//css/jquery.mobile-1.4.5.css')}}"/>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.form.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.validate.min.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <script>

    </script>
    <style>
        *, body {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            text-align: center;
        }

        div.adDiv {
            height: 70px;
            border: 1px solid #ccc;
            width: 100%;

        }

        .mybtn {
            height: 55px;
            text-align: center;
        }

    </style>

</head>

<body>
<div data-role="page" id="vcomsPage">
    <script>
        var path = "";

        function toVisitReq(id) {
            $.ajax({
                url: path + "/visit/hasFinishedInfo.php",
                type: 'post',
                success: function (result) {
                    var resultCode = result.resultCode;
                    if (resultCode == '1') {
                        window.location.href = path + "/visit/toVisitReq.php?id=" + id;
                    }
                    else {
                        showMyPopup("对不起,你必须先完善公司信息!", 0);
                    }

                }
            })
        }


        //var li="<li><div><span style='font-weight:bold;padding-left:2px;'>受访公司:</span><span style='font-weight:bold;color:blue;padding-left:4px;'>{0}</span><a style='float:right;font-weight:bold;color:blue;font-size:0.8em;'class='ui-btn ui-btn-inline ui-btn-corner' href='/visit/toVisitReq.php?id={2}' data-ajax='false'>申请拜访</a></div><div style='overflow:hidden;'><span style='font-weight:bold;padding-left:2px;'>受访人职务:</span><span style='font-weight:bold;color:blue;padding-left:4px;'>{1}</span></div></li>";
        var li = "<li><div><span style='font-weight:bold;padding-left:2px;'>受访公司:</span><span style='font-weight:bold;color:blue;padding-left:4px;'>{0}</span><a style='float:right;font-weight:bold;color:blue;font-size:0.8em;'class='ui-btn ui-btn-inline ui-btn-corner' onclick='toVisitReq({2})'>申请拜访</a></div><div style='overflow:hidden;'><span style='font-weight:bold;padding-left:2px;'>受访人职务:</span><span style='font-weight:bold;color:blue;padding-left:4px;'>{1}</span></div></li>";

        function initVcomps() {
            var $ul = $("#vcoms");
            $ul.empty();
            $.ajax({
                url: path + "/vcom/findVcoms.php",
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var vcoms = map.data;
                        for (var i = 0; i < vcoms.length; i++) {
                            var vcom = vcoms[i];
                            var tli = li.replace("{0}", vcom.companyName);
                            tli = tli.replace("{1}", vcom.contactorTitle);
                            tli = tli.replace("{2}", vcom.id);
                            $ul.append(tli);
                        }
                        $ul.listview("refresh");
                    }
                }
            });
        }

        function getVisitQty() {
            $.ajax({
                url: path + "/visit/findFinishedQty.php",
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        $("#visitQty").html(map.data.finishQty);
                        $("#purchaseQty").html(map.data.realQty);
                    } else {
                        showMyPopup("获取统计数据异常!", 0);
                    }
                }
            });
        }

        var purl = "/bill/toPub.php";

        function bindPubBtnEvent() {

            $(".pub").click(function (event) {
                $.ajax({
                    url: path + "/user/hasRealize.php",
                    async: false,
                    success: function (result) {
                        var resultCode = result.resultCode;
                        if (resultCode == '1') {
                            goTo(purl);
                        } else if (resultCode == '-1') {
                            showMyPopup("<font color='red'>对不起,你尚未通过采购认证!</font><br/><font><a href='/ucenter/toCenter.php'>请到个人中心进行实名！</a></font>", 0);

                        } else {
                            showMyPopup("服务器异常,稍后再试!", 0);

                        }
                    }
                });
            });
        }

        $(document).on("pageinit", "#vcomsPage", function () {
            initVcomps();
            getVisitQty();
            bindPubBtnEvent();
        });
    </script>
    <!-- <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div> -->
    <div class="adDiv">


        <img src="{{asset('home/images/ad0.jpg')}}" style="height:68px;width:99%;">


    </div>

    <div role="main" class="ui-content" style="padding:0px;font-size:0.75em;margin:0.1em 0.5em 0.1em 0.5em;">
        <div style="height:3em;text-align:center;line-height:2em;">
            <span style="font-weight:bold;margint-right:1em;">累计成功拜访:</span>【<span id="visitQty"
                                                                                   style="font-weight:bold;color:red;"></span>】人次,<span
                    style="font-weight:bold;">共计:【<font id="purchaseQty" style="color:red;"></font>】位采购入驻！</span>
        </div>
        <div class="ui-grid-a">
            <!--
                <div class="ui-block-a"><a href="#showInfoPage" class="ui-btn" data-transition="flip">说明</a></div>
                <div class="ui-block-b"><a href="/vcom/toFinishComp.php" class="ui-btn" data-ajax="false" data-transition="flip">公司信息完善</a></div>
             -->


            <div class="ui-block-a" style="text-align:center;">
                <a href="#showInfoPage" data-ajax="false" data-rel="dialog" data-transition="flip">
                    <img src="{{asset('home/images/btn_bf1.png')}}" style="width:50%;height:50%;">
                </a>
            </div>
            <div class="ui-block-b" style="text-align:center;">
                <a href="/vcom/toFinishComp.php" data-ajax="false" data-rel="dialog" data-transition="flip">
                    <img src="{{asset('home/images/btn_bf2.png')}}" style="width:50%;height:50%;">
                </a>
            </div>

        </div>
        <ul data-role="listview" id="vcoms" data-inset="true" data-filter="true" data-filter-placeholder="查询">

        </ul>
    </div>
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar">
            <ul>
                <li><a href="{{url('/index')}}" data-ajax="false" data-rel="dialog">采购列表</a></li>
                <li><a href="{{url('/suppli')}}" data-ajax="false" data-rel="dialog" data-transition="flip">供应商库</a>
                </li>
                <li><a href="{{url('/vcom/toVcoms')}}" data-ajax="false" data-rel="dialog"
                       class="ui-btn-active ui-state-persist" data-transition="flip">拜访采购</a></li>


                <li><a href="{{url('/ucenter/toCenter')}}" data-ajax="false" data-rel="dialog" data-transition="flip">个人中心</a>
                </li>
            </ul>
        </div>

    </div>
</div>
<div data-role="page" id="showInfoPage">
    <div data-role="header">
        <h2>说明</h2>
        <a data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <p style="color: red;font-weight:bold;font-size:0.75em;">
            申明:
            <br/>
        <hr/>
        所有受访企业均经平台审核认证，可放心发起拜访申请。
        </p>
        <br/>
        <hr/>
        <br/>
        <p style="font-weight:bold;font-size:0.75em;">
            说明：<br/>
        <hr/>
        1.供应商向采购方发起拜访申请。<br/>
        2.申请后3小时内若无答复则退还金币。<br/>
        3.被婉拒的拜访申请金币也会退还。<br/>
        4.被采购方接受后可个人中心查看联系人方式，进行线下约访。<br/>
        <br/>
        <hr/>
        备注：
        <br/>

        <font style="color:red;">1.每次申请所需基本消耗100金币，可以追加10-50金币</font><br/>
        <font style="color:red;">2.联盟提供代邀约服务【客服微信】13140901395</font>
        </p>
    </div>
</div>

</body>
</html>