
// Dynamically setting the location of the previous & next page btn.
function setLocationOfBtn()
{
	var clientHeight = document.getElementById('slides-printer').clientHeight;
	
	var target = window.tmsbox.document.getElementById("toolbarViewerCenter");
	// alert(target.clientHeight);
	
	target.style.top = (clientHeight / 2) + "px";
}

// Close the unuse btns.
function closeUnuseBtn()
{
	var target = window.tmsbox.document.getElementById("download");
	target.style.visibility = "hidden";
	target = window.tmsbox.document.getElementById("openFile");
	target.style.visibility = "hidden";
	target = window.tmsbox.document.getElementById("viewBookmark");
	target.style.visibility = "hidden";
	
	// target = window.tmsbox.document.getElementById("secondaryDownload");
	// target.style.visibility = "hidden";
	// target = window.tmsbox.document.getElementById("secondaryOpenFile");
	// target.style.visibility = "hidden";
	// target = window.tmsbox.document.getElementById("secondaryViewBookmark");
	// target.style.visibility = "hidden";
	
	
	$("#secondaryDownload").remove();
	$("#secondaryOpenFile").remove();
	$("#secondaryViewBookmark").remove();
}

$(document).ready( function()
{
	var tmsframe = document.getElementById('displayFrame');
	tmsframe.onload = function()
	{
		setLocationOfBtn();
		closeUnuseBtn();
	};
});

$(window).resize( function()
{
	setLocationOfBtn();
	closeUnuseBtn();
});