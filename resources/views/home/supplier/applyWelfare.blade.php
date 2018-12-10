

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>佣金申请</title>

		<link rel="shortcut icon" href="/favicon.ico">
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
	</head>
	<body>
	<div data-role="page" id="welfarePage">
		<script type="text/javascript">
		var path = "";
		function initValidate(){
			
			$("#supplierApplyForm").validate({
				rules:{
					fromCompanyName:{
						required:true
					},
					mobile:{
						required:true,
						mobile:true
					},
					aliAccount:{
						required:true
					},
					toSupplierId:{
						required:true
					},
					contractMoney:{
						required:true
					},
					returnMoney:{
						required:true
					}
				},
				messages:{
					fromCompanyName:{
						required:"<font style='color:red;font-size:0.75em;'>公司名必须填写!</font>"
					},
					mobile:{
						required:"<font style='color:red;font-size:0.75em;'>买方手机号码必须填写!</font>",
						mobile:"<font style='color:red;font-size:0.75em;'>买方手机号码不合法!</font>"
					},
					aliAccount:{
						required:"<font style='color:red;font-size:0.75em;'>买方支付宝必须填写!</font>"
					},
					toSupplierId:{
						required:"<font style='color:red;font-size:0.75em;'>卖方公司必须填写!</font>"
					},
					contractMoney:{
						required:"<font style='color:red;font-size:0.75em;'>合同金额必须填写!</font>"
					},
					returnMoney:{
						required:"<font style='color:red;font-size:0.75em;'>福利金额必须填写!</font>"
					}
					
				}
			});
		}
		
	function addWelfare(){
		var $form = $("#welfareForm");
		if($form.valid()){
			$form.ajaxSubmit({
				url:path+"/wel/addWelfare.php",
				type:"post",
				success:function(res){
					
					var resultCode = res.resultCode;
					if(resultCode=='1'){
						window.location.href=path+"/supplier/toSupplierMgr.php";
						
					}else{
						showMyPopup("申请福利失败！",0);
					}
				}
			});
	       }
	}
	
	var opt = "<option value='{0}-{1}'>{2}</option>";
	function getSuppliers(){
		$.ajax({
			url:path+"/supplier/findSimpleSuppliers.php",
			type:'post',
			success:function(res){
				if(res){
					var $salor = $("#salor");
					$salor.find("option:gt(0)").remove();
					for(var i=0;i<res.length;i++){
						var sup = res[i];
						var myop = opt.replace('{0}',sup.id);
						myop = myop.replace('{1}',sup.returnRatio);
						myop = myop.replace('{2}',sup.name);
						$salor.append(myop);
					}
					$salor.selectmenu("refresh");
				}
			}
		});
	}
	$(document).on("pageinit","#welfarePage",function(){
		getSuppliers();
		var returnRatio = "";
		$("#contractMoney").bind("change",function(){
			var $this = $(this);
			var val = $.trim($this.val());
			if(val==''){
				$("#returnMoney").val("");
			}else{
				if(returnRatio!=''){
					$("#returnMoney").val((returnRatio*parseFloat(val)).toFixed(0));
				}else{
					$("#returnMoney").val("");
				}
			}
		});
		$("#salor").bind("change",function(){
			var $this = $(this);
			var val = $.trim($this.val());
			if(val==''){
				$("#toSupplierId").val("");
				$("#returnMoney").val("");
			}else{
				var supplierId = val.substring(0,val.indexOf('-'));
				$("#toSupplierId").val(supplierId);
				var str1 = val.substring(val.indexOf('-')+1)
				returnRatio = parseFloat(str1);
				
		   }
		});
			
	});
		</script>
		<div data-role="header">
			<a href="#" data-rel="back" data-icon="back">返回</a>
			<h2>佣金申请</h2>
		</div>
		<div data-role="main" class="ui-content">
			<form id="welfareForm" >
				 <div data-role="fieldcontain">
				 	<input type="text" name="fromCompanyName" placeholder="买方企业" value="1">
				 	<input type="hidden" name="fromUserId" value="20650"/>
				 	<input type="text" name="mobile" readonly="readonly" placeholder="买方手机号码" value="15093375805">
				 	<input type="text" name="aliAccount" placeholder="支付宝账号">
					<div class="ui-field-contain">
				 	<select id="salor" data-native-menu="false" class="filterable-select">
				 		<option value="">--选择卖方--</option>
				 	</select>
				 	</div>
				 	<input type="hidden"  name="toSupplierId" id="toSupplierId"/>
				 	<input type="number" name="contractMoney" id="contractMoney" placeholder="合同金额">
				 	<input type="number" name="returnMoney" id="returnMoney" placeholder="福利金额" readonly="readonly">
				 	<input type="button" onclick="addWelfare()" value="提交申请">
				 </div>
			</form>
		</div>
	</div>

</body>
</html>
