<!DOCTYPE html>
<html>
<head>
    <title>销售与采购联盟</title>
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
        }

        li p {
            padding-left: 1em;
        }

        li {
            padding-top: 0.2em;
            padding-bottom: 0.2em;
        }
    </style>
</head>

<body>

<div data-role="page" id="listBillsPage">
    <script type="text/javascript">
        var path = "";
        //	var li = "<li><p style='font-size:1em;font-weight:bold;'>{0}</p><p style='font-size:0.75em;'><span>需求城市:{1}</span><a href='{2}' data-ajax='false' data-transition='flip' style='float:right;font-size:1em;font-weight:bold;margin-right:1em;'>查看详情</a> </p><p style='font-size:0.75em;height:1.5em;'>发布时间:{3}</p>";
        //	var li = "<li><p style='font-size:1em;font-weight:bold;'>{0}</p><p style='font-size:1em;margin-top:0.2em;'><span>需求城市:{1}</span><a href='{2}' data-ajax='false' data-transition='flip' style='float:right;font-size:0.75em;font-weight:bold;margin:0.1em;border:1px solid blue;height:1.5em;'>查看详情</a> </p>";
        var li = "<li><p style='font-size:1em;font-weight:bold;'>{0}</p><p style='font-size:1em;margin-top:0.2em;'><span>需求城市:{1}</span><a href='{2}' data-ajax='false' data-transition='flip' style='float:right;font-size:0.75em;font-weight:bold;margin:0.1em;width:60px;height:20px;)'></a> </p>";

        function fillList(data) {
            var $list = $("#billList");
            $list.empty();
            if (data == undefined || $.isEmptyObject(data)) {
                return;
            } else {
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var bill = data[i];
                        var mli = li.replace("{0}", bill.title);
                        mli = mli.replace("{1}", bill.addr);
                        var url = path + "/index/toDetailDemand.php?id=" + bill.id;
                        mli = mli.replace("{2}", url);

                        //	mli = mli.replace("{3}",index.pubTimeStr);
                        var $li = $(mli);
                        $li.find('a:last').css('backgroundImage', 'url(../../images/click1.png)');
                        $list.append($li);
                    }
                }
            }
            $list.listview("refresh");
        }

        function getPurchaseBills() {
            $.ajax({
                url: path + "/index/listBills.php",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        fillList(map.data);
                    } else {
                        showMyPopup("获取数据发生异常!", 0);
                    }
                }
            });
        }

        //var cnt = 0;
        //function changeImg(){
        //	cnt++;
        //	$("#ad_img").attr("src",path+"/images/ad"+(cnt%2)+".jpg?t="+new Date().getTime());
        //}


        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b50d61958cf8e7ca6fc482c691187904";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();


        var purl = "/index/Bill.php;


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
                            showMyPopup("<font color='red'>对不起,你尚未实名制!</font><br/><font><a href='/ucenter/toCenter.php'>请到个人中心进行实名！</a></font>", 0);

                        } else {
                            showMyPopup("服务器异常,稍后再试!", 0);

                        }
                    }
                });
            });
        }

        $(document).on("pageinit", "#listBillsPage", function () {
            var path = "";
            var cnt = 0;
            bindPubBtnEvent();
            getPurchaseBills();
            setInterval(function () {
                //	changeImg();
                cnt++;
                $("#ad_img").attr("src", path + "/images/ad" + (cnt % 2) + ".jpg?t=" + new Date().getTime());
            }, 5000);


        });
    </script>

    <div role="main" class="ui-content" style="padding:0.2em;">
        <div style="border:1px dashed #ccc;height:72px;width:100%;margin-right:5px;">
            <!--
            <a href="http://www.hdb.com/party/ixmm2.html"> -->
            <img src="{{asset('home/images/ad1.jpg')}}" id="ad_img" style="width:100%;height:100%;">
            <!--</a>-->
        </div>
        <section>


            <!-- <div class="ui-grid-a">

                <div class="ui-block-b" style="text-align:center;padding-left:2em;">
                    <a href="#showInfoPage"  class="ui-btn ui-btn-inline" data-ajax="false" data-transition="flip">
                        信息説明
                    </a>
                </div>
                <div class="ui-block-a" style="text-align:center;padding-left:2em;">
                    <a href="" data-ajax="false" class="pub ui-btn ui-btn-inline" data-rel="dialog"  data-transition="flip">发布采购</a>

                </div>

            </div> -->


            <div class="ui-grid-a">
                <div class="ui-block-a" style="text-align:center;">
                    <a href="#showInfoPage" data-ajax="false" data-rel="dialog" data-transition="flip">
                        <img src="{{asset('sm_btn.png')}}" style="width:50%;height:50%;">
                    </a>
                </div>
                <div class="ui-block-b" style="text-align:center;">
                    <a href="" data-ajax="false" class="pub" data-rel="dialog" data-transition="flip">
                        <img src="{{asset('fb_btn.png')}}" style="width:50%;height:50%;">
                    </a>
                </div>

            </div>


            <hr style="background-color:blue;height:0.2em;"/>


        </section>
        <div style="padding-left:1em;margin-top:0.5em;text-align:center;">
            <font style="color:blue;margin-left:0em;">正在采购 ：16条</font><font style="margin-left:1em;">共计采购: 1134条</font>
            <!-- <a style="float:right;    float: right;margin-right: 0em;margin-top: -0.65em;height: 14px;background-color: #33b7cc;color:red;" href="#showInfoPage" data-role="button" data-mini="true" data-transition="flip">信息说明</a> -->
        </div>
        <ul data-role="listview" id="billList" data-filter="true" data-inset="true" data-filter-placeholder="查询">


        </ul>
    </div>

    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar">
            <ul>
                <li><a href="/bill/toMain.php" data-ajax="false" data-rel="dialog"
                       class="ui-btn-active ui-state-persist" data-transition="flip">采购列表</a></li>
                <li><a href="/supplier/toSupplierMgr.php" data-ajax="false" data-rel="dialog" data-transition="flip">供应商库</a>
                </li>
                <li><a href="/vcom/toVcoms.php" data-ajax="false" data-rel="dialog" data-transition="flip">拜访采购</a></li>

                <!-- 	<li><a href="" data-ajax="false" class="pub" data-rel="dialog"  data-transition="flip">发布采购</a></li> -->

                <li><a href="/ucenter/toCenter.php" data-ajax="false" data-rel="dialog" data-transition="flip">个人中心</a>
                </li>
            </ul>
        </div>
        <div style="align:center;line-height:2em;font-size:0.5em;margin-left:8em;">
            <a href="http://www.miibeian.gov.cn">苏ICP备17016930号-2</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;版权：苏州人脉汇网络科技有限公司
        </div>
    </div>
