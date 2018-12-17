<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css"/>
    <link rel="stylesheet" href="/css/mobiscroll_date.css"/>
    <link rel="stylesheet" href="/css/mobiscroll.css"/>
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

        #listVisits a {
            font-size: 0.9em;
        }

        #listVisits span {
            font-weight: bold;
            margin-left: 0.5em;
        }

        div.showProvider {
            padding-left: 1em;
        }

        .showProvider span {
            margin-left: 1em;
            font-weight: bold;
        }

        .showProvider p {
            margin-top: 0.5em;
        }
    </style>
</head>

<body>

<div data-role="page" id="myVisitsPage">
    <script>
        var path = "";
        var statusLi = "<a class='ui-btn ui-btn-inline' onclick='accept({4},this)'>接受</a><a onclick='refuse({4},this)' href='#' class='ui-btn ui-btn-inline'>拒绝</a>";
        var li = "<li><div style='float:left;'>申请公司:<span>{0}</span><br/>申请时间:<span>{1}</span><br/>悬赏金币:<span>{2}</span>金币</div><div style='float:right;'><a   class='ui-btn ui-btn-inline' href='#' onclick='showVisitInfo({4})'>查看详情</a><span style='margin-left:1em;'></span></div></li>";

        function listMyVisits() {
            $.ajax({
                url: path + "/visit/findMyVisits.php",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var $ul = $("#listVisits");
                        $ul.empty();
                        var data = map.data;
                        for (var i = 0; i < data.length; i++) {
                            var req = data[i];
                            var status = req.status;
                            var tli = li.replace("{0}", req.fromVcom.companyName);
                            tli = tli.replace("{1}", req.reqTimeStr);
                            tli = tli.replace("{2}", req.totalGold);
                            tli = tli.replace("{4}", req.id);
                            var $tli = $(tli);
                            if (status == '0') {
                                var ili = statusLi.replace("{4}", req.id);
                                ili = ili.replace("{4}", req.id);
                                $tli.find("span:last").append(ili);
                            } else if (status == '1') {
                                $tli.find("span:last").append("<font color='blue'>已接受</font>");
                            } else {
                                $tli.find("span:last").append("<font color='red'>已拒绝</font>");
                            }

                            $ul.append($tli);
                        }
                        $ul.listview("refresh");

                    } else {
                        showMyPopup("加载数据发生异常!", 0);
                    }
                }
            });
        }

        /**
         *接受
         */
        function accept(id, obj) {
            $.ajax({
                url: path + "/visit/acceptVisit.php",
                data: {id: id},
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var $p = $(obj).parent();
                        $p.empty();
                        $p.html("<span style='color:blue;'>已接受</span>")
                    } else {
                        showMyPopup("接受拜访申请失败！", 0);
                    }
                }
            })
        }

        /**
         *拒绝
         */
        function refuse(id, obj) {
            $.ajax({
                url: path + "/visit/refuseVisit.php",
                data: {id: id},
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var $p = $(obj).parent();
                        $p.empty();
                        $p.html("<span style='color:red;'>已拒绝</span>")
                    } else {
                        showMyPopup("拒绝拜访申请失败！", 0);
                    }
                }
            });
        }

        /**
         *查看公司信息
         */
        function showVisitInfo(id) {
            $.mobile.changePage(path + "/visit/toShowVisitInfo.php?id=" + id, "flip");
        }

        $(document).on("pageinit", "#myVisitsPage", function () {
            listMyVisits();
        });
    </script>
    <div data-role="header" data-position="fixed">
        <h1>我的受访申请</h1>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>

    <div data-role="main" class="ui-content">
        <ul data-role="listview" id="listVisits">
            <!-- <li>
                <div style="float:left;">
                    申请公司:<span>大圣科技</span><br/>
                    申请时间:<span>2017-12-04 15:30</span><br/>
                    悬赏金币:<span>100</span>金币
                </div>
                <div style="float:right;">
                    <a class="ui-btn ui-btn-inline">接受</a><a class="ui-btn ui-btn-inline">拒绝</a><a class="ui-btn ui-btn-inline">查看</a>
                </div>
            </li> -->
        </ul>
    </div>
</div>


</body>
</html>