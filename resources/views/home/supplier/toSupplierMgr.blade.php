<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>供应商库</title>

    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('home/css/jquery.mobile-1.4.5.css')}}"/>
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
        .ui-li-static.ui-li-has-thumb {
            padding-left: 5.25em;
        }

        .ui-content {
            padding-top: 0.2em;
        }

        .ui-input-text,
        .ui-input-search {
            width: 15em;
        }
    </style>
</head>
<body>
<div data-role="page" id="suppliersPage">
    <script type="text/javascript">
        var path = "";
        var supplierLi = "<li>" +
            "<a href='/supplier/toSupplierDetail.php?id={5}' data-ajax='false' data-transition='flip'>" +
            "<img src='http://zhizhum.com/supplierMgr/images/suppliers/logos/{0}.jpg' " +
            "style='margin-top:1.5em;margin-left:0.5em;border-radius:50%;width:4em;height:4em;'>" +
            "<h4>{1}</h4>" +
            "<p><span style='font-weight:bold;'>所在地:{2}</span></p>" +
            "<p>主营产品: {3}</p>" +
            "<p><span style='font-weight:bold;color:red;'>按合同金额的{4}发放福利金</span></p>" +
            "</a>" +
            "</li>";

        function getSuppliers() {
            var $list = $("#supplierList");
            $.ajax({
                url: path + "/supplier/findSuppliers.php",
                type: "post",
                success: function (res) {
                    var resultCode = res.resultCode;
                    if (resultCode == '1') {
                        $list.empty();
                        var suppliers = res.data;
                        for (var i = 0; i < suppliers.length; i++) {
                            var supplier = suppliers[i];
                            var li = supplierLi.replace("{0}", supplier.id);
                            li = li.replace("{5}", supplier.id);
                            li = li.replace("{1}", supplier.companyName);
                            li = li.replace("{2}", supplier.addr);
                            li = li.replace("{3}", supplier.mainProducts);
                            li = li.replace("{4}", (supplier.returnRatio * 100) + "%");
                            $list.append(li);
                        }
                        $list.listview("refresh");
                    } else {
                        showMyPopup("加载数据失败！", 0);
                    }
                }
            });
        }

        function getSuppliers(key) {
            var $list = $("#supplierList");
            $.ajax({
                url: path + "/supplier/findSuppliers.php",
                type: "post",
                data: {key: key},
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        $list.empty();
                        var suppliers = map.data;
                        for (var i = 0; i < suppliers.length; i++) {
                            var supplier = suppliers[i];
                            var li = supplierLi.replace("{0}", supplier.id);
                            li = li.replace("{5}", supplier.id);
                            li = li.replace("{1}", supplier.companyName);
                            li = li.replace("{2}", supplier.addr);
                            li = li.replace("{3}", supplier.mainProducts);
                            li = li.replace("{4}", (supplier.returnRatio * 100) + "%");
                            $list.append(li);
                        }
                        $list.listview("refresh");
                    } else {
                        showMyPopup("加载数据失败！", 0);
                    }
                }
            });
        }

        $(document).on("pageinit", "#suppliersPage", function (e) {
            getSuppliers();

            $("#searchBtn").on("click", function () {
                var key = $.trim($("#search").val());
                if (key == '') {
                    getSuppliers();
                } else {
                    getSuppliers(key);
                }
            });
        });
    </script>

    <div data-role="main" class="ui-content">

        <section>
            <div style="width:100%;height:20%;">
                <img src="{{asset('home/images/suppliers/0.jpg')}}" style="width:100%;height:100%;">
            </div>
        </section>

        <section>


            <div class="ui-grid-b" style="margin-top:0.2em;">
                <div class="ui-block-a" style="text-align:center;">
                    <a href="#provider_show" data-ajax="false" data-transition="flip">
                        <img src="{{asset('home/images/btn1.png')}}" style="width:100%;height:100%;">
                    </a>
                </div>
                <div class="ui-block-b" style="text-align:center;">
                    <a href="/supplier/applyWelfare.php" data-ajax="false" data-transition="flip">
                        <img src="{{asset('home/images/btn3.png')}}" style="width:100%;height:100%;">
                    </a>
                </div>
                <div class="ui-block-c" style="text-align:center;">
                    <a href="/supplier/toSupplierApply.php" data-ajax="false" data-transition="flip">
                        <img src="{{asset('home/images/btn21.png')}}" style="width:100%;height:100%;">
                    </a>
                </div>
            </div>


            <hr style="background-color:blue;height:0.2em;"/>


        </section>
        <!-- 查询 -->
        <form>

            <div data-role="fieldcontain" data-role="controlgroup" data-type="horizontal" style="padding:0px;">
                <input type="search" name="search" id="search" placeholder="输入关键词">
                <a href="#" data-inline="true" id="searchBtn" class="ui-btn ui-icon-search ui-btn-icon-notext ui-corner"
                   style="float: right;margin-top: -2.6em;margin-right: 1em;"></a>

                <a href="#" data-inline="true" id="searchBtn" class="ui-btn ui-icon-search ui-btn-icon-notext ui-corner"
                   style="float: right;margin-top: -2.6em;margin-right: 0.5em;"></a>
            </div>

        </form>
        <!--
         <div data-role="navbar">
              <ul>
                <li><a href="#">最新收录</a></li>
                <li><a href="#">热门推荐</a></li>

              </ul>
            </div>
            -->
        <ul data-role="listview" id="supplierList" data-inset="true">
            <li>
                <a href="/supplier/toSupplierDetail.php" data-ajax="false" data-transition="flip">
                    <img src="{{asset('home../images/_assets/img/album-bb.jpg')}}"
                         style="margin-top:1.5em;margin-left:0.5em;border-radius:50%;width:4em;height:4em;">
                    <h4>盘古搬运服务有限公司</h4>
                    <p>
                        <span style="font-weight:bold;">所在地:江苏-苏州-昆山</span>
                    </p>
                    <p>
                        主营产品: 搬家、装潢、维修等一系列相关的服务
                    </p>
                    <p>
                        <span style="font-weight:bold;">福利比例: 100000:1</span>
                    </p>
                </a>
            </li>
        </ul>
    </div>
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar">
            <ul>
                <li><a href="/bill/toMain.php" data-ajax="false" data-rel="dialog" data-transition="flip">采购列表</a></li>
                <li><a href="/supplier/toSupplierMgr.php" data-ajax="false" data-rel="dialog"
                       class="ui-btn-active ui-state-persist" data-transition="flip">供应商库</a></li>
                <li><a href="/vcom/toVcoms.php" data-ajax="false" data-rel="dialog" data-transition="flip">拜访采购</a></li>

                <li><a href="/ucenter/toCenter.php" data-ajax="false" data-rel="dialog" data-transition="flip">个人中心</a>
                </li>
            </ul>
        </div>
        <div style="align:center;line-height:2em;font-size:0.5em;margin-left:8em;">
            {{--<a href="http://www.miibeian.gov.cn">苏ICP备17016930号-2</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;版权：苏州人脉汇网络科技有限公司--}}
        </div>
    </div>
</div>


<div data-role="page" id="provider_show">
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h2>相关说明</h2>
    </div>

    <div data-role="tabs" id="tabs">
        <div data-role="navbar">
            <ul>
                <li><a href="#one" data-ajax="false">商家入驻说明</a></li>
                <li><a href="#two" data-ajax="false">福利申请说明</a></li>
            </ul>
        </div>
        <div id="one" class="ui-body-d ui-content">
            <img src="{{asset('home/images/sm1.jpg')}}" style="width:100%;height:100%;"/>
        </div>
        <div id="two">
            <img src="{{asset('home/images/sm2.jpg')}}" style="width:100%;height:100%;"/>
        </div>

    </div>


</div>
</body>
</html>
