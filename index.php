<?php
require_once('ini.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>U.K.C.[ver.1.0]</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="resources/css/style.css" rel="stylesheet" media="screen">
<link href="resources/css/keyboard.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">U.K.C.[ver.1.0]<!--  (Ultimate Keyboard Cheat-sheet) --></a>
		</div>


		<div class="collapse navbar-collapse">

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Keyboard Type <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><label>
							<input type="radio" name="keyboardType" id="optionsRadios1" value="keyboard-apple-sj-ten" checked>
							Apple with ten key(Shift-JIS)
							</label></a>
					</li>
					<li>
						<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios2" value="keyboard-apple-sj">
								Apple without ten key(Shift-JIS)
							</label></a>
					</li>
					<li>
						<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios3" value="keyboard-macbook-sj">
								Macbook(Shift-JIS)
							</label></a>
					</li>
					<li>
						<a href="#"><label>
							<input type="radio" name="keyboardType" id="optionsRadios4" value="keyboard-apple-us-ten">
							Apple with ten key(US)
							</label></a>
					</li>
					<li>
						<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios5" value="keyboard-apple-us">
								Apple without ten key(US)
							</label></a>
					</li>
					<li>
						<a href="#"><label>
								<input type="radio" name="keyboardType" id="optionsRadios6" value="keyboard-macbook-us">
								Macbook(US)
							</label></a>
					</li>

				</ul>
			</li>
			<!-- <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Display Type <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><label>
							<input type="radio" name="displayType" id="optionsRadios1" value="option1" checked>
							Window Fix
						</label></a>
					</li>
					<li>
						<a href="#"><label>
							<input type="radio" name="displayType" id="optionsRadios2" value="option2">
							Indivisual
						</label></a>
					</li>
				</ul>
			</li> -->
		</ul>

		</div><!--/.nav-collapse -->
	</div>
</div>



<?php
	$files = array();
	$ids = array();
	if ($dh = opendir($dataDir)) {
		while (($file = readdir($dh)) !== false) {
			//.から始まるファイル名でなければ
			if (substr($file,0,1) !== '.') {
				$files[] = $file;
				$ids[] = basename($file,'.tsv');
			}
		}
		closedir($dh);
	}

	for($m = 0; $m < count($files); $m++) {
		// echo ('<p class="btn btn-default">'.$files[$m].'</p>');
		// echo ('<p class="btn btn-default">'.$ids[$m].'</p>');
	}

?> 







<ul class="nav nav-tabs" id="navMain">
	<?php
		for($m = 0; $m < count($files); $m++) {
			echo ('<li><a href="#'.$ids[$m].'" data-toggle="tab">'.$ids[$m].'</a></li>');
		}
	?> 
</ul>


<table>




</table>
<!-- Tab panes -->
<div id="contentMain" class="tab-content">

<?php
	for($m = 0; $m < count($files); $m++) {
		$file = fopen($dataDir.$files[$m], 'r');

		echo ('<div class="tab-pane" id="'.$ids[$m].'">');
		echo ('<h2 class="tab-h">'.$ids[$m].'</h2>');
		echo ('
				<table class="ovTable table table-bordered table-hover tablesorter">
					<thead>
						<tr>
							<th>No.</th>
							<th>Category</th>
							<th>Command</th>
							<th>Keys</th>
							<th>Favorite</th>
						</tr>
					</thead>
					<tbody>
			');

		$cnt = 1;
		while($line = fgets($file, 1024)) {
			$data = explode("\t", $line);
			$num = (string) $cnt;
			$colCount = 0;
			//<tr>生成============
			echo ('<tr id="'.$ids[$m].'-tr'.$num.'" class="');
			//<tr>内のクラス：
			$class=explode(',',$data[2]);
			for($l = 0; $l < count($class); $l++) {
				echo ('key-'.$class[$l].' ');
			}
			echo ('">');
			//<td>生成============
			echo ('<td>'.$num.'</td>');
			for($i = 0, $j =0; $i < count($data); $i++, $j++) {
				if($attr[$j]['label'] === 'Keys') {
					echo ('<td>');
					$sample=explode(',',$data[$i]);
					for($k = 0; $k < count($sample); $k++) {

	//echo $sample[$k];

						if (strpos($sample[$k], 'hyphen') !== false){
							$sample[$k] = '-';
						}elseif (strpos($sample[$k], 'caret') !== false){
							$sample[$k] = '^';
						}elseif (strpos($sample[$k], 'backslash') !== false){
							$sample[$k] = '¥';
						}elseif (strpos($sample[$k], 'at') !== false){
							$sample[$k] = '@';
						}elseif (strpos($sample[$k], 'bra1') !== false){
							$sample[$k] = '[';
						}elseif (strpos($sample[$k], 'bra2') !== false){
							$sample[$k] = ']';
						}elseif (strpos($sample[$k], 'semicolon') !== false){
							$sample[$k] = ';';
						}elseif (strpos($sample[$k], 'colon') !== false){
							$sample[$k] = ':';
						}elseif (strpos($sample[$k], 'comma') !== false){
							$sample[$k] = ',';
						}elseif (strpos($sample[$k], 'period') !== false){
							$sample[$k] = '.';
						}elseif (strpos($sample[$k], 'slash') !== false){
							$sample[$k] = '/';
						}elseif (strpos($sample[$k], 'underScore') !== false){
							$sample[$k] = '_';
						}elseif (strpos($sample[$k], 'eisu') !== false){
							$sample[$k] = '英数';
						}elseif (strpos($sample[$k], 'kana') !== false){
							$sample[$k] = 'かな';
						}elseif (strpos($sample[$k], 'caps') !== false){
							$sample[$k] = 'caps lock';
						}elseif (strpos($sample[$k], 'curUp') !== false){
							$sample[$k] = '↑';
						}elseif (strpos($sample[$k], 'curRight') !== false){
							$sample[$k] = '→';
						}elseif (strpos($sample[$k], 'curDown') !== false){
							$sample[$k] = '↓';
						}elseif (strpos($sample[$k], 'curLeft') !== false){
							$sample[$k] = '←';
						}elseif (strpos($sample[$k], 'equalTen') !== false){
							$sample[$k] = '=';
						}elseif (strpos($sample[$k], 'astTen') !== false){
							$sample[$k] = '*';
						}elseif (strpos($sample[$k], 'plus') !== false){
							$sample[$k] = '+';
						}elseif (strpos($sample[$k], 'num0') !== false){
							$sample[$k] = '0';
						}elseif (strpos($sample[$k], 'num1') !== false){
							$sample[$k] = '1';
						}elseif (strpos($sample[$k], 'num2') !== false){
							$sample[$k] = '2';
						}elseif (strpos($sample[$k], 'num3') !== false){
							$sample[$k] = '3';
						}elseif (strpos($sample[$k], 'num4') !== false){
							$sample[$k] = '4';
						}elseif (strpos($sample[$k], 'num5') !== false){
							$sample[$k] = '5';
						}elseif (strpos($sample[$k], 'num6') !== false){
							$sample[$k] = '6';
						}elseif (strpos($sample[$k], 'num7') !== false){
							$sample[$k] = '7';
						}elseif (strpos($sample[$k], 'num8') !== false){
							$sample[$k] = '8';
						}elseif (strpos($sample[$k], 'num9') !== false){
							$sample[$k] = '9';
						}

						if (strpos($sample[$k], 'and') !== false){
							echo ('<button class="btn btn-default btn-and">→</button>');
						}elseif (strpos($sample[$k], 'or') !== false){
							echo ('<button class="btn btn-default btn-or">or</button>');
						}else {
							echo ('<button class="btn btn-default">'.$sample[$k].'</button>');
						}

					}
					echo ('</td>');
				}
				else {
					echo ('<td>'.$data[$i].'</td>');
				}
			}
			echo ('<td class="like"><label><input type="checkbox"></label></td>');
			echo ('</tr>');
			$cnt++;
		}
		fclose($file);

		echo ('
					</tbody>
				</table>
			</div>
			');

	}
?> 


</div>


<!-- 

<div id="footer">
	<div class="container">
	</div>
</div>
 -->


<div id="keyboard-wrap">
<div id="keyboard-base" class="keyboard-apple-sj-ten">
	<ul>
		<li class="mod-key" id="key-esc">esc</li>
		<li class="mod-key" id="key-f1">F1</li>
		<li class="mod-key" id="key-f2">F2</li>
		<li class="mod-key" id="key-f3">F3</li>
		<li class="mod-key" id="key-f4">F4</li>
		<li class="mod-key" id="key-f5">F5</li>
		<li class="mod-key" id="key-f6">F6</li>
		<li class="mod-key" id="key-f7">F7</li>
		<li class="mod-key" id="key-f8">F8</li>
		<li class="mod-key" id="key-f9">F9</li>
		<li class="mod-key" id="key-f10">F10</li>
		<li class="mod-key" id="key-f11">F11</li>
		<li class="mod-key" id="key-f12">F12</li>
		<li class="mod-key" id="key-eject">eject</li>

		<li class="mod-key" id="key-num1">1</li>
		<li class="mod-key" id="key-num2">2</li>
		<li class="mod-key" id="key-num3">3</li>
		<li class="mod-key" id="key-num4">4</li>
		<li class="mod-key" id="key-num5">5</li>
		<li class="mod-key" id="key-num6">6</li>
		<li class="mod-key" id="key-num7">7</li>
		<li class="mod-key" id="key-num8">8</li>
		<li class="mod-key" id="key-num9">9</li>
		<li class="mod-key" id="key-num0">0</li>
		<li class="mod-key" id="key-hyphen">-</li>
		<li class="mod-key" id="key-caret">^</li>
		<li class="mod-key" id="key-backslash">¥</li>
		<li class="mod-key" id="key-delete">delete</li>

		<li class="mod-key" id="key-tab">tab</li>
		<li class="mod-key" id="key-q">Q</li>
		<li class="mod-key" id="key-w">W</li>
		<li class="mod-key" id="key-e">E</li>
		<li class="mod-key" id="key-r">R</li>
		<li class="mod-key" id="key-t">T</li>
		<li class="mod-key" id="key-y">Y</li>
		<li class="mod-key" id="key-u">U</li>
		<li class="mod-key" id="key-i">I</li>
		<li class="mod-key" id="key-o">O</li>
		<li class="mod-key" id="key-p">P</li>
		<li class="mod-key" id="key-at">@</li>
		<li class="mod-key" id="key-bra1">[</li>
		<li class="mod-key" id="key-return">return</li>

		<li class="mod-key" id="key-ctrl">control</li>
		<li class="mod-key" id="key-a">A</li>
		<li class="mod-key" id="key-s">S</li>
		<li class="mod-key" id="key-d">D</li>
		<li class="mod-key" id="key-f">F</li>
		<li class="mod-key" id="key-g">G</li>
		<li class="mod-key" id="key-h">H</li>
		<li class="mod-key" id="key-j">J</li>
		<li class="mod-key" id="key-k">K</li>
		<li class="mod-key" id="key-l">L</li>
		<li class="mod-key" id="key-semicolon">;</li>
		<li class="mod-key" id="key-colon">:</li>
		<li class="mod-key" id="key-bra2">]</li>

		<li class="mod-key" id="key-shiftLeft">shift</li>
		<li class="mod-key" id="key-z">Z</li>
		<li class="mod-key" id="key-x">X</li>
		<li class="mod-key" id="key-c">C</li>
		<li class="mod-key" id="key-v">V</li>
		<li class="mod-key" id="key-b">B</li>
		<li class="mod-key" id="key-n">N</li>
		<li class="mod-key" id="key-m">M</li>
		<li class="mod-key" id="key-comma">,</li>
		<li class="mod-key" id="key-period">.</li>
		<li class="mod-key" id="key-slash">/</li>
		<li class="mod-key" id="key-underScore">_</li>
		<li class="mod-key" id="key-shiftRight">shift</li>

		<li class="mod-key" id="key-altLeft">alt/option</li>
		<li class="mod-key" id="key-cmdLeft">command</li>
		<li class="mod-key" id="key-eisu">英数</li>
		<li class="mod-key" id="key-space"></li>
		<li class="mod-key" id="key-kana">かな</li>
		<li class="mod-key" id="key-cmdRight">command</li>
		<li class="mod-key" id="key-altRight">alt/option</li>
		<li class="mod-key" id="key-caps">caps</li>

		<li class="mod-key" id="key-f13">F13</li>
		<li class="mod-key" id="key-f14">F14</li>
		<li class="mod-key" id="key-f15">F15</li>
		<li class="mod-key" id="key-f16">F16</li>
		<li class="mod-key" id="key-f17">F17</li>
		<li class="mod-key" id="key-f18">F18</li>
		<li class="mod-key" id="key-f19">F19</li>

		<li class="mod-key" id="key-fn">fn</li>
		<li class="mod-key" id="key-home">home</li>
		<li class="mod-key" id="key-pageUp">pageup</li>
		<li class="mod-key" id="key-deleteRight">delete</li>
		<li class="mod-key" id="key-end">end</li>
		<li class="mod-key" id="key-pageDown">pagedown</li>

		<li class="mod-key" id="key-curUp">▲</li>
		<li class="mod-key" id="key-curRight">▶</li>
		<li class="mod-key" id="key-curDown">▼</li>
		<li class="mod-key" id="key-curLeft">◀</li>

		<li class="mod-key" id="key-clear">clear</li>
		<li class="mod-key" id="key-equalTen">=</li>
		<li class="mod-key" id="key-slashTen">/</li>
		<li class="mod-key" id="key-astTen">*</li>
		<li class="mod-key" id="key-hyphenTen">-</li>
		<li class="mod-key" id="key-plusTen">+</li>
		<li class="mod-key" id="key-enter">enter</li>
		<li class="mod-key" id="key-num0ten">0</li>
		<li class="mod-key" id="key-num1ten">1</li>
		<li class="mod-key" id="key-num2ten">2</li>
		<li class="mod-key" id="key-num3ten">3</li>
		<li class="mod-key" id="key-num4ten">4</li>
		<li class="mod-key" id="key-num5ten">5</li>
		<li class="mod-key" id="key-num6ten">6</li>
		<li class="mod-key" id="key-num7ten">7</li>
		<li class="mod-key" id="key-num8ten">8</li>
		<li class="mod-key" id="key-num9ten">9</li>
		<li class="mod-key" id="key-commaTen">,</li>
		<li class="mod-key" id="key-periodTen">.</li>

		<li class="mod-key" id="key-tilde">~ / `</li>
		<li class="mod-key" id="key-hyphenUs">- / _</li>
		<li class="mod-key" id="key-plusUs">+ / =</li>
		<li class="mod-key" id="key-colonUs">: / ;</li>
		<li class="mod-key" id="key-quotation">" / '</li>
		<li class="mod-key" id="key-ctrlRight">control</li>

	</ul>


</div>
<!-- /#keyboard-wrap --></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="resources/js/jquery.tablesorter.js"></script>
<script src="resources/js/util.js"></script>
</body>
</html>