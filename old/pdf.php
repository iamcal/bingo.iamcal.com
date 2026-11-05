<?php
	#
	# $Id$
	#

	include('fpdf.php');


	$doc = array(
		'debug_rects' => 0,
	);

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
	);


	shuffle($words);
	shuffle($words);

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->SetDisplayMode('fullpage');
	$pdf->AddPage();
	$pdf->SetAutoPageBreak(0);


	size_grid(10, 10, 277, 190);
	draw_pixels();
	draw_grid();


	$pdf->SetTextColor(0);

	$pdf->SetFont('Arial', 'B', 18);
	$pdf->SetXY(0, 0);
	$pdf->Cell(0, 10, "Buzzword Bingo", 0, 0, 'C');

	$pdf->SetFont('Arial', 'B', 12);
	$pdf->SetXY(0, 200);
	$pdf->Cell(0, 10, "A Cal Henderson / Etech 06 Product", 0, 0, 'C');


	$pdf->Output();
	exit;

	##################################################################################33

	function size_grid($x, $y, $w, $h){

		global $pdf, $grid, $doc;

		$sx = $w / $grid;
		$sy = $h / $grid;

		$doc['u'] = min($sx, $sy);

		$doc['w'] = $grid * $doc['u'];
		$doc['h'] = $grid * $doc['u'];

		$doc['x'] = $x + ($w/2) - ($doc['w']/2);
		$doc['y'] = $y + ($h/2) - ($doc['h']/2);

		if ($doc['debug_rects']){
			$pdf->SetFillColor(220);
			$pdf->Rect($x, $y, $w, $h, 'F');
		}
	}

	function draw_grid(){

		global $pdf, $grid, $doc;

		#
		# inner lines
		#

		for ($layer=1; $layer<=2; $layer++){

			#
			# verticals
			#

			for ($i=1; $i<$grid; $i++){

				$j = $doc['x'] + ($doc['u'] * $i);

				if ($i % 10 == 0){
					if ($layer == 2){
						$pdf->SetDrawColor(150);
						$pdf->Line($j, $doc['y'], $j, $doc['y']+$doc['h']);
					}
				}else{
					if ($layer == 1){
						$pdf->SetDrawColor(200);
						$pdf->Line($j, $doc['y'], $j, $doc['y']+$doc['h']);
					}
				}
			}


			#
			# horizontals
			#

			for ($i=1; $i<$grid; $i++){

				$j = $doc['y'] + ($doc['u'] * $i);

				if ($i % 10 == 0){
					if ($layer == 2){
						$pdf->SetDrawColor(150);
						$pdf->Line($doc['x'], $j, $doc['x']+$doc['w'], $j);
					}
				}else{
					if ($layer == 1){
						$pdf->SetDrawColor(200);
						$pdf->Line($doc['x'], $j, $doc['x']+$doc['w'], $j);
					}
				}
			}
		}

		#
		# outer border
		#

		$pdf->SetDrawColor(0);

		$pdf->Rect($doc['x'], $doc['y'], $doc['w'], $doc['h']);
	}

	function draw_pixels(){

		global $pdf, $doc, $grid, $words;

		$pdf->SetFont('Arial', 'B', 14);

		for ($x=0; $x<$grid; $x++){
			for ($y=0; $y<$grid; $y++){

				$px = $doc['x'] + ($x * $doc['u']);
				$py = $doc['y'] + ($y * $doc['u']);

				$h4 = $doc['u']/4;

				$pdf->SetTextColor(0);
				$pdf->SetXY($px, $py+$h4);

				$word = array_pop($words);

				$h = $doc['u'] / 2;
				if (preg_match("!\n!", $word)){
					$h /= 2;
				}

				$pdf->MultiCell($doc['u'], $h, $word, 0, 'C');

			}
		}
	}

?>