</div>

<div data-role="page" id="showInfoPage">
    <div data-role="header">
        <h3>关于平台查看信息说明</h3>
        <a data-rel="back" data-icon="back">返回</a>
    </div>
    <div data-role="main" class="ui-content">
        <p style="font-weight:bold;font-size:0.5em;">
            <br/>
        <hr/>
        1. 所有信息均为在职采购亲自发布<br/>
        2. 所有信息均有有效期（7天、10天、15天）<br/>
        3. 如遇所查看的信息采购方说（已经完成采购、已经不再采购、等）可以联系微信客服核实后退还金币；客服微信：xszygxlm02
        </p>
        <br/>
        <hr/>
        <p style="color:red;font-weight:bold;font-size:0.6em;">
            备注：
            <br/>
            原则上联盟要求采购方有义务完成采购后及时下架信息，但是由于采购工作较为繁忙很多采购方会遗忘，所以请大家如果有相关投诉及时联系微信客服，同时也请大家第一时间查看信息与采购方联系。
        </p>
        <br/>
        <hr/>
        <p style="color:red;font-weight:bold;font-size:0.6em;">
            友情提示：
            <br/>
            联盟是一个帮助大家高效、精准沟通采购方为目的，不是一个直接让你花十几元就能成交的平台！慎用！
        </p>
    </div>
</div>
</body>
</html>