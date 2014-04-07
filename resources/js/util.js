/* ===============================================
# Table Mouseover
=============================================== */
$(function () {
	$('.ovTable tbody tr').on('mouseenter' ,function(event) {
		event.preventDefault();
		/* Act on the event */
		//console.log('hover');
		var _this = $(this);
		var _tableClass = $(this).attr('class');

		$('#keyboard-wrap').attr('class','');
		$('#keyboard-wrap').addClass(_tableClass);
		console.log(_getClass);

	});
	$('.ovTable tbody tr').on('mouseout' ,function(event) {
		event.preventDefault();
		$('#keyboard-wrap').attr('class','');
	});
});

/* ===============================================
# keyboardType Select
=============================================== */
$(function () {
	$( 'input[name="keyboardType"]:radio' ).change( function() {
		var _val = $( this ).val();
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(_val);
	});
});

/* ===============================================
# Local Storage
=============================================== */
