

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>供应商入驻申请</title>

		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<link rel="shortcut icon" href="/favicon.ico">

		
		<script type="text/javascript"
		src="/js/jquery.js"></script>
	<script type="text/javascript"
		src="/js/jquery.form.js"></script>
	<script type="text/javascript"
		src="/js/jquery.validate.min.js"></script>
	<script
		src="/js/jquery.mobile-1.4.5.js"></script>
	<script src="/js/common.js"></script>
	<script src="/js/jquery.cookie.js"></script>
		<style type="text/css">
			select{
				font-size:0.75em;
			}
		</style>
	</head>
	<body>
	<div data-role="page" id="supplierApplyPage">
		<script type="text/javascript">
		var path = "";
		//地址
		
		function initProvinces(){
			$.ajax({
				url:path+"/opt/findProvinces.php",
				success:function(map){
					var resultCode = map.resultCode;
					if(resultCode == '1'){
						var provinces = map.data;
						var $province = $("#supplier_apply_province");
						$("#supplier_apply_province option:gt(0)").remove();
						for(var i=0;i<provinces.length;i++){
							var p = provinces[i];
							$province.append("<option value='"+p.id+"'>"+p.name+"</option>");
						}
						$province.selectmenu("refresh");
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
						var $city = $("#supplier_apply_city");
						$("#supplier_apply_city option:gt(0)").remove();
						for(var i=0;i<citys.length;i++){
							var c = citys[i];
							$city.append("<option value='"+c.id+"'>"+c.name+"</option>");
						}
						
						$city.selectmenu("refresh");
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
						var $district = $("#supplier_apply_district");
						$("#supplier_apply_district option:gt(0)").remove();
						for(var i=0;i<districts.length;i++){
							var d = districts[i];
							$district.append("<option value='"+d.id+"'>"+d.name+"</option>");
						}
						$district.selectmenu("refresh");
					}
				}
			});
		}
		

		function initValidate(){
			
			$("#supplierApplyForm").validate({
				rules:{
					companyName:{
						required:true
					},
					addr:{
						required:true
					},
					bizMode:{
						required:true
					},
					hy:{
						required:true
					},
					mainProducts:{
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
					insuranceRange:{
						required:true
					},
					returnRatio:{
						required:true
						
					},
					hy:{
						required:true
					}
					
				},
				messages:{
					companyName:{
						required:"<font style='color:red;font-size:0.75em;'>公司名必须填写!</font>"
					},
					addr:{
						required:"<font style='color:red;font-size:0.75em;'>地址必须选择!</font>"
					},
					bizMode:{
						required:"<font style='color:red;font-size:0.75em;'>经营模式必须选择!</font>"
					},
					hy:{
						required:"<font style='color:red;font-size:0.75em;'>所属行业必须选择!</font>"
					},
					mainProducts:{
						required:"<font style='color:red;font-size:0.75em;'>主营产品必须填写!</font>"
					},
					contactor:{
						required:"<font style='color:red;font-size:0.75em;'>联系人必须填写!</font>"
					},
					contactorMobile:{
						required:"<font style='color:red;font-size:0.75em;'>联系人手机必须填写!</font>",
						mobile:"<font style='color:red;font-size:0.75em;'>手机号码不合法!</font>"
					},
					contactorTitle:{
						required:"<font style='color:red;font-size:0.75em;'>联系人职务必须选择!</font>"
					},
					insuranceRange:{
						required:"<font style='color:red;font-size:0.75em;'>保证金范围必须选择!</font>"
					},
					returnRatio:{
						required:"<font style='color:red;font-size:0.75em;'>返佣比例职务必须填写!</font>"
					},
					hy:{
						required:"<font style='color:red;font-size:0.75em;'>行业必须选择！</font>"					}
				}
			});
		}

		function addSupplierApply(){
	
			var $form = $("#supplierApplyForm");
			if($form.valid()){
				$form.ajaxSubmit({
					url:path+"/supplier/addSupplierApply.php",
					type:"post",
					success:function(res){
						
						var resultCode = res.resultCode;
						if(resultCode=='1'){
							window.location.href=path+"/supplier/toSupplierMgr.php";
							
						}else{
							showMyPopup("供应商申请失败！",0);
						}
					}
				});
		       }
		}

		
		
		function initHyInfos0(){
			$.ajax({
				url:path+"/hy/findHyInfos.php",
				type:"post",
				success:function(map){
					var resultCode=map.resultCode;
					if(resultCode=='1'){
						var infos = map.data;
						var $cat = $("#cat0");
						$("#cat0 option:gt(0)").remove();
						for(var i=0;i<infos.length;i++){
							var info = infos[i];
							$cat.append("<option value='"+info.id+"'>"+info.name+"</option>");
						}
						$("#cat0").selectmenu("refresh");
					}else{
						alert("加载数据异常!");
					}
				}
			});
		}
		
		function initHyInfos1(parentId){
			$.ajax({
				url:path+"/hy/findHyInfos.php",
				type:"post",
				data:{parentId:parentId},
				success:function(map){
					var resultCode=map.resultCode;
					if(resultCode=='1'){
						var infos = map.data;
						var $cat = $("#cat1");
						$("#cat1 option:gt(0)").remove();
						for(var i=0;i<infos.length;i++){
							var info = infos[i];
							$cat.append("<option value='"+info.id+"'>"+info.name+"</option>");
						}
						$("#cat1").selectmenu("refresh");
					}else{
						alert("加载数据异常!");
					}
				}
			});
		}
		
		function initHyInfos2(parentId){
			$.ajax({
				url:path+"/hy/findHyInfos.php",
				type:"post",
				data:{parentId:parentId},
				success:function(map){
					var resultCode=map.resultCode;
					if(resultCode=='1'){
						var infos = map.data;
						var $cat = $("#cat2");
						$("#cat2 option:gt(0)").remove();
						for(var i=0;i<infos.length;i++){
							var info = infos[i];
							$cat.append("<option value='"+info.id+"'>"+info.name+"</option>");
						}
						$("#cat2").selectmenu("refresh");
					}else{
						alert("加载数据异常!");
					}
				}
			});
		}
		
		$(document).on("pageinit","#supplierApplyPage",function(){
			jQuery.validator.addMethod("mobile", function (value, element) {
				var pattern = /^1[3|5|7|8]\d{9}$/gi;
				return this.optional(element) || (pattern.test(value));
			}, "非法的手机号码!");
			initProvinces();
			initHyInfos0();
			initValidate();

			$("#supplier_apply_province").bind("change",function(){
				var $this = $(this);
				var val = $this.val();
				if(val!='0'){
					initCitys(val);
					var txt =  $('#supplier_apply_province option:selected').text();
					$("#addr").val(txt);
				//	$("#purchase_pub_city")[0].selectedIndex = 1;
				//	$("#purchase_pub_district")[0].selectedIndex = 1;
					$("#supplier_apply__city").selectmenu("refresh");
					$("#supplier_apply__district").selectmenu("refresh");
				}
			});

			$("#supplier_apply_city").bind("change",function(){
				var $this = $(this);
				var val = $this.val();
				if(val!='0'){
					initDistricts(val);
					txt = $('#supplier_apply_city option:selected').text();
					var provinceTxt = $('#supplier_apply_province option:selected').text();
					$("#addr").val(provinceTxt+"-"+txt);
				//	$("#purchase_pub_district")[0].selectedIndex = 1;
					$("#supplier_apply_district").selectmenu("refresh");
				}
			});

			$("#supplier_apply_district").bind("change",function(){
				var $this = $(this);
				var val = $this.val();
				if(val!='0'){
					var districtTxt = $('#supplier_apply_district option:selected').text();
					var cityTxt = $('#supplier_apply_city option:selected').text();
					var provinceTxt = $('#supplier_apply_province option:selected').text();
					$("#addr").val(provinceTxt+"-"+cityTxt+"-"+districtTxt);
				}
			});
			
			
			$("#cat0").on("change",function(){
				var val = $(this).val();
				if(val=='0'){
					$("#cat1").val("0");
					$("#cat2").val("0");
					$("#cat1 option:gt(0)").remove();
					$("#cat2 option:gt(0)").remove();
				}else{
					initHyInfos1(val);
				}
			});
			
			$("#cat1").on("change",function(){
				var val = $(this).val();
				if(val=='0'){			
					$("#cat2").val("0");
					$("#cat2 option:gt(0)").remove();
				}
				initHyInfos2(val);
			});
			
		});
		</script>
		<div data-role="header">
			<a href="#" data-rel="back" data-icon="back">返回</a>
			<h2>供应商入驻申请</h2>
		</div>
		<div data-role="main" class="ui-content">
			<form id="supplierApplyForm">
		
			 <div data-role="fieldcontain">
			 
  				<input type="text" name="companyName" id="companyName" placeholder="公司名称">
				 <fieldset data-role="controlgroup" data-type="horizontal">
				 	
			 		<select id="supplier_apply_province" data-native-menu="false">
			 			<option value="0">--省份--</option>
			 		</select>
			 		<select  id="supplier_apply_city" data-native-menu="false">
			 			<option value="0">--城市--</option>
			 		</select>
			 		<select id="supplier_apply_district" data-native-menu="false">
			 			<option value="0">--区域--</option>
			 		</select>
			 	</fieldset>
			 	<input type="text" name="addr" id="addr" readonly="readonly" placeholder="地址"/>
			  	<select name="bizMode" data-native-menu="false">
			 		<option value="">--经营模式--</option>
			 		<option value="1">生产加工</option>
			 		<option value="2">经销批发</option>
			 		<option value="3">企业服务</option>
			 	</select>
			  <fieldset data-role="controlgroup" data-type="horizontal">
				 	
			 		<select ata-native-menu="false" id="cat0" style="font-size:0.5em;">
			 			<option value="0">--行业大类--</option>
			 		</select>
			 		<select   data-native-menu="false" id="cat1" style="font-size:0.5em;">
			 			<option value="0">--行业小类--</option>
			 		</select>
			 		<select  data-native-menu="false" id="cat2" name="hy" style="font-size:0.5em;">
			 			<option value="">--所属行业--</option>
			 		</select>
			 	</fieldset>
			 	<legend style="font-weight:bold;">主营产品/服务/工艺</legend>
			 	<textarea rows="2" name="mainProducts">
			 		
			 	</textarea>
			 	<input type="text" name="contactor" placeholder="联系人姓名"/>
			 	<input type="text" name="contactorMobile" placeholder="联系手机号码"/>
			 	<input type="text" name="wxNo" placeholder="微信号"/>
			 	<select name="contactorTitle" data-native-menu="false">
			 		<option value="">--职务--</option>
			 		<option value="法人">法人</option>
			 		<option value="副总">副总</option>
			 		<option value="经理">经理</option>
			 		<option value="销售">销售</option>
			 	</select>    
			 	<select name="insuranceLevel" data-native-menu="false">
			 		<option value="">--返佣保证金金额--</option>
			 		<option value="1">500元-1000元</option>
			 		<option value="2">1001元-3000元</option>
			 		<option value="3">3001元-10000元</option>
			 		<option value="4">10001元以上</option>
			 	</select>
			 	<input type="number" name="returnRatio" id="returnRatio" placeholder="返佣比例,合同金额的百分比%"/>
			 	<input type="button" onclick="addSupplierApply();"  data-inline="true"  value="提交申请"/>
			 </div>
			</form>
		</div>
	</div>

</body>
</html>
