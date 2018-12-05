

<!DOCTYPE html>
<html>
<head>
	<title>采购实名制认证</title>
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

<div data-role="page" id="realNameCertPage">
	<script type="text/javascript">
		var path = "";
		$(document).on("pageinit","#realNameCertPage",function(){
			$("#realNameBtn").bind("click",function(){
				$("#rzForm").ajaxSubmit({
					url:path+"/user/uploadCardPic.php",
					success:function(map){
						map = map.replace("<pre>","");
						map = map.replace("</pre>","");
						var res = eval('('+map+')');
						var resultCode=res.resultCode;
						if(resultCode=='1'){
							showMyPopup("上传成功!管理员将及时审核,请耐心等待!", 1);
							$("#realizeSpan").html("已经上传，等等审核通过!");
						}
						else if(resultCode=='-1'){
							showMyPopup("必须选择名片!", 0);
						}else{
							showMyPopup("上传失败!", 0);
						}
					}
						
				});
			});
		});
	</script>
	<div data-role="header">
		<h2>采购实名制认证</h2>
		<a href="#" data-rel="back" data-icon="back">返回</a>
	</div>
	<div data-role="main" class="ui-content">
	 	<div style="border:1px dashed;width:80%;margin-top:2em;">
	 		<form id="rzForm" enctype="multipart/form-data">
	 		<span>状态:<font style="margin-left:1em;color:red" id="realizeSpan">尚未实名制认证</font></span>
	 		<input type="file" name="cardFile"/>
	 		<a href="#" data-role="button" id="realNameBtn">确认认证</a>
	 		</form>
	 	</div>
	 	
	 	<div style="margin-top:2em;">
	 		<p style="font-weight:bold;">友情提示:</p>           
	 		<p style="color:blue;padding-left:1em;font-size:1em;">1.请提交本人真实有效的名片</p>
	 		<p style="color:blue;padding-left:1em;font-size:1em;">2.目前仅接受:专职采购申请认证</p>
	 		<p style="color:blue;padding-left:1em;font-size:1em;">3.未经授权本站不会外泄信息</p>
	 		<p style="color:blue;padding-left:1em;font-size:1em;">4.请勿反复提交、请勿提交无关照片、捣乱者封号处理</p>
	 	</div>
	</div>
</div>
</body>
</html>