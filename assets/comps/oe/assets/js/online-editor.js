var resultHU =
	'<!DOCTYPE html>\n' +
	'<head>\n' +
	'<meta charset="UTF-8">\n' +
	'<style>\n' +
	'html { overflow: auto; }\n' +
	'body { overflow: auto; }\n';

var resultHLBU =
	'\n<\/style>\n' +
	'<\/head>\n' +
	'<body>\n';

var resultBL =
	'\n<\/body>\n' +
	'<\/html>';

var load = "";

function update()
{
	var htmlText = window.editbox.document.getElementById("htmlTA").value;
	var cssText = window.editbox.document.getElementById("cssTA").value;
	
	// alert(htmlText);
	// alert(cssText);
	
	// var iframe = window.frames['dynamicframe'];
	// var iframe = document.getElementById("dynamicframe");
	var d = window.dynamicframe.document;
	
	if( load != resultHU + cssText + resultHLBU + htmlText + resultBL )
	{
		load = resultHU + cssText + resultHLBU + htmlText + resultBL;
		
		// alert(load);
		d.open();
		d.write(load);
		d.close();
	}
	// iframe.src = 'data:text/html;charset=utf-8,' + encodeURI( load );
	// iframe.src = iframe.src;
	// document.getElementById("dynamicframe").contentDocument.location.reload(true);
	window.setTimeout(update, 150);
}

function startup()
{
	window.editbox.document.getElementById("htmlTA").value = '<h1>歡迎使用 E-Learning Online Editor<\/h1>';
	window.editbox.document.getElementById("cssTA").value = '/* 請在此輸入 CSS */\n';
	update();
}

// window.onload=function()
// {
// 	if(navigator.userAgent.indexOf('Safari')!=-1&&navigator.userAgent.indexOf('Chrome')==-1)
// 	{
// 		var cookies=document.cookie;
// 		if(top.location!=document.location)
// 		{
// 			if(!cookies)
// 			{
// 				href=document.location.href;
// 				href=(href.indexOf('?')==-1)?href+'?':href+'&';
// 				top.location.href =href+'reref='+encodeURIComponent(document.referrer);
// 			}
// 		}
// 		else
// 		{
// 			ts=new Date().getTime();document.cookie='ts='+ts;
// 			rerefidx=document.location.href.indexOf('reref=');
// 			if(rerefidx!=-1)
// 			{
// 				href=decodeURIComponent(document.location.href.substr(rerefidx+6));
// 				window.location.replace(href);
// 			}
// 		}
// 	}
// }