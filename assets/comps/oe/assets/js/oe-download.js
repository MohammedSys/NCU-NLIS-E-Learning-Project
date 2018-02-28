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

$(document).ready( function()
{
	$('#dHtml').click( function(e)
	{
		var DC = resultHU + resultHLBU + $('#htmlTA').val() + resultBL;
		
		$.generateFile({
			filename	: 'page.html',
			content		: DC,
			script		: 'assets/php/oe-download.php'
		});
		
		e.preventDefault();
	});
	
	$('#dCss').click( function(e)
	{
		$.generateFile({
			filename	: 'style.css',
			content		: $('#cssTA').val(),
			script		: 'assets/php/oe-download.php'
		});
		
		e.preventDefault();
	});
	
	$('#downloadPage').click(function(e)
	{
		var hTA = $(parent.editbox.document).contents().find('#htmlTA').val();
		var cTA = $(parent.editbox.document).contents().find('#cssTA').val();
		
		var DC = resultHU + cTA + resultHLBU + hTA + resultBL;
		
		$.generateFile({
			filename	: 'result.html',
			content		: DC,
			script		: 'assets/php/oe-download.php'
		});
		
		e.preventDefault();
	});
	
});