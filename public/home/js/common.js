var myHostAddr = "http://zhizhum.com";
function setKey(key, value){  
    window.localStorage.setItem(key, value);  
}  
  
function getKey(key){  
    return window.localStorage.getItem(key);  
}  
  
function removeKey(key){  
    window.localStorage.removeItem(key);  
}  
  
function clearKey(){  
    window.localStorage.clear();  
}  
//测试更新方法  
function updateKey(key,value){  
    window.localStorage.removeItem(key);  
    window.localStorage.setItem(key, value);  
} 

function goTo(page){
	$.mobile.changePage(page,{
		transition:"flip"
	});
}

function showLoading(){
	$.mobile.loading("show",{
		text:"数据处理中...",
		textVisible:true,
		theme:"a",
		textonly:false,
		html:""
	});
}

function hideLoading(){
	$.mobile.loading("hide");
}
function selfPopupShow(id){  
    var popupWrp = $("#"+id+"Popup");  
    if(popupWrp.length < 1){  
        var popupWrp = $('<div id="'+id+'Popup" data-role="popup" style="backgroud:#F0F0F0;min-width:80%;" data-theme="e" data-overlay-theme="a" data-dismissible="false" class="ui-popup-container ui-popup-active ui-popup ui-corner-all"></div>');  
        popupWrp.append('<a class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right" onclick="selfPopupClose(\''+id+'\')" href="#">Close</a>');  
        popupWrp.append('<div id="'+id+'" class="ui-content" data-role="main" style="height:20%;margin-top:10%; overflow:auto"></div>');  
        popupWrp.appendTo($.mobile.pageContainer);  
        //<p align="left" style="margin: 0px; text-align: left;"><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">   
        
        //</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">用</span><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">$.mobile.activePage</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">时，如果不是通过</span><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">popupWrp.popup("close");</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">关闭的，且页面没重新加载，则           在第二次打开</span><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">popup</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">时要显示的数据不会显示（其实就是</span><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">popup</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">重复，即</span><span lang="EN-US" style="margin: 0px; color: rgb(63, 127, 95); font-family: 'Courier New'; font-size: 12pt;">id</span><span style="margin: 0px; color: rgb(63, 127, 95); font-family: 宋体; font-size: 12pt;">重复，因id重复而无法得到正常显示popup），</span></p>  
        //$.mobile.activePage.append(popupWrp);  
    }  
    popupWrp.trigger('create');  
    popupWrp.popup().enhanceWithin();  
    var openPopupFunc = function(){  
        popupWrp.popup("open");  
    }  
    return openPopupFunc;  
      
}  
//关闭对话框  
function selfPopupClose(id){  
    var popupWrp = $("#"+id+"Popup");  
    popupWrp.popup().enhanceWithin();  
    popupWrp.popup("close");  
      
}

function showMyPopup(msg,type){

	var openPopupFunc = selfPopupShow("schemePage");
	if(type=='0'){
		$("#schemePage").html('<p align="left" style="margin: 0px; text-align: left;"><span style="margin: 0px; color: rgb(255, 127, 95); font-size: 12pt;">' +
				msg+
				'</span>');  
	}else{
		$("#schemePage").html('<p align="left" style="margin: 0px; text-align: left;"><span style="margin: 0px; color: rgb(63, 127, 95); font-size: 12pt;font-color:#ff0000;">' +
				msg+
				'</span>');  
	}
	openPopupFunc();
}


Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

function ajaxSetup(){
	$.ajaxSetup({  
		beforeSend:function(){
			showLoading();
		},
	    complete :   
	    function(XMLHttpRequest, textStatus) { 
	    	hideLoading();
	        // 通过XMLHttpRequest取得响应头，sessionstatus  
	        var sessionstatus = XMLHttpRequest.getResponseHeader("SESSIONSTATUS");  
	        if (sessionstatus == "TIMEOUT") {  
	        	console.log("sessionstatus="+sessionstatus);
	            var win = window;  
	            while (win != win.top){  
	                win = win.top;  
	            }  
	             win.location.href= XMLHttpRequest.getResponseHeader("CONTEXTPATH");  
	        }  
	    }  
	});  
}

ajaxSetup();