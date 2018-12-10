

<!DOCTYPE html>
<html>
<head>
	<title>用户登录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/jquery.mobile-1.4.5.css" />
	<script type="text/javascript"
		src="{{asset('home/js/jquery.js')}}"></script>
	<script type="text/javascript"
		src="{{asset('home/js/jquery.form.js')}}"></script>
	<script type="text/javascript"
		src="{{asset('home/js/jquery.validate.min.js')}}"></script>
	<script
		src="{{asset('home/js/jquery.mobile-1.4.5.js')}}"></script>
	<script src="{{asset('home/js/common.js')}}"></script>
	<script src="{{asset('home/js/jquery.cookie.js')}}"></script>

	<script>
		var path = "";	
		var fileSize = "3";
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?df6cdbe16936f2cd964ed965155993d8";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
		var rememberPwd = -1;
		$(document).on("pageinit","#loginPage",function(){
			jQuery.validator.addMethod("mobile", function (value, element) {
				var pattern = /^1[3|4|5|7|8]\d{9}$/gi;
				return this.optional(element) || (pattern.test(value));
			}, "非法的手机号码!");
			var t = new Date().getTime();
			var storage = window.localStorage;
			var mobile = storage.getItem("mobile");
			var pwd = storage.getItem("pwd");
			if(mobile){
				$("#pwd").val(pwd);
				$("#mobile").val(mobile);
				$("#rememberPwd").attr("checked",true);
				 rememberPwd = 1
			}
			if(fileSize){
				fileSize = parseInt(fileSize);
			}else{
				fileSize = 1;
			}
			$("#login_img").attr("src",path+"/images/loginAD/"+(t%fileSize)+".jpg?t="+t);

			$("#loginForm").validate({
				rules:{
					mobile:{
						required:true,
						mobile:true
					},
					
					pwd:{
						required:true
					}
				},
				messages:{
					mobile:{
						required:"<font style='color:red;font-size:0.75em;'>手机号码必须填写!</font>",
						mobile:"<font style='color:red;font-size:0.75em;'>手机号码不合法!</font>"
					},
					
					pwd:{
						required:"<font style='color:red;font-size:0.75em;'>密码必须填写!</font>"
					}
				}
			});
		
			$("#rememberPwd").bind("change",function(){
				rememberPwd=rememberPwd*(-1);
				//alert(rememberPwd);
			});

	});
		function login(){
			if($("#loginForm").valid()){
				$("#loginForm").ajaxSubmit({
					url:path+"/user/login.php",
					type:"post",
					dataType:"json",
					success:function(map){
						var resultCode = map.resultCode;
						if(resultCode == '1'){
							var storage = window.localStorage;
							if(rememberPwd==1){
								storage.setItem("mobile",$("#mobile").val());
								storage.setItem("pwd",$("#pwd").val());
							}else{
								storage.clear();
							}
							window.location.href=path+"/bill/toMain.php";
						//window.location.href=path+"/vcom/toVcoms.php";
							
						}
						else if(resultCode=='-1'){
						//	$("#show_dialog_content").html("手机或者密码错误!");
						//	goTo('#showDiag');
							showMyPopup("手机或者密码错误!",0);
						}else if(resultCode=='-2'){
							showMyPopup("您的账号已被停用，请联系管理员!",0);
						}else{
						//	$("#show_dialog_content").html("服务器忙！稍后再试！");
						//	goTo('#showDiag')
							showMyPopup("服务器忙！稍后再试！",0);
						}
					}
				});

			}
		}
	</script>
<style>
	*,body{
		margin:0;
		padding:0;
	}
	
</style>
</head>
	
<body>

<div data-role="page" id="loginPage">

		<div data-role="header" data-position="fixed">
			<h1>用户登录</h1>
		</div>
		<section>
			<div style="width:100%;height:40%;">
			<img id="login_img" style="width:99%;height:100%;">
				<!-- <a href="http://www.hdb.com/party/jccsb.html">
				
				</a> -->
			</div>
		</section>
		<div data-role="main" class="ui-content" id="loginContent" >
			<form method="post" id="loginForm">
			<input type="text" id="mobile" name="mobile" placeholder="手机号码" style="width:70%;" />
			
			<input type="password" id="pwd" name="pwd" placeholder="密  码 " />
			 
			<label for="rememberPwd" style="display:inline;">记住密码</label>
			<input type="checkbox"  id="rememberPwd" data-role="none"  value="1"/>
			
			<br/>
			<a  href="#"  class="ui-btn ui-btn-inline" onClick="login();" style="width:50px;height:19px;">登录</a>
			<a href="/user/toForgotMM.php" data-ajax="false" data-transition="flip" style="font-size: 0.75em;margin-left:5em;text-decoration: none;" >忘记密码</a>
			</form>
				<div class="toRegDiv">
					&nbsp;&nbsp;未建立帐号？
					
					
					<a href="/user/toRegister.php"  data-ajax="false"  style="text-decoration: none;" data-transition="flip">点击注册</a> 
				
					
				</div>
		</div>

</div>
</body>
</html>