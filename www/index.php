<?
	#
	# $Id$
	#

	$grid = 5;

	$words = array(
		'web 2.0',
		'identity 2.0',
		'clickstream',
		'securitize',
		'scra-P-I',
		'monetize',
		'leverage',
		"core\ncompetencies",
		"attention\nstream",
		'tags',
		'attenuation',
		'attention',
		'new economy',
		'remix',
		'API',
		'WS-*',
		'mashup',
		'Make culture',
		'Yahoo!',
		'Acquisition',
		'myware',
		'everyware',
		'spime',
		'blogject',
		'AJAX',
		'podcast',
		'theory object',
		"the flickr\nof *",
		'untethered',
		'dick hardt',
		'long tail',
		'network effect',
		"collective\nintelligence",
		'windows live',
		'paradigm',
		'ubiquitous *',
		"premature\noptimization",
		'blogosphere',
		'thing link',
		'microformats',
		'Cory Dotorow',
		'Second Life',
		'hackability',
		'platform',
		'ecology',
		"deep\ntechnologists",
		'aggregate',
		"economies\nof scale",
		"value",
		"stream",
		"metadata",
		'DOM',
		'ecosystem',
		'portal',
		'tag cloud',
		'80 / 20',
		'power laws',
		'mental model',
	);

	shuffle($words);
	shuffle($words);
?>
<html>
<head>
<title>Buzzword Bingo</title>
<style>

body {
	text-align: center;
}

h1 {
	font-family: arial, helvetica, sans-serif;
	font-size: 20px;
	font-weight: bold;
}

td {
	font-family: arial, helvetica, sans-serif;
	font-size: 13px;
}

.container {
	position: relative;
}

h3 {
	font-family: arial, helvetica, sans-serif;
	font-size: 14px;
}

#main {

	position: relative;
	width: 452px;
	height: 452px;
	background-color: black;
	margin: 0px auto;
}

.cover {
	position: absolute;
	left: 0px;
	top: 0px;
	width: 88px;
	height: 88px;
	background-color: transparent;
	cursor: pointer;
	z-index: 10;
}

#bingo {
	position: absolute;
	left: 0px;
	top: 0px;
	width: 452px;
	height: 452px;
	background-color: transparent;
	display: none;
}

.hot {
	position: absolute;
	width: 88px;
	height: 88px;
	background-color: darkred;
}

.hot td {
	color: #ffffff;
	font-weight: bold;
}

.cold {
	position: absolute;
	width: 88px;
	height: 88px;
}

.cold td {
	background-color: white;
	color: #000000;
}

.bingo {
	background-color: #000000;
	font-size: 80px;
	font-weight: bold;
	padding: 20px;
	color: #ffffff;
}

</style>
<script language="Javascript">

var g_bingo_count;

function toggle(id){
	var elm = document.getElementById(id);
	elm.className = (elm.className == 'hot') ? 'cold' : 'hot';
	document.getElementById('bingo').style.display = 'none';

	// horizontal lines...

	for(var y=0; y<<?=$grid?>; y++){
		var fail = 0;
		for(var x=0; x<<?=$grid?>; x++){

			if (document.getElementById('cell'+x+y).className == 'cold'){

				fail = 1;
			}
		}
		if (!fail){
			bingo();
			return;
		}
	}

	// vertical lines...

	for(var x=0; x<<?=$grid?>; x++){
		var fail = 0;
		for(var y=0; y<<?=$grid?>; y++){

			if (document.getElementById('cell'+x+y).className == 'cold'){

				fail = 1;
			}
		}
		if (!fail){
			bingo();
			return;
		}
	}

	// diagonals lines...

	var fail = 0;

	for(var x=0; x<<?=$grid?>; x++){

		if (document.getElementById('cell'+x+x).className == 'cold'){

			fail = 1;
		}
	}
	if (!fail){
		bingo();
		return;
	}

	var fail = 0;

	for(var x=0; x<<?=$grid?>; x++){

		if (document.getElementById('cell'+x+(<?=($grid-1)?>-x)).className == 'cold'){

			fail = 1;
		}
	}
	if (!fail){
		bingo();
		return;
	}


	// four corners...

	var fail = 0;

	if (document.getElementById('cell'+<?=($grid-1)?>+<?=($grid-1)?>).className == 'cold'){ fail = 1; }
	if (document.getElementById('cell'+0+<?=($grid-1)?>).className == 'cold'){ fail = 1; }
	if (document.getElementById('cell'+<?=($grid-1)?>+0).className == 'cold'){ fail = 1; }
	if (document.getElementById('cell'+0+0).className == 'cold'){ fail = 1; }

	if (!fail){
		bingo();
		return;
	}

}

function bingo(){
	g_bingo_count = 0;
	g_bingo_timer = window.setInterval('bingo_tick()', 300);
	document.getElementById('bingo').style.display = 'block';
}

function bingo_tick(){
	g_bingo_count++;
	document.getElementById('bingo').style.display = (g_bingo_count % 2) ? 'none' : 'block';
	if (g_bingo_count == 10){
		window.clearInterval(g_bingo_timer);
	}
}

</script>
</head>
<body>

<h1>Buzzword Bingo</h1>

<div id="main">

<? for($y=0; $y<$grid; $y++){ ?>
<? for($x=0; $x<$grid; $x++){ ?>
	<div class="cold" style="left: <?=(2+($x*90))?>; top: <?=(2+($y*90))?>" id="cell<?=$x?><?=$y?>">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 88px; height: 88px;">
			<tr valign="middle"><td align="center"><?=array_pop($words)?></td></tr>
		</table>
	</div>
<? } ?>
<? } ?>
	<div id="bingo">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 452px; height: 452px;">
			<tr valign="middle"><td align="center"><span class="bingo">BINGO!</a></td></tr>
		</table>
	</div>
<? for($y=0; $y<$grid; $y++){ ?>
<? for($x=0; $x<$grid; $x++){ ?>
		<div class="cover" style="left: <?=(2+($x*90))?>; top: <?=(2+($y*90))?>" onclick="toggle('cell<?=$x?><?=$y?>')">&nbsp;</div>
<? } ?>
<? } ?>

</div>

<h3>A Cal Henderson / ETech 06 Product</h3>

</body>
</html>
