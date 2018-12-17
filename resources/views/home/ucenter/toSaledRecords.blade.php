<!DOCTYPE html>
<html>
<head>
    <title>已购的采购信息</title>
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
    <script
            src="{{asset('home/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <style>
        *, body {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }
    </style>
</head>

<body>

<div data-role="page" id="saledRecordPage">
    <script type="text/javascript">
        var path = "";
        var tr = "<li><p><span style='font-weight:bold;margin-left:1em;'>采购标题:</span><span style='padding-left:5px;font-weight:bold'>{0}</span></p></li>";

        function fillSaledRecords(records) {
            var $list = $("#list_saled_records");
            $list.empty();
            for (var i = 0; i < records.length; i++) {
                var record = records[i];
                var mtr = tr.replace("{0}", record.bill.title);
                var commentType = record.commentType;
                var $mtr = $(mtr);
                if (commentType == 0) {
                    var curl = path + "/ucenter/toEvaluate.php?id=" + record.id;
                    var ca = "<a style='float:right;margin-right:1em;' data-ajax='false'  data-rel='dialog' href='{3}'>待评价</a>";
                    ca = ca.replace("{3}", curl);
                    var $a = $(ca);
                    $mtr.find("p").append($a);
                } else {
                    var cp = "<p><span style='font-size:0.75em;word-break:normal; width:auto; display:block; white-space:pre-wrap;word-wrap : break-word ;'><font style='padding-left:1em;color:{2}'>{0}</font><font style='padding-left:1em;'>{1}</font></span></p>";
                    var tcp = "";
                    if (commentType == 1) {
                        $
                        tcp = cp.replace("{0}", "好评!")
                        tcp = tcp.replace("{2}", "blue");
                        tcp = tcp.replace("{1}", (record.commentContent == null ? "" : record.commentContent));
                    } else if (commentType == -1) {
                        tcp = cp.replace("{0}", "差评!")
                        tcp = tcp.replace("{2}", "red");
                        tcp = tcp.replace("{1}", "  原因:" + record.commentContent);
                    }
                    $mtr.append($(tcp));
                    //	alert($mtr.html())
                }
                $list.append($mtr);
            }
            $list.listview("refresh");
        }

        function listSaledRecords() {
            $.ajax({
                url: path + "/ucenter/findSaledRecords.php",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        fillSaledRecords(map.data);
                    } else {
                        showMyPopup("获取数据发生异常!", 1);
                    }
                }
            });
        }

        $(document).on("pageinit", "#saledRecordPage", function () {
            listSaledRecords();
        });

    </script>

    <div data-role="header">
        <h1>已购的采购信息</h1>
        <a href="#" data-rel="back" data-icon="back">返回</a>
    </div>

    <div role="main" class="ui-content" style="padding:0.2em;">
        <ul data-role="listview" id="list_saled_records">

        </ul>
    </div>
</div>
</body>
</html>