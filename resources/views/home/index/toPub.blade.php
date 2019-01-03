

<!DOCTYPE html>
<html>
<head>
    <title>采购需求发布</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
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
        *,body{
            margin:0;
            padding:0;
        }
    </style>
</head>

<body>

<div data-role="page" id="pubPage">
    <script>
        var path = "";
        //地址

        function initProvinces(){
            $.ajax({
                url:path+"/opt/findProvinces.php",
                success:function(map){
                    var resultCode = map.resultCode;
                    if(resultCode == '1'){
                        var provinces = map.data;
                        var $province = $("#purchase_pub_province");
                        $("#purchase_pub_province option:gt(0)").remove();
                        for(var i=0;i<provinces.length;i++){
                            var p = provinces[i];
                            $province.append("<option value='"+p.id+"'>"+p.name+"</option>");
                        }
                    }
                }
            });
        }

        function initCitys(provinceId){
            $.ajax({
                url:path+"/opt/findCitys.php",
                data:{provinceId:provinceId},
                success:function(map){
                    var resultCode = map.resultCode;
                    if(resultCode == '1'){
                        var citys = map.data;
                        var $city = $("#purchase_pub_city");
                        $("#purchase_pub_city option:gt(0)").remove();
                        for(var i=0;i<citys.length;i++){
                            var c = citys[i];
                            $city.append("<option value='"+c.id+"'>"+c.name+"</option>");
                        }
                    }
                }
            });
        }

        function initDistricts(cityId){
            $.ajax({
                url:path+"/opt/findDistricts.php",
                data:{cityId:cityId},
                success:function(map){
                    var resultCode = map.resultCode;
                    if(resultCode == '1'){
                        var districts = map.data;
                        var $district = $("#purchase_pub_district");
                        $("#purchase_pub_district option:gt(0)").remove();
                        for(var i=0;i<districts.length;i++){
                            var d = districts[i];
                            $district.append("<option value='"+d.id+"'>"+d.name+"</option>");
                        }
                    }
                }
            });
        }
        /*
            var cnt = 0;
            //重定义图片尺寸大小
            function showOriginalImg(path,id){
                var p = new Image();
                p.src = path;
                    p.onload = function(){
                        var w,h;
                        w = this.width;
                        h = this.height;
                        if(w>h){
                            $("#"+id).css("width","auto");
                        }else{
                            $("#"+id).css("height","auto");
                        }
                        var pNode = this.parentNode;
                        var f_width = 80;
                        var f_height = 80;
                        var imgMaxSize = f_width;
                        var i_width = w;
                        var i_height = h;
                        if (i_width <= i_height) {//图片的高度大于宽度
                            var hh = i_height * (imgMaxSize / i_width);
                            $("#"+id).css("margin-top",(imgMaxSize - hh)/2 + 'px');
                        } else {//图片的高度小于宽度
                            var ww = i_width * (imgMaxSize / i_height);
                            $("#"+id).css("margin-left",(imgMaxSize-ww)/2 + 'px');
                        }
                    }
                }
                function del(obj){
                    var $obj = $(obj);
                    var imgId = $obj.parent().find("img").attr("id");
                    $obj.parent().remove();
                    var inputId="file"+imgId.substring(3);
                    $("#"+inputId).remove();
                }



            function changeFile(e,obj){
                    var len = $("#input_div").find("input").length;
                    if(len<4){
                    var inputId=cnt;
                    var id="pic"+cnt;

                    cnt++;

                    var target = e.target||e.srcElement;
                    for (var i = 0; i < target.files.length; i++) {
                        var file = target.files.item(i);
                        console.log(file);
                        //允许文件MIME类型 也可以在input标签中指定accept属性
                        //console.log(/^image\/.*$/i.test(file.type));
                        if (!(/^image\/.*$/i.test(file.type))) {
                            continue; //不是图片 就跳出这一次循环
                        }
                        //实例化FileReader API
                        var freader = new FileReader();
                        freader.readAsDataURL(file);
                        freader.onload = function(e) {
                            var img = '<div class="container" style="float:left"><div class="close" style="float:right;font-weight:bold;background:#ccc;" onclick="del(this)">×</div><div style="width:80px;height:80px;overflow:hidden"><img src="' + e.target.result
                                    + '" style="width:80px;height:80px" id="'+id+'"/></div></div>';
                            $("#destination").append(img);
                            var imgs = document.getElementById(id);
                            //$("#destination").empty().append(img);
                            showOriginalImg(target.result,id)
                        }
                    }
                        $(obj).attr("id","file1"+inputId);
                        $(obj).attr("name","file1"+inputId);
                        $("<input type='file' style='size:100px;' id='file' onChange='changeFile(event,this);'  accept='image/png, image/jpeg'/>").insertAfter($(obj));
                        $(obj).hide();
                }else{
                    alert("最多只能上传3张图片!");
                }
            }

           */
        function addPub(){
            /*
            var fileCnt = 0;
            $("#input_div").find("input[name]").each(function(){
                $(this).attr("name","file1"+(fileCnt++));
            });
            */
            var $form = $("#pubForm");
            if($form.valid()){
                $form.ajaxSubmit({
                    url:path+"/bill/addPub.php",
                    type:"post",
                    success:function(map){
                        var map = map.substring(map.indexOf("{"),map.indexOf("}")+1);
                        var res = eval('('+map+')')
                        var resultCode = res.resultCode;
                        if(resultCode=='1'){
                            //goTo(path+"/bill/toMain.php");
                            window.location.href=path+"/bill/toMain.php";

                        }else{
                            showMyPopup("发布失败！",0);
                        }
                    }
                });
            }
        }

        function initPubType(){
            var realize = $("#user_realize").val();
            var $type1 = $("#purchase_pub_type1");
            var $type0 = $("#purchase_pub_type0");
            if(realize == '2'){
                $type1.trigger("click");
                $type0.prop("disabled",false);
                $type1.prop("disabled",false);
                $type1.checkboxradio("refresh");
                $type0.checkboxradio("refresh");

            }else{
                $type0.trigger("click");
                $type0.checkboxradio("refresh");
                $type1.prop("disabled","disabled");
            }

        }

        function initValidate(){

            $("#pubForm").validate({
                rules:{
                    price:{
                        required:true
                    },
                    title:{
                        required:true
                    },
                    addr:{
                        required:true
                    },
                    companyName:{
                        required:true
                    },
                    contactor:{
                        required:true
                    },
                    contactorMobile:{
                        required:true,
                        mobile:true
                    },
                    contactorTitle:{
                        required:true
                    },
                    file10:{
                        required:false,
                        accept:"png|jpg"
                    },
                    file11:{
                        required:false,
                        accept:"png|jpg"
                    },
                    file12:{
                        required:false,
                        accept:"png|jpg"
                    }
                },
                messages:{
                    price:{
                        required:"<font style='color:red;font-size:0.75em;'>售价必须选择!</font>"
                    },
                    title:{
                        required:"<font style='color:red;font-size:0.75em;'>标题必须填写!</font>"
                    },
                    addr:{
                        required:"<font style='color:red;font-size:0.75em;'>发布城市必须填写!</font>"
                    },
                    companyName:{
                        required:"<font style='color:red;font-size:0.75em;'>公司名必须填写!</font>"
                    },
                    contactor:{
                        required:"<font style='color:red;font-size:0.75em;'>联系人必须填写!</font>"
                    },
                    contactorMobile:{
                        required:"<font style='color:red;font-size:0.75em;'>联系人手机必须填写!</font>",
                        mobile:"<font style='color:red;font-size:0.75em;'>手机号码不合法!</font>"
                    },
                    contactorTitle:{
                        required:"<font style='color:red;font-size:0.75em;'>联系人职务必须填写!</font>"
                    },
                    file10:{
                        accept:"<font style='color:red;font-size:0.75em;'>只能选择png或者jpg图片</font>"
                    },
                    file11:{
                        accept:"<font style='color:red;font-size:0.75em;'>只能选择png或者jpg图片</font>"
                    },
                    file12:{
                        accept:"<font style='color:red;font-size:0.75em;'>只能选择png或者jpg图片</font>"
                    }
                }
            });
        }

        var purl = "/index/toPub";


        function bindPubBtnEvent(){

            $(".pub").click(function(event){
                $.ajax({
                    url:path+"/user/hasRealize",
                    async:false,
                    success:function(result){
                        var resultCode = result.resultCode;
                        if(resultCode=='1'){
                            goTo(purl);
                        }else if(resultCode=='-1'){
                            showMyPopup("<font color='red'>对不起,你尚未实名制!</font><br/><font><a href='/ucenter/toCenter.php'>请到个人中心进行实名！</a></font>",0);

                        }else{
                            showMyPopup("服务器异常,稍后再试!", 0);

                        }
                    }
                });
            });
        }
        $(document).on("pageinit","#pubPage",function(){

            bindPubBtnEvent();
            jQuery.validator.addMethod("mobile", function (value, element) {
                var pattern = /^1[3|5|7|8]\d{9}$/gi;
                return this.optional(element) || (pattern.test(value));
            }, "非法的手机号码!");
            var st = -1;
            var options0="<option value=''>选择金币</option><option value='2'>2金币</option><option value='4'>4金币</option><option value='6'>6金币</option><option value='8'>8金币</option><option value='10'>10金币</option>";
            var options1="<option value=''>选择金币</option><option value='10'>10金币</option><option value='20'>20金币</option><option value='30'>30金币</option><option value='40'>40金币</option><option value='50'>50金币</option>";
            var $cn = $("#purchase_pub_cn");
            $cn.removeAttr("checked");
            $("#pub_sub_btn").hide();
            $cn.bind("click",function(){
                if(st==-1){
                    $("#pub_sub_btn").show();
                }else{
                    $("#pub_sub_btn").hide();
                }
                st = st*(-1);
            });


            initProvinces();

            $("#purchase_pub_province").bind("change",function(){
                var $this = $(this);
                var val = $this.val();
                if(val!='0'){
                    initCitys(val);
                    var txt =  $('#purchase_pub_province option:selected').text();
                    $("#addr").val(txt);
                    //	$("#purchase_pub_city")[0].selectedIndex = 1;
                    //	$("#purchase_pub_district")[0].selectedIndex = 1;
                    $("#purchase_pub_city").selectmenu("refresh");
                    $("#purchase_pub_district").selectmenu("refresh");
                }
            });

            $("#purchase_pub_city").bind("change",function(){
                var $this = $(this);
                var val = $this.val();
                if(val!='0'){
                    initDistricts(val);
                    txt = $('#purchase_pub_city option:selected').text();
                    var provinceTxt = $('#purchase_pub_province option:selected').text();
                    $("#addr").val(provinceTxt+"-"+txt);
                    //	$("#purchase_pub_district")[0].selectedIndex = 1;
                    $("#purchase_pub_district").selectmenu("refresh");
                }
            });

            $("#purchase_pub_district").bind("change",function(){
                var $this = $(this);
                var val = $this.val();
                if(val!='0'){
                    var districtTxt = $('#purchase_pub_district option:selected').text();
                    var cityTxt = $('#purchase_pub_city option:selected').text();
                    var provinceTxt = $('#purchase_pub_province option:selected').text();
                    $("#addr").val(provinceTxt+"-"+cityTxt+"-"+districtTxt);
                }
            });
            /*
            $("input[type='radio'][name='type']").bind("change",function(){
                var $this = $(this);
                var val = $this.val();
                var $price = $("#purchase_pub_price");
                $price.empty();
                if(val=='0'){
                    $price.append($(options0));
                }else{
                    $price.append($(options1));
                }
                $price.selectmenu("refresh");
            });
            initValidate();
            setTimeout(function(){
                initPubType();
            },100);*/
        });




    </script>
    <div data-role="header">
        <a href="#" data-rel="back" data-icon="back">返回</a>
        <h1>采购需求发布</h1>
    </div>

    <div role="main" class="ui-content">
        <input type="hidden" id="user_realize" value="0"/>
        <form method="post"  id="pubForm" enctype="multipart/form-data">
            <div data-role="fieldcontain">
                <!--
         <fieldset data-role="controlgroup" data-type="horizontal">


                     <input type="radio" name="type" id="purchase_pub_type0"  value="0">
                     <label for="purchase_pub_type0">需求代发</label>
         <input type="radio" name="type" id="purchase_pub_type1" value="1" >
                     <label for="purchase_pub_type1">企业直购<font style="color:red;font-size:0.5em;">(采购认证后可选)</font></label>
                 </fieldset>
                  -->
                {{--<input type="hidden" value="1" name="type">--}}
                {{--<select name="price" id="purchase_pub_price" placeholder="信息售价">--}}
                    {{--<option value="">选择售价</option>--}}
                    {{--<option value="10">10金币</option>--}}
                    {{--<option value="20">20金币</option>--}}
                    {{--<option value="30">30金币</option>--}}
                    {{--<option value="40">40金币</option>--}}
                    {{--<option value="50">50金币</option>--}}
                {{--</select>--}}
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <input type="radio" name="validHours" id="purchase_pub_validHours24" value="168">
                    <label for="purchase_pub_validHours24">7天</label>
                    <input type="radio" name="validHours" id="purchase_pub_validHours48" value="240">
                    <label for="purchase_pub_validHours48">10天</label>
                    <input type="radio" name="validHours" id="purchase_pub_validHours72" value="360"  checked="checked">
                    <label for="purchase_pub_validHours72">15天</label>
                </fieldset>

                <input type="text" name="title" id="purchase_pub_title" placeholder="采购标题" />
                <textarea cols="40" rows="3" id="purchase_pub_detailDemand" name="detailDemand" placeholder="详细要求:采购数量、产品型号···"></textarea>
                <legend>需求城市:</legend>
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <select id="purchase_pub_province">
                        <option value="">省份</option>

                    </select><select id="purchase_pub_city" >
                        <option value="">城市</option>

                    </select><select id="purchase_pub_district">
                        <option value="">区</option>

                    </select>
                </fieldset>
                <input type="hidden"  id="addr" name="addr" />
                <label style="margin-top:1em;">图纸或样品图片:</label>
                <div style="width:100%;height:auto;">

                    <div id="input_div">
                        <input type="file"  style="size:100px;" name="file10" />
                        <input type="file"  style="size:100px;" name="file11"/>
                        <input type="file"  style="size:100px;" name="file12" />
                    </div>

                </div>
                <p style="padding-left:40%;font-weight:bold;">联系方式</p>

                <div>
                    <input type="text" name="companyName" placeholder="公司名称" value="">
                    <input type="text" name="contactor" placeholder="联系人" value="">
                    <input type="text" name="contactorMobile" placeholder="联系电话" value="">
                    <input type="text" name="contactorTitle" placeholder="职务" value="">
                </div>
                <div style="margin-top:5px;margin-left:1em;">
                    <input type="checkbox" data-role="none" id="purchase_pub_cn"  style="margin-left:0.5em;"/><span style="font-size:0.75em;font-weight:bold;color:red;margin-left:0.5em;">本人承诺所发布信息真实可靠</span>
                </div>
                <div>
                    <a data-role="button" onclick="addPub();" id="pub_sub_btn"  class="ui-btn ui-btn-inline">提交</a>
                </div>
            </div>
        </form>
    </div>


</div>

</body>
</html>