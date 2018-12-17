<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>供应商详细</title>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet"
          href="/css/jquery.mobile-1.4.5.css"/>
    <script type="text/javascript"
            src="{{asset('home/js/jquery.js')}}"></script>
    <script
            src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
    <script type="text/javascript" src="{{asset('home/js/common.js')}}"></script>
    <style>
        li {
            list-style: none;
        }

        span {
            margin: 0.5em;
        }

        a {
            text-decoration: none;
            list-style: none;
            text-align: center;
        }
    </style>


</head>
<body>
<div data-role="page" id="supplierDetailPage">
    <script type="text/javascript">
        var path = "";
        var myImgPath = "http://zhizhum.com/supplierMgr/";

        var product0 = "<div class='ui-block-a' style='width:49%;'><li><a href='/product/toProductDetail.php?id={0}' data-ajax='false' data-transition='flip'><img src='http://zhizhum.com/supplierMgr/images/products/{1}/{2}s.jpg' style='height:8em;width:8em;'><p>{3}</p></a></li></div>";
        var product1 = "<div class='ui-block-b' style='width:49%;'><li><a href='/product/toProductDetail.php?id={0}' data-ajax='false' data-transition='flip'><img src='http://zhizhum.com/supplierMgr/images/products/{1}/{2}s.jpg' style='height:8em;width:8em;'><p>{3}</p></a></li></div>";
        var zizhi0 = "<div class='ui-block-a' style='width:49%;'><li><a href='/zizhi/toZizhiDetail.php?id={0}' data-ajax='false' data-transition='flip'><img src='http://zhizhum.com/supplierMgr/images/zizhis/{1}.jpg' style='height:8em;width:8em;'><p>{2}</p></a></li></div>";
        var zizhi1 = "<div class='ui-block-b' style='width:49%;'><li><a href='/zizhi/toZizhiDetail.php?id={0}' data-ajax='false' data-transition='flip'><img src='http://zhizhum.com/supplierMgr/images/zizhis/{1}.jpg' style='height:8em;width:8em;'><p>{2}</p></a></li></div>";

        function getSearchJson(str) {
            var searchJson = {};
            var searchArr = str.split("&");
            for (var i in searchArr) {
                searchJson[searchArr[i].split("=")[0]] = searchArr[i].split("=")[1]
            }
            return searchJson;
        }


        function fillSupplier(supplier) {
            $(".companyName").html(supplier.companyName);
            $("#supplierLogo").attr("src", myImgPath + "/images/suppliers/logos/" + supplier.id + ".jpg");
            $("#bizMode").html(supplier.bizModeStr);
            $("#createTime").html(supplier.simpleCreateTimeStr);
            var addr = supplier.addr;
            addr = addr.replace(/-/g, '');
            $("#l_detailAddr").html(addr + supplier.detailAddr);
            $("#l_mainProducts").html(supplier.mainProducts);
            $("#l_contactor").html(supplier.contactor);
            $("#l_contactorMobile").html(supplier.contactorMobile);
            $("#l_insuranceLevel").html(supplier.insuranceLevelStr);
            $("#l_returnRatio").html("按合同金额的" + supplier.returnRatioStr + "发放福利");
            $("#l_companyDesc").html(supplier.companyDesc);
            $("#supplierDetail_lv").listview("refresh");
            var products = supplier.products;
            var $products = $("#products");

            var len = products.length;
            var $moreProducta = $("#moreProducta");
            if (len > 4) {
                $moreProducta.show();
                $moreProducta.attr("href", path + "/product/moreProduct.php?id=" + supplier.id);
                len = 4;
            } else {
                $moreProducta.hide();
            }

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var product = products[i];
                    var p0 = '';
                    if (i % 2 == 0) {
                        p0 = product0.replace("{0}", product.id);
                        p0 = p0.replace("{1}", product.id);
                        p0 = p0.replace("{2}", product.id);
                        p0 = p0.replace("{3}", product.name)
                    } else {
                        p0 = product1.replace("{0}", product.id);
                        p0 = p0.replace("{1}", product.id);
                        p0 = p0.replace("{2}", product.id);
                        p0 = p0.replace("{3}", product.name)
                    }
                    //	p0 = p0.replace("{4}",myHostAddr);
                    $products.append(p0);
                }
            } else {
                $products.empty();
            }

            var zizhis = supplier.zizhis;
            var len1 = zizhis.length;
            var $zizhis = $("#zizhis");
            var $moreZizhia = $("#moreZizhia");
            if (len1 > 2) {
                $moreZizhia.show();
                $moreZizhia.attr("href", path + "/zizhi/moreZizhi.php?id=" + supplier.id)
                len1 = 2;
            } else {
                $moreZizhia.hide();
            }
            if (len1 > 0) {
                for (var i = 0; i < len1; i++) {
                    var zizhi = zizhis[i];
                    var z0 = '';
                    if (i == 0) {
                        z0 = zizhi0.replace("{0}", zizhi.id);
                        z0 = z0.replace("{1}", zizhi.id);
                        z0 = z0.replace("{2}", zizhi.name)
                    } else {
                        z0 = zizhi1.replace("{0}", zizhi.id);
                        z0 = z0.replace("{1}", zizhi.id);
                        z0 = z0.replace("{2}", zizhi.name)
                    }
                    //		z0 = z0.replace("{4}",myHostAddr);
                    $zizhis.append(z0);
                }
            } else {
                $zizhis.empty();
            }
        }

        function findSupplier(id) {
            $.ajax({
                url: path + "/supplier/findFullSupplier.php",
                type: "post",
                data: {id: id},
                success: function (map) {
                    var resultCode = map.resultCode;
                    if (resultCode == '1') {
                        var supplier = map.data;
                        fillSupplier(supplier);

                    }
                }
            })
        }

        $(document).on("pageinit", "#supplierDetailPage", function (event) {

            var url = event.currentTarget.baseURI;
            var json = getSearchJson(url.substring(url.indexOf("?") + 1));
            var id = json.id;

            findSupplier(id);
        });
    </script>
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h4 class="companyName"></h4>
    </div>
    <div data-role="main" class="ui-content">
        <div style="width:20%;float:left;height:5.1em;">
            <img src="{{asset('home../images/_assets/img/album-bb.jpg')}}" id="supplierLogo"
                 style="border-radius:50%;height:5em;width:5em;margin-left:1em;">
        </div>
        <div style="float:right;width:79%;height:5.1em;margin-left:1em;text-align:center;margin-top:-5em;">
            <h4 class="companyName"></h4>
        </div>
        <div style="clear:both;">
            <p style="font-size:0.75em;margin-left:2em;"><span style="font-weight:bold;">经营模式:</span><span id="bizMode">加工生产</span><span
                        style="font-weight:bold;margin-left:1.5em;">入驻日期:</span><span id="createTime">2018-05-12</span>
            </p>
        </div>

        <hr style="background-color:grey;height:0.2em;width:100%;"/>
        <ul data-role="listview" data-inset="true" id="supplierDetail_lv">
            <li>
                企业地址:<span id="l_detailAddr" style="font-weight:bold;font-size:0.75em;"></span>
            </li>
            <li>
                经营范围:<span id="l_mainProducts" style="font-weight:bold;font-size:0.75em;"></span>
            </li>
            <li>
                联系人:<span id="l_contactor" style="margin-left:1em;font-weight:bold;font-size:0.75em;"></span>联系电话:<span
                        id="l_contactorMobile" style="font-weight:bold;font-size:0.75em;"></span>
            </li>

            <li>
                保证金额度:<span id="l_insuranceLevel" style="font-weight:bold;font-size:0.75em;"></span>
            </li>
            <li>
                商家承诺: <span id="l_returnRatio" style="color:red;font-weight:bold;font-size:0.75em;"></span>
            </li>
        </ul>

        <!-- ===========商家介绍============ -->

        <section>
            <label>商家介绍</label>
            <hr/>
            <p id="l_companyDesc">
            </p>
        </section>

        <hr/>
        <!-- ===========产品大全============= -->
        <section>
            <span>产品大全</span><a style="margin-left:50%;" id="moreProducta" href="" data-ajax="false"
                                data-transition="flip">更多</a>

            <div class="ui-grid-a" style="margin-top:1em;margin-left:1em;" id="products">

            </div>

        </section>
        <!-- ==========资质展示============== -->
        <hr/>
        <section>
            <span>资质展示</span><a style="margin-left:50%;" id="moreZizhia" href="/zizhi/moreZizhi.php" data-ajax="false"
                                data-transition="flip">更多</a>
            <div class="ui-grid-a" style="margin-top:1em;margin-left:1em;" id="zizhis">

            </div>
        </section>

    </div>

</div>

</body>
</html>
