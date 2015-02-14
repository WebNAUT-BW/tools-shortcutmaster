/* ===============================================
# Table Mouseover
=============================================== */
$(function () {
	$('.ovTable tbody tr').on('mouseover' ,function(event) {
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
		window.localStorage.setItem("UKC-keyboardType",_val);
	});
});

//ページロード時にキーボード選択状態を呼び出し、チェックを入れる
$(document).ready(function() {
	var data = window.localStorage.getItem("UKC-keyboardType");
	var _input = $('input[name="keyboardType"]');
	if (data == "") {
		return;
	} else {
		// console.log('data=' + data);
		$("input[value='" + data  + "']:radio").attr('checked', 'checked');
		var _keyboardBase = $('#keyboard-base');
		_keyboardBase.attr('class','');
		_keyboardBase.addClass(data);
		return;
	}
});

/* ===============================================
# Favorite Select
=============================================== */
//クリック時にチェックボックスの値を記録
$(function () {
	$( 'input:checkbox' ).change( function() {
		var _val = $( this ).is(':checked');
		var _id = $( this ).parents('tr').attr('id');
		// console.log('_val=' + _val);
		// console.log('_id=' + _id);
		window.localStorage.setItem('UKC-'+_id,_val);
		if (_val == true){
			$(this).parents('td.favorite label').append('★');
		} else {
			$(this).parents('td.favorite').find('span.txtFavorite').remove();
			$(this).parents('td.favorite').find('span.icon').remove();
			//$(this).remove('★');
		}
		// var _keyboardBase = $('#keyboard-base');
		// _keyboardBase.attr('class','');
		// _keyboardBase.addClass(_val);
		// window.localStorage.setItem("keyboardType",_val);
		// teblesorterOn();
	});
});

//ページロード時にチェックボックスの値を呼び出し、チェックを入れる
$(document).ready(function() {
	$('td.favorite').each(function() {
		var _id = $( this ).parents('tr').attr('id');
		// console.log('_id=' + _id);
		var getItem = window.localStorage.getItem('UKC-'+_id);
		// console.log('getItem=' + getItem);
		if (getItem == 'true'){
			console.log('_id=' + _id + ' is true');
			$(this).find('input:checkbox').attr("checked", true);
			$(this).find('label').append('★');
		}
	});
});


/* ===============================================
# tablesorter Setting
=============================================== */
function teblesorterOn () {
	$("#contentMain table").tablesorter({
		sortList: [[5, 1]]
	});
} 
$(function () {

	//localStorage読み込み：ソート設定
	var getItem = window.localStorage.getItem('UKC-sortOrder');
	var sortListSetting;
	if (getItem == 'recommend') {
		sortListSetting = [[4, 1]];
	} else if(getItem == 'favorite') {
		sortListSetting = [[5, 1]];
	} else {
		sortListSetting = '';
	}

	$("#contentMain table").tablesorter({
		sortList: sortListSetting,
		// sortInitialOrder: "desc", //クリックを降順に限定するオプション（一旦不要）

		//4（Reccomend）と5（Favorite）は降順しかさせないようにする
		headers : {
			4 : { lockedOrder: 'asc' },
			5 : { lockedOrder: 'asc' }
		}
	});
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
		window.localStorage.setItem('UKC-tabSelect',_val);
	});
});
$(document).ready(function() {
	var getItem = window.localStorage.getItem('UKC-tabSelect');
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

/* ===============================================
# Header Class Control：
ソートをロックしたヘッダーに何故か'headerSortUp'のクラスが付かないので、'headerSorted'を付け替えて別途指定
=============================================== */
$(function () {
	$('th.header').click(function(e) {
		$('.header-favorite').removeClass('headerSorted');
		$('.header-recommend').removeClass('headerSorted');
		if ($(this).hasClass('header-recommend')) {
			$(this).addClass('headerSorted');
			window.localStorage.setItem("UKC-sortOrder","recommend");
		} else if ($(this).hasClass('header-favorite')) {
			$(this).addClass('headerSorted');
			window.localStorage.setItem("UKC-sortOrder","favorite");
		} else {
			window.localStorage.setItem("UKC-sortOrder","");
		}
		e.preventDefault();
	});
});