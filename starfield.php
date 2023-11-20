<?php


sleep(1);
echo "\033[2J\033[;H";
$output = "";
$star1 = 0;
$star2 = 5;
$q = 0;
$lim = 100;
$size = 30;
while ($q <= $lim) {
	$output = "";
	$q++;
	$star1 += 1;
	$star2 += 1;
	if ($star1 >= $size) {
		$star1 = 0;
	}
	if ($star2 >= $size) {
		$star2 = 0;
	}
	for ($y = $size; $y >= - $size; $y--) {
		for ($x = - $size; $x <= $size; $x++) {
			if (($y == $x && $star1 == $y) 
			|| ($y == -$x && $star1 == $y) 
			|| ($y == -$x && $star1 == -$y) 
			|| ($y == $x && $star1 == -$y) 

			|| ($y == $x && $star2 == $y)
			|| ($y == -$x && $star2 == $y) 
			|| ($y == -$x && $star2 == -$y) 
			|| ($y == $x && $star2 == -$y) 

			|| ($y == 0 && $star1 == $x) 
			|| ($y == 0 && $star1 == -$x) 

			|| ($x == 0 && $star1 == $y) 
			|| ($x == 0 && $star1 == -$y) 

			|| ($y == 0 && $star2 == $x) 
			|| ($y == 0 && $star2 == -$x) 

			|| ($x == 0 && $star2 == $y) 
			|| ($x == 0 && $star2 == -$y) 
			){
					$output .= '*';
			} else {
				$output .= ' ';
			}
		} 
		$output .= "\n";
	}
	system("clear");
	print $output;
	usleep(250000);
}
