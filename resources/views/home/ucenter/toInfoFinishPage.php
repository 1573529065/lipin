

<!DOCTYPE html>
<html>
<head>
	<title>金币提现</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css" />
	<script type="text/javascript"
		src="/js/jquery.js"></script>
	<script type="text/javascript"
		src="/js/jquery.form.js"></script>
	<script type="text/javascript"
		src="/js/jquery.validate.min.js"></script>
	<script
		src="/js/jquery.mobile-1.4.5.js"></script>
	<script src="/js/common.js"></script>
<style>
	*,body{
		margin:0;
		padding:0;
	}

a{ 
	text-decoration: none;
	list-style: none;
}
</style>
</head>
	
<body>

<div data-role="page" id="infoFinishPage">
	<script type="text/javascript">
		var path = "";
		$(document).on("pageinit","#infoFinishPage",function(){
			$("#infoFinishBtn").bind("click",function(){
				$("#infoFinishForm").ajaxSubmit({
					url:path+"/user/finishUserInfo.php",
					success:function(map){
						var resultCode = map.resultCode;
						if(resultCode=='1'){
							window.location.href=path+"/ucenter/toCenter.php";
						}else{
							showMyPopup("完善个人信息失败!", 0);
						}
					}
				});
			});
		});
	</script>
	<div data-role="header">
		<h2>信息完善</h2>
	</div>
	<div data-role="main" class="ui-content">
		<form id="infoFinishForm">
			<input name="companyName" value="1" placeholder="公司名称" />
			<input name="contactor" value="2" placeholder="联系人"/>
			<input name="contactorMobile" value="15612341234" placeholder="联系手机"/>
			<input name="contactorTitle" value="3"  placeholder="职务"/>
			<a href="#" data-role="button" id="infoFinishBtn" class="ui-btn ui-btn-inline">提交</a>
		</form>
		<div style="color:red;font-size:0.75em;pading-left:2em;">
			友情提示：完善后每次发布采购需求时自动回填联系信息!
		</div>
	</div>
</div>
</body>
</html>