function resizeIframe(obj)
{
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	$('#iframe-parent').css("height", obj.style.height);
}