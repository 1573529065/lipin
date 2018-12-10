

<!DOCTYPE html>
<html>
<head>
	<title>订单自动通知定制</title>
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
	#tb1 tr th{
		border:1px solid #ccc;
		height:3em;
	}
td{
	text-align:center;
}
a{ 
	text-decoration: none;
	list-style: none;
}
</style>
</head>
	
<body>

<div data-role="page" id="myKeyWordsPage">
	<script>
		var path = "";
		function delMyKeyWord(id){
			$.ajax({
				url:path+"/keyWord/delMyKeyWord.php",
				type:"post",
				data:{id:id},
				success:function(map){
					var resultCode=map.resultCode;
					if(resultCode=='1'){
						listMyKeyWords();
					}else{
						showMyPopup("<font color='red'>删除关键字符发生异常!</font>",0);
					}
				}
				
			});
		}
		var keyWordQty = 0;
		function listMyKeyWords(){
			$.ajax({
				url:path+"/keyWord/findMyKeyWords.php",
				success:function(map){
					var resultCode=map.resultCode;
					if(resultCode=='1'){
						var keyWords = map.data;
						var $body = $("#tb1_body");
						$body.empty();
						var tr = "<tr style='background-color:#E6E6FA;'><td>{1}</td><td>{2}</td><td>{3}</td><td>{4}</td></tr>";
						var sa = "<a href='javascript:;' onclick='delMyKeyWord({0})' data-role='button' class='ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left ui-mini'>删除</a>";
						keyWordQty = keyWords.length;
						for(var i=0;i<keyWords.length;i++){
							var keyWord = keyWords[i];
							sa = sa.replace("{0}",keyWord.id);
							var mtr = tr.replace("{1}",(i+1));
							mtr = mtr.replace("{2}",keyWord.word);
							mtr = mtr.replace("{3}",keyWord.createTimeStr);
							mtr = mtr.replace("{4}",sa);
							
							$body.append($(mtr));
						}
					}else{
						showMyPopup("加载数据发生异常...", 0);
					}
				}
			});

		}
		
		function toAddMyKeyWord(){
			if(keyWordQty<5){
				$("#keyWord").val("");
				goTo("#addMyKeyWordPage");
			}else{
				showMyPopup("<font color='red'>最多不能超过5个关键字!</font>",0);
			}
		}
		$(document).on("pageinit","#myKeyWordsPage",function(){
			listMyKeyWords();
		});
	</script>
	<div data-role="header">
	    <h2>我的关键字</h2>
	    <!-- <a href="#" data-rel="back" data-icon="back">返回</a> -->
	    <a href="/ucenter/toCenter.php" data-ajax="false"  class="ui-btn ui-icon-back ui-icon-left ui-btn-inline ui-mini"  data-transition="flip">返回</a>
	</div>
	
	<div role="main" class="ui-content">
		<div style="margin-top:1em;">
			<span style="font-weight:bold;padding-left:8em;">我的关键词</span>
		</div>
		<table id="tb1" style="border:1px solid #ccc;width:100%;margin-top:1em;font-size:0.75em;">
			<thead>
				<th>序号</th>
				<th>关键词</th>
				<th>增加时间</th>
				<th>操作</th>
			</thead>
			<tbody id="tb1_body">
				
				
			</tbody>
		</table>
	
		<a href="javascript:;"  onclick="toAddMyKeyWord();"  data-rel="dialog" data-role="button" class="ui-btn ui-btn-inline" style="margin-left:6em;margin-top:2em;">增加关键词</a>
	
		<div style="margin-top:2em;">
			<p style="font-weight:bold;color:red;">
				订单自动通知说明：
			</p>
			<p style="color:red;font-size:0.75em;padding-left:0.5em;">
			<br/>
			1.每个用户可以免费登记5个关键词。
			<br/>
			2.每个关键词可以输入2-4个字符（中英文皆可）。
			<br/>
			
			3.完成登记后，若有相关订单微信公众号会主动推送信息给您。
			<br/>
			
			4.为保证您能及时准确收到信息，请勿取消关注、勿屏蔽本公众号信息。
			</p>
		</div>
	</div>
 </div>
 
 
 <div id="addMyKeyWordPage" data-role="page">
 	<script type="text/javascript">
 		var path = "";
		$(document).on("pageinit","#addMyKeyWordPage",function(){

			$("#addKeyWordBtn").bind("click",function(){
				
				var word = $("#keyWord").val().trim();
				if(/^[\u4e00-\u9fa5_a-zA-Z]{2,4}$/.test(word)){
					$.ajax({
						url:path+"/keyWord/addMyKeyWord.php",
						type:"post",
						data:{word:word},
						success:function(map){
							var resultCode = map.resultCode;
							if(resultCode=='1'){
								goTo("#myKeyWordsPage");
								listMyKeyWords();
							}else{
								showMyPopup("<font color='red'>增加关键字发生异常!</font>",0);
							}
						}
					})
				}else{
					showMyPopup("<font color='red'>关键字只能是2-4个中文或者英文字符!</font>",0);
				}
				
			});
		});
 	</script>
 	<div data-role="header">
 		<h2>增加关键字</h2>
 	</div>
 	<div data-role="main" class="ui-content">
 		<form id="keyWordForm">
 			<input name="keyWord"  id="keyWord" placeholder="关键词:2-4个中文或者英文字符"/>
 			<a href="#" data-role="button" id="addKeyWordBtn" data-inline="true">提交</a>
 		</form>
 	</div>
 </div>
</body>
</html>