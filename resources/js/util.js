$(function () {
	$('.ovTable tbody tr').on('mouseenter' ,function(event) {
		event.preventDefault();
		/* Act on the event */
		//console.log('hover');
		var _this = $(this);
		var _getClass = $(this).attr('class');
		console.log(_getClass);





	});
});