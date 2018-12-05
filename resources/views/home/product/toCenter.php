

<!DOCTYPE html>
<html>
<head>
	<title>个人中心</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
	href="/css/jquery.mobile-1.4.5.css" />
<script type="text/javascript"
	src="/js/jquery.js"></script>
	<script type="text/javascript"
	src="/js/jquery.form.js"></script>
<script
	src="/js/jquery.mobile-1.4.5.js"></script>
	
<script
	src="/js/jquery.validate.min.js"></script>
	<script
	src="/js/common.js"></script>
	<script type="text/javascript">
	
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?45c68ef7725d1bdb84bcc4dfd9186b46";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();

	
	</script>
<style>
*,body{
	margin:0;
	padding:0;
}
#tb1 tr{
	height:80px;
}
#tb1 tr td{
	border:1px solid #ccc;
	width:33%;
	text-align:center;
}


</style>
</head>
	
<body>

<div data-role="page"  id="personCenterPage">
	<script type="text/javascript">
		var path="";
		var purl = "/bill/toPub.php";


		function bindPubBtnEvent(){
		
			$(".pub").click(function(event){
				$.ajax({
					url:path+"/user/hasRealize.php",
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
		$(document).on("pageinit","#personCenterPage",function(){
			bindPubBtnEvent();
		});
	</script>
	<div data-role="header">
		<h1>个人中心</h1>
	</div>

	<div role="main" class="ui-content">
	  <table id="tb1" style="width:100%;">
	  	<tr>
	  		<td>
	  			<span style="font-weight:bold;">余生</span>
	  		</td>
	  		<td>
	  			<span style="font-weight:bold;">金币</span><!--<span><img src="/images/gold.png" alt="没有图片" style="padding:5px;height:32px;"></span>--><span style="color:red;font-weight:bold;min-height:32px;">0</span><span style="font-weight:bold;">枚</span>
	  	
	  		</td>
	  		<td>
	  			<a href="/user/logout.php"   data-ajax="false" data-role="button" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-power" >退出</a>
	  		</td>
	  	</tr>
	  </table>
	  <!-- 
	   <ul data-role="listview" data-inset="true" style="margin-bottom:0px">
	  	 	<li><a href="/ucenter/toBenefit.php" data-ajax="false" data-transition="flip">优惠查询采购信息</a></li>
	  	</ul>
	  	 -->
	  <div data-role="collapsibleset" style="margin-top:0px;">
	  	  <div style="margin-bottom:-16px;margin-top:8px;">	 
		  	<ul data-role="listview" data-inset="true" style="margin-top:0px;">
		  	 	<li><a href="/keyWord/toObtainOpenId.php" data-ajax="false" data-transition="flip">采购信息自动通知</a></li>
		  	</ul>
	  	</div>
	  	 <div data-role="collapsible">
	  	 	<h3>我的采购信息管理</h3>
	  	 	<ul data-role="listview" data-inset="false">
	  	 		<li><a href="/ucenter/toMyPurchaseBills.php" data-ajax="false" data-transition="flip">已发的采购信息</a></li>
	  			<li><a href="/ucenter/toSaledRecords.php" data-ajax="false" data-transition="flip">已购的需求信息</a></li>
	  	 	</ul>
	  	 </div>
	  	 
	  	 <div data-role="collapsible">
	  	 	<h3>我的拜访/受访管理</h3>
	  	 	<ul data-role="listview" data-inset="false">
	  	 		<li><a href="/visit/toMyVisits.php" data-ajax="false" data-transition="flip">我的受访申请</a></li>
	  			<li><a href="/visit/toMyApplys.php" data-ajax="false" data-transition="flip">我的拜访申请</a></li> 
	  	 	</ul>
	  	 </div>
	  	 
	  	  <div data-role="collapsible">
	  	 	<h3>我的金币管理</h3>
	  	 	<ul data-role="listview" data-inset="false">
	  	 		<li><a href="/ucenter/toChargePage.php" data-ajax="false" data-transition="flip">金币充值</a></li>
	  			<li><a href="/ucenter/toCashPage.php" data-ajax="false" data-transition="flip">金币提现</a></li>
	  	 	</ul>
	  	 </div>
	  	 
	  	  <div data-role="collapsible">
	  	 	<h3>采购认证管理</h3>
	  	 	<ul data-role="listview" data-inset="false">
	  	 			<li><a href="/ucenter/toInfoFinishPage.php" data-ajax="false" data-transition="flip">信息已完善</a></li>
	  				<li><a href="/ucenter/toRealNameCertPage.php" data-ajax="false" data-transition="flip">采购实名制状态:&nbsp;&nbsp;尚未实名制认证</a></li>
	  	 	</ul>
	  	 </div>
	  	 
	  	 <ul data-role="listview" data-inset="true" style="margin-top:0px">
	  	 	<li><a href="/ucenter/toQuestions.php" data-ajax="false" data-transition="flip">使用说明</a></li>
	  	</ul>
	  </div>
	  <!-- 
	  <ul data-role="listview" style="margin-top:1em;">
	  	<li><a href="/ucenter/toMyPurchaseBills.php" data-ajax="false" data-transition="flip">已发的采购信息</a></li>
	  	<li><a href="/ucenter/toSaledRecords.php" data-ajax="false" data-transition="flip">已购的需求信息</a></li>
  	
		<li><a href="/visit/toMyVisits.php" data-ajax="false" data-transition="flip">我的受访申请</a></li>
	  	<li><a href="/visit/toMyApplys.php" data-ajax="false" data-transition="flip">我的拜访申请</a></li> 
	 
	  	<li><a href="/ucenter/toChargePage.php" data-ajax="false" data-transition="flip">金币充值</a></li>
	  	<li><a href="/ucenter/toCashPage.php" data-ajax="false" data-transition="flip">金币提现</a></li>
	  	<li><a href="/ucenter/toInfoFinishPage.php" data-ajax="false" data-transition="flip">信息已完善</a></li>
	  	<li><a href="/ucenter/toRealNameCertPage.php" data-ajax="false" data-transition="flip">采购实名制状态:&nbsp;&nbsp;尚未实名制认证</a></li>
	  	<li><a href="/ucenter/toMyKeyWord.php" data-ajax="false" data-transition="flip">订单自动通知定制</a></li>   
	  	<li><a href="/ucenter/toQuestions.php" data-ajax="false" data-transition="flip">使用说明</a></li>
	  </ul>
	    -->
	</div>
	
	<div data-role="footer" data-position="fixed"  data-tap-toggle="false">
	    <div data-role="navbar">
	       <ul>
	       <li><a href="/bill/toMain.php" data-ajax="false" data-rel="dialog"  data-transition="flip">采购列表</a></li>
	       <li><a href="/supplier/toSupplierMgr.php" data-ajax="false"  data-rel="dialog"  data-transition="flip">供应商库</a></li>
	       	 <li><a href="/vcom/toVcoms.php" data-ajax="false" data-rel="dialog" data-transition="flip">拜访采购</a></li>
			
 		  
 		  	<li><a href="/ucenter/toCenter.php" data-ajax="false" data-rel="dialog"  class="ui-btn-active ui-state-persist" data-transition="flip">个人中心</a></li>
		</ul>
	    </div>
	</div>
</div>

</body>
</html>