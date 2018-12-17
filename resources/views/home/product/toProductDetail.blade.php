<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>产品详细信息</title>
    <link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css">

    <link rel="shortcut icon" href="/favicon.ico">
    <script src="{{asset('home/js/jquery.js')}}"></script>
    <script src="{{asset('home/js/common.js')}}"></script>
    <script src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <style>
        li {
            list-style: none;
            text-align: center;
        }

    </style>
</head>
<body>
<div data-role="page" id="productDetailPage">
    <script type="text/javascript">
        var path = "";

        function getSearchJson(str) {
            var searchJson = {};
            var searchArr = str.split("&");
            for (var i in searchArr) {
                searchJson[searchArr[i].split("=")[0]] = searchArr[i].split("=")[1]
            }
            return searchJson;
        }

        function findProduct(id) {
            $.ajax({
                url: path + "/product/findProduct.php",
                data: {id: id},
                type: "post",
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var product = map.data;
                        $("#productName").html(product.name);
                        $("#productDesc").html(product.productDesc);
                    }
                }
            });
        }

        $(document).on("pageinit", "#productDetailPage", function (event) {
            var url = event.currentTarget.baseURI;
            var json = getSearchJson(url.substring(url.indexOf("?") + 1));
            var id = json.id;
            var imgUrl = "http://zhizhum.com/supplierMgr/images/products/" + id + "/" + id + "b.jpg";
            $("#productImg").attr("src", imgUrl);
            findProduct(id);
        });
    </script>
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h2>产品详情</h2>
    </div>
    <div data-role="main" class="ui-content">
        <section>
            <div>
                <li>

                    <img id="productImg" style="height:15em;width:15em;">
                    <p id="productName"></p>

                </li>
            </div>
        </section>
        <section>
            <label style="font-weight:bold;">产品介绍</label>
            <hr/>
            <div style="margin-top:0.5em;" id="productDesc">

            </div>
            <hr/>
        </section>
    </div>
</div>

</body>
</html>
