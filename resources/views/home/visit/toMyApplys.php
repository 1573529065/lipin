

<!DOCTYPE html>
<html>
<head>
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
<style>
		*,body{
		margin:0;
		padding:0;
	}
	#listApplys a{
		font-size:0.9em; 
		margin-top:1.5em;
	}
	#listApplys span{
		 font-weight:bold;
		 margin-left:0.5em;
	}
</style>
</head>
	
<body>

<div data-role="page" id="myApplysPage">
	<script>
	var path = "";
	/*
	var li = "<li style='padding:0.2em;'><div style='margin-top:0.5em;margin-left:1em;'>受访公司:<span style='margin-left:0.5em;'>{0}</span><span style='margin-left:2em;background:pink;' class='ui-btn ui-btn-inline'>{1}</span></div><div style='line-height:2em;'><a style='margin-left:5em;' href='#' onClick='showInfo({2})' class='ui-btn ui-btn-inline'>查看采购信息</a></div></li>";
	*/
	var li ="<li style='padding:0.2em;'><div style='margin-top:0.5em;margin-left:1em;'><div><a onclick='showInfo({2})' style='float:right;' class='ui-btn ui-btn-inline'>查看采购信息</a><span style='margin-top:1em;font-weight:bold;'>受访公司:</span><span style='margin-left:1em;font-weight:bold;color:blue;'>{0}</span><br/><span style='margin-top:1em;font-weight:bold;'>状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态:</span><span style='margin-left:1em;font-weight:bold;color:blue;'>{1}</span></div></div></li>";


	function showInfo(id){
		$.mobile.changePage(path+"/ucenter/toShowApplyPurchaseInfo.php",{data:"id="+id,type:"post",transition:"flip"});
	}
	function findMyApplys(){
		$.ajax({
			url:path+"/visit/findMyApplys.php",
			type:'post',
			success:function(map){
				var resultCode = map.resultCode;
				if(resultCode=='1'){
					var $ul = $("#listApplys");
					$ul.empty();
					var data = map.data;
					for(var i=0;i<data.length;i++){	
						var req = data[i];
						var tli = li.replace("{0}",req.toVcom.companyName)
						var status = req.status;
						var $tli = null;
						if(status == '0'){
							tli = tli.replace("{1}","等等接受");
							$tli = $(tli);
							$tli.find("a").remove();
						}else if(status == '1'){
							tli = tli.replace("{1}","<font color='red'>已接受</font>");
							tli = tli.replace("{2}",req.id);
							$tli = $(tli);
						}else{
							tli = tli.replace("{1}","<font color='red'>已拒绝</font>");
							$tli = $(tli);
							$tli.find("a").remove();
						}
						$ul.append($tli);
					}
					$ul.listview("refresh");
				}else{
					showMyPopup("加载数据发生异常!", 0);
				}
			}
		});
	}
	$(document).on("pageinit","#myApplysPage",function(){
		findMyApplys();
	});
	</script>
		<div data-role="header" data-position="fixed">
			<h1>我的拜访申请</h1>
			<a href="#" data-rel="back" data-icon="back">返回</a>
		</div>
	
		<div data-role="main" class="ui-content" >
			<ul data-role="listview" id="listApplys">
				<!-- <li style='padding:0.2em;'>
					<div style="margin-top:0.5em;margin-left:1em;">
						受访公司:<span style='margin-left:0.5em;'>大圣科技asdfasdfasdfsdfasdf</span><span style="margin-left:2em;background:pink;" class="ui-btn ui-btn-inline">尚未接受</span>
					</div>
					<div style="line-height:2em;">
						<a style="margin-left:5em;" class="ui-btn ui-btn-inline">查看采购信息</a>
					</div>
				
				</li> -->
			</ul>
		</div>
</div>


</body>
</html>