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
			$(this).parents('td.like label').append('<span class="icon"></span><span class="txtLike">Like</span>');
		} else {
			$(this).parents('td.like').find('span.txtLike').remove();
			$(this).parents('td.like').find('span.icon').remove();
			//$(this).remove('<span class="icon"></span><span class="txtLike">like</span>');
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
			$(this).find('label').append('<span class="icon"></span><span class="txtLike">Like</span>');
		}
	});
});


/* ===============================================
# tablesorter Setting
=============================================== */
function teblesorterOn () {
	$("#contentMain table").tablesorter();
} 
$(function () {
	teblesorterOn();
});

/* ===============================================
# Tab Select
=============================================== */

//クリック時にチェックボックスの値を記録
$(function () {
	$( '#navMain li a' ).click( function() {
		var _val = $(this).html();
		var _eq = $(this).parents('li').index();
		// console.log('_val=' + _val);
		// console.log('_eq=' + _eq);
		window.localStorage.setItem('tabSelect',_val);
	});
});
$(document).ready(function() {
	var getItem = window.localStorage.getItem('tabSelect');
	console.log('getItem=' + getItem);
	if (getItem == null) {
		console.log("getItemなし");
		$('#navMain li:first-child').addClass('active');
		$('#contentMain .tab-pane:first-child').addClass('active');
	} else {
		console.log("getItemあり");
		$('#navMain li a:contains(' + getItem +')').parents('li').addClass('active');
		$('#contentMain #' + getItem).addClass('active');
	}
});



