<?php

class Star {
	private $x;
	private $y;
	private $start_speed_x;
	private $start_speed_y;
	private $speed_x;
	private $speed_y;
	private $border;
	private $small_symbol;
	private $medium_symbol;
	private $big_symbol;
	private $acceleration;

	public function __construct($start_speed_x, $start_speed_y, $small_symbol, $medium_symbol, $big_symbol){
		$this->x = 0;
		$this->y = 0;
		$this->start_speed_x = $start_speed_x;
		$this->start_speed_y = $start_speed_y;
		$this->speed_x = $start_speed_x;
		$this->speed_y = $start_speed_y;
		$this->border = 30;
		$this->small_symbol = $small_symbol;
		$this->medium_symbol = $medium_symbol;
		$this->big_symbol = $big_symbol;
		$this->acceleration = 1.2;
		$this->move();
		$this->move();
		$this->move();
	}

	public function move(){
		$this->x += $this->speed_x;
		$this->y += $this->speed_y;
		$this->speed_x *= $this->acceleration;
		$this->speed_y *= $this->acceleration;
		if ( $this->x > $this->border
		|| $this->x < -$this->border
		|| $this->y > $this->border / 2
		|| $this->y < -$this->border / 2) {
			$this->speed_x *= $this->acceleration;
			$this->speed_y *= $this->acceleration;
		}
		if ($this->x > $this->border * 2
		|| $this->y > $this->border
		|| $this->x < -$this->border * 2
		|| $this->y < -$this->border) {
			$this->x = 0;
			$this->y = 0;
			$this->speed_x = $this->start_speed_x;
			$this->speed_y = $this->start_speed_y;
			$this->move();
			$this->move();
			$this->move();
		}
	}

	public function should_print($x, $y) {
		if ( round($this->x) == $x
		&& round($this->y) == $y) {
			return true;
		}
		return false;
	}

	public function get_symbol() {
		if ( $this->x > $this->border
		|| $this->x < -$this->border
		|| $this->y > $this->border / 2
		|| $this->y < -$this->border / 2) {
			return $this->big_symbol;
		}
		if ( $this->x > $this->border / 2
		|| $this->x < -$this->border / 2
		|| $this->y > $this->border / 4
		|| $this->y < -$this->border / 4) {
			return $this->medium_symbol;
		}
		return $this->small_symbol;
	}
}


sleep(1);

$stars = [];

for ($i = 0; $i <= 15; $i++) {
	$init_x = rand(-10, 10) / 20;
	$init_y = rand(-10, 10) / 20;
	if (rand(0, 1) == 1) {
		$new_star = new Star($init_x, $init_y, "\e[33m" . '.' . "\e[0m", "\e[33m" . '*' . "\e[0m", "\e[33m" . '@' . "\e[0m");
	}
	else {
		$new_star = new Star($init_x, $init_y, "\e[35m" . '.' . "\e[0m", "\e[35m" . 'o' . "\e[0m", "\e[35m" . '0' . "\e[0m");
	}
	$stars[] = $new_star;
}

for ($i = 0; $i <= 5; $i++) {
	$init_x = rand(-10, 10) / 10;
	$init_y = rand(-10, 10) / 10;
		$new_star = new Star($init_x, $init_y, "\e[36m" . ',' . "\e[0m", "\e[36m" . '+' . "\e[0m", "\e[36m" . '#' . "\e[0m");
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$stars[] = $new_star;
}

for ($i = 0; $i <= 5; $i++) {
	$init_x = rand(-10, 10) / 10;
	$init_y = rand(-10, 10) / 10;
	$stars[] = new Star($init_x, $init_y, '.', 'o', '0');
	$new_star = new Star($init_x, $init_y, '.', '*', '@');
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$new_star->move();
	$stars[] = $new_star;
}
echo "\033[2J\033[;H";
$output = "";
$lim = 1000;
$size = 30;
while (1 == 1) {
	foreach ($stars as $star) {
		$star->move();
	}
	$output = "";
	for ($y = $size; $y >= - $size; $y--) {
		$output .= "                                                      ";
		for ($x = -$size * 2; $x <= $size * 2; $x++) {
			$current_char = ' ';
			foreach ($stars as $star) {
				if ($star->should_print($x, $y)){
					$current_char = $star->get_symbol();
				}
			}
			$output .= $current_char;
		} 
		$output .= "\n";
	}
	system("clear");
	print $output;
	usleep(500000);
}
