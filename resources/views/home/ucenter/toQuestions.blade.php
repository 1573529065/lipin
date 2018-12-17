<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--自适应界面,如果出现,在某些设备出现界面偏小的话,检查一下有没有加入这句 -->
    <meta http-equiv="Content-type" name="viewport"
          content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width">
    <link rel="stylesheet"
          href="/css/jquery.mobile-1.4.5.css"/>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
</head>
<body>
<div data-role="page" id="listQuestionsPage">
    <script type="text/javascript">
        var path = "";
        var li = "<li><a href='#showContentPage'  data-transition='flip' onClick='showQuestion({0},this)'>{1}</a></li>";

        function showQuestion(id, obj) {
            $.ajax({
                url: path + "/question/findQuestion.php",
                data: {id: id},
                type: 'post',
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        $("div.questionContent").html(map.data.answer);

                    } else {
                        showMyPopup("获取答案发生异常!", 1)
                    }
                }

            });
        }

        $(document).on("pageinit", "#listQuestionsPage", function () {
            $.ajax({
                url: path + "/question/listQuestions.php",
                type: "post",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var $ul = $("#questions");
                        $ul.empty();
                        var questions = map.data;
                        for (var i = 0; i < questions.length; i++) {
                            var question = questions[i];
                            var tli = li.replace("{0}", question.id);
                            tli = tli.replace("{1}", question.content);
                            $ul.append(tli);
                        }
                        $ul.listview("refresh");
                    }
                }
            });
        });
    </script>
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h2>问题列表</h2>
    </div>
    <div data-role="main" class="ui-content">
        <ul data-role="listview" id="questions">

        </ul>
    </div>
</div>

<div data-role="page" id="showContentPage">
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h2>问题答案</h2>

    </div>
    <div data-role="main" class="ui-content">
        <div class="questionContent">

        </div>
    </div>
</div>
</body>
</html>