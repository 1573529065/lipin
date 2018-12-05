

<!DOCTYPE html>
<html>
<head>
	<title>拜访申请</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css" />
	<link rel="stylesheet" href="/css/mobiscroll_date.css" />
	<link rel="stylesheet" href="/css/mobiscroll.css" />
	<script type="text/javascript"
		src="/js/jquery.js"></script>
	<script type="text/javascript"
		src="/js/jquery.form.js"></script>
	<script type="text/javascript"
		src="/js/jquery.validate.min.js"></script>
	<script
		src="/js/jquery.mobile-1.4.5.js"></script>
	<script src="/js/common.js"></script>
			<script type="text/javascript"
		src="/js/mobiscroll_date.js"></script>
		<script type="text/javascript"
		src="/js/mobiscroll.js"></script>
	
<style>
	*,body{
		margin:0;
		padding:0;
	}
	label{
		font-weight:bold;
		font-size:0.75em;
		
	}
	
</style>
</head>
	
<body>

<div data-role="page" id="visitReqPage">
		
	<script>
		var path = "";
		function addVisitReq(){
			var $form = $("#visitReqForm");
			if($form.valid()){
				$form.ajaxSubmit({
					url:path+"/visit/addVisit.php",
					type:"post",
					success:function(map){
						var resultCode = map.resultCode;
						if(resultCode=='1'){
							window.location.href=path+"/vcom/toVcoms.php";
						}else if(resultCode=='-1'){
							showMyPopup("自己不能拜访自己!",0);
						}else if(resultCode=='-2'){
							showMyPopup("<font color='red'>对不起你的金币数不足!</font><br/><font><a href='/ucenter/toChargePage.php'>请到个人中心充值</a></font>",0);
						}else{
							showMyPopup("申请拜访失败！", 0);
						}
					}
				});
			}
		}
		$(document).on("pageinit","#visitReqPage",function(){
			jQuery.validator.addMethod("mobile", function (value, element) {
				var pattern = /^1[3|5|7|8]\d{9}$/gi;
				return this.optional(element) || (pattern.test(value));
			}, "非法的手机号码!");
			var currYear = (new Date()).getFullYear();	
			var opt={};
			opt.date = {preset : 'date'};
			opt.datetime = {preset : 'datetime'};
			opt.time = {preset : 'time'};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
				display: 'modal', //显示方式 
				mode: 'scroller', //日期选择模式
				dateFormat: 'yyyy-mm-dd',
				lang: 'zh',
				showNow: true,
				nowText: "今天",
				startYear: currYear - 50, //开始年份
				endYear: currYear + 30 //结束年份
			};
			
			$("#f_reqTime").mobiscroll($.extend(opt['datetime'], opt['default']));
			$("#additionalGold").on("change",function(){
				var val = $(this).val();
				if(val==''){
					$("#totalGold").val("");
				}else{
					$("#totalGold").val(parseInt($("#baseGold").val())+parseInt(val));
				}
			});

			$("#visitReqForm").validate({
				rules:{
					"fromVcom.companyName":{
						required:true
					},
					"fromVcom.contactor":{
						required:true
					},"fromVcom.contactorTitle":{	
						required:true
					},"fromVcom.mainProducts":{
						required:true
					},"fromVcom.companyDesc":{
						required:true
					},reqTimeStr:{
						required:true
					}
				},
				messages:{
					"fromVcom.companyName":{
						required:"<font style='color:red;font-size:0.75em;'>公司名必须填写!</font>"
					},
					"fromVcom.contactor":{
						required:"<font style='color:red;font-size:0.75em;'>联系人必须填写!</font>"
					},"fromVcom.contactorTitle":{	
						required:"<font style='color:red;font-size:0.75em;'>职务必须填写!</font>"
					},"fromVcom.mainProducts":{
						required:"<font style='color:red;font-size:0.75em;'>主营产品必须填写!</font>"
					},"fromVcom.companyDesc":{
						required:"<font style='color:red;font-size:0.75em;'>公司简介必须填写!</font>"
					},reqTimeStr:{
						required:"<font style='color:red;font-size:0.75em;'>意向拜访时间必须填写!</font>"
					}
					
				}
			});
			
			$("#addVisitBtn").on("click",function(){
				addVisitReq();
			});
	});

	</script>
		<div data-role="header" data-position="fixed">
			<h1>拜访申请</h1>
			<a href="#" data-rel="back" data-icon="back">返回</a>
		</div>
	
		<div data-role="main" class="ui-content" >
			<form id="visitReqForm">
			<div data-role="fieldcontain">
				<h4>受访公司</h4>
				<hr/>
				<br/>
				<input name="toVcom.id" type="hidden"  value="1749"/>
				<label for="f_toCompanyName"><font style="font-size:0.75em;font-weight:bold;">受访公司</font></label>
				<input type="text" id="f_toCompanyName" readonly="readonly" value="苏州迈泰克自动化技术有限公司">
				<label for="f_toName"><font style="font-size:0.75em;font-weight:bold;">受访人职务</font></label>
				<input type="text" id="f_toContactorTitle" readonly="readonly" value="采购部主管">
				<label for="f_reqTime"><font style="font-size:0.75em;font-weight:bold;">意向拜访时间</font></label>
				<input id="f_reqTime" name="reqTimeStr" readonly="readonly">
				<br/>
				<hr/>
				<h4>申请公司信息</h4>
				<input name="fromVcom.id" type="hidden" value="20650"/>
				<label for="f_fromCompanyName"><font style="font-size:0.75em;font-weight:bold;">申请公司</font></label>
				<input type="text" id="f_fromCompnayName" name="fromVcom.companyName" value="1"/>
				<label for="f_fromName"><font style="font-size:0.75em;font-weight:bold;">联系人</font></label>
				<input type="text" value="2" name="fromVcom.contactor" id="f_fromName"/>
				<label for="f_fromContactorTitle"><font style="font-size:0.75em;font-weight:bold;">职务</font></label>
				<input type="text" value="3" name="fromVcom.contactorTitle" id="f_fromContactorTitle"/>
				<label for="f_fromMainProducts"><font style="font-size:0.75em;font-weight:bold;">主营产品</font></label>
				<input type="text"  value="5" name="fromVcom.mainProducts" id="f_fromMainProducts"/> 
				<label for="f_fromCompanyDesc"><font style="font-size:0.75em;font-weight:bold;">公司简介</font></label>
				<textarea rows="2" cols="20" id="f_fromCompanyDesc" name="fromVcom.companyDesc">6</textarea>
				<label for="baseGold"><font style="font-size:0.75em;font-weight:bold;">基础金币</font></label>
				<input type="text"  name="baseGold" id="baseGold" value="100" readonly="readonly"/>
				<label for="additionalGold"><font style="font-size:0.75em;font-weight:bold;">悬赏金币</font></label>
				<select name="additionalGold" id="additionalGold" >
					<option value="0">请选择悬赏金币</option>
					<option value="10">10金币</option>
					<option value="20">20金币</option>
					<option value="50">50金币</option>
					<option value="100">100金币</option>
				
				</select>
				
				<label for="totalGold"><font style="font-size:0.75em;font-weight:bold;">金币合计</font></label>
				<input type="text" name="totalGold" id="totalGold" value="100" readonly="readonly"/>
				<a href="" id="addVisitBtn" class="ui-btn ui-btn-inline" style="margin-top:1em;margin-left:3em;">发起拜访请求</a>
				</div>
			</form>

		</div>
</div>
</body>
</html>