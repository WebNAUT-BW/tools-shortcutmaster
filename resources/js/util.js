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
		//console.log(_getClass);

	});
	$('.ovTable tbody tr').on('mouseout' ,function(event) {
		event.preventDefault();
		$('#keyboard-wrap').attr('class','');
	});
});

/* ===============================================
# keyboardType Select
=============================================== */
//ラジオボタン選択時に選択状態を記録
$(function () {
	$( 'input[name="keyboardType"]:radio' ).change( function() {
		var _val = $( this ).val();
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(_val);
		window.localStorage.setItem("keyboardType",_val);
	});
});

//ページロード時にキーボード選択状態を呼び出し、チェックを入れる
$(document).ready(function() {
	var data = window.localStorage.getItem("keyboardType");
	var _input = $('input[name="keyboardType"]');
	if (data == "") {
		return;
	} else {
		console.log('data=' + data);
		$("input[value='" + data  + "']:radio").attr('checked', 'checked');
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(data);
		return;
	}
});

/* ===============================================
# Like Select
=============================================== */
//クリック時にチェックボックスの値を記録
$(function () {
	$( 'input:checkbox' ).change( function() {
		var _val = $( this ).is(':checked');
		var _id = $( this ).parents('tr').attr('id');
		console.log('_val=' + _val);
		console.log('_id=' + _id);
		window.localStorage.setItem(_id,_val);
		if (_val == true){
			$(this).parents('td.like').append('<span class="txtLike">like</span>');
		} else {
			$(this).parents('td.like').find('span.txtLike').remove();
			//$(this).remove('<span class="txtLike">like</span>');
		}
		// var _keyboardBase = $('#keyboard-base');
		// _keyboardBase.attr('class','');
		// _keyboardBase.addClass(_val);
		// window.localStorage.setItem("keyboardType",_val);
		teblesorterOn();
	});
});

//ページロード時にチェックボックスの値を呼び出し、チェックを入れる
$(document).ready(function() {
	$('td.like').each(function() {
		var _id = $( this ).parents('tr').attr('id');
		console.log('_id=' + _id);
		var getItem = window.localStorage.getItem(_id);
		console.log('getItem=' + getItem);
		if (getItem == 'true'){
			console.log('_id=' + _id + ' is true');
			$(this).find('input:checkbox').attr("checked", true);
			$(this).append('<span class="txtLike">like</span>');
		}
	});
});


/* ===============================================
# tablesorter Setting
=============================================== */
function teblesorterOn () {
	$("#sortable").tablesorter();
} 
$(function () {
	teblesorterOn();
});
