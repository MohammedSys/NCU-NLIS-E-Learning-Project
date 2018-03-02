// $(document).ready(function () {
// 	$('#left-menu-toggle').on('click', function ()
// 	{
// 		// $('#B').toggleClass('push-right');
// 		$('#side-menu-main').toggleClass('set-menu-open');
// 	});
// });

function openSideMenu( id, classname )
{
	$('#' + id).toggleClass( classname );
}