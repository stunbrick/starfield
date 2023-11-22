<?php

class Star {
	public $x;
	public $y;
	private $speed_x;
	private $speed_y;
	private $border;

	public function move(){
		$this->x += $this->speed_x;
		$this->y += $this->speed_y;
		if ($this->x > $this->border
			|| $this->y > $this->border
			|| $this->x < -$this->border
			|| $this->y < -$this->border){
			$this->x = 0;
			$this->y = 0;
		}
	}

	public function should_print($x, $y) {
		if ((int) $this->x == $x
			&& (int) $this->y == $y
		) {
			return true;
		}
		return false;
	}

	public function __construct($speed_x, $speed_y){
		$this->x = 0;
		$this->y = 0;
		$this->speed_x = $speed_x;
		$this->speed_y = $speed_y;
		$this->border = 30;
	}
}


sleep(1);

$stars = [];
for ($i = 0; $i <= 10; $i++) {
	$stars[] = new Star(rand(-30, 30) / 10, rand(-30, 30) / 10);
}
echo "\033[2J\033[;H";
$output = "";
$q = 0;
$lim = 1000;
$size = 30;
while ($q <= $lim) {
	foreach ($stars as $star) {
		$star->move();
	}
	$output = "";
	$q++;
	for ($y = $size; $y >= - $size; $y--) {
		for ($x = - $size; $x <= $size; $x++) {
			$current_char = ' ';
			foreach ($stars as $star) {
				if ($star->should_print($x, $y)){
					$current_char = '*';
				}
			}
			$output .= $current_char;
		} 
		$output .= "\n";
	}
	system("clear");
	print $output;
	usleep(250000);
}
