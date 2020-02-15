<?php

class price
{

    public function round_price($num)
    {
		$num_new = $num % 100;
		if($num_new < 50) {
			$num = $num - $num_new;
		}
		else {
			$num_new = 100 - $num_new;
			$num = $num + $num_new;
			
		}
		return $num;
		/*
        $p = $num % 100;
        return $num - $p;*/
    }

    public function baloon_round($time)
    {
		if($time == 0) {
			return 0;
		} else if($time >= 0 && $time <= 15) {
			return 0;
		} else if ($time >= 16 && $time <= 60) {
            return 75000;
        } else if ($time >= 61 && $time <= 70) {
            return 75000;
        } else if ($time >= 71 && $time <= 100) {
            return 95000;
        } else if ($time >= 101 && $time <= 130) {
            return 120000;
        } else if ($time >= 131 && $time <= 160) {
            return 150000;
        } else if ($time >= 161 && $time <= 190) {
            return 180000;
        } else if ($time >= 191 && $time <= 220) {
            return 210000;
        } else if ($time >= 221 && $time <= 250) {
            return 240000;
        } else if ($time >= 251 && $time <= 280) {
            return 270000;
        } else if ($time >= 281 && $time <= 310) {
            return 300000;
        } else if ($time >= 311 && $time <= 340) {
            return 330000;
        } else if ($time >= 341 && $time <= 370) {
            return 360000;
        } else if ($time >= 371 && $time <= 400) {
            return 390000;
        } else if ($time >= 401 && $time <= 430) {
            return 420000;
        } else if ($time >= 431 && $time <= 460) {
            return 450000;
        } else if ($time >= 461 && $time <= 490) {
            return 480000;
        } else if ($time >= 491 && $time <= 520) {
            return 510000;
        } else if ($time >= 521 && $time <= 550) {
            return 540000;
        } else if ($time >= 551 && $time <= 580) {
            return 570000;
        } else if ($time >= 581 && $time <= 610) {
            return 600000;
        } else if ($time >= 611 && $time <= 640) {
            return 630000;
        } else if ($time >= 641 && $time <= 670) {
            return 660000;
        } else if ($time >= 671 && $time <= 700) {
            return 690000;
        } else if ($time >= 701 && $time <= 730) {
            return 720000;
        } else if ($time >= 731 && $time <= 760) {
            return 750000;
        }
    }

    public function vip_baloon_round($time)
    {
        if($time == 0) {
			return 0;
		} else if ($time > 0 && $time <= 70) {
            return 125000;
        } else if ($time >= 71 && $time <= 100) {
            return 170000;
        } else if ($time >= 101 && $time <= 130) {
            return 220000;
        } else if ($time >= 131 && $time <= 160) {
            return 275000;
        } else if ($time >= 161 && $time <= 190) {
            return 330000;
        } else if ($time >= 191 && $time <= 220) {
            return 355000;
        } else if ($time >= 221 && $time <= 250) {
            return 380000;	
        }
    }

    function quarter_round($time)
    {
		if($time == 0) {
			return 0;
		} else if ($time > 0 && $time <= 15) {
            return 15;
        } else if ($time >= 16 && $time <= 30) {
            return 30;
        } else if ($time >= 31 && $time <= 45) {
            return 45;
        } else if ($time >= 46 && $time <= 60) {
            return 60;
        } else if ($time >= 61 && $time <= 75) {
            return 75;
        } else if ($time >= 75 && $time <= 90) {
            return 90;
        } else if ($time >= 91 && $time <= 105) {
            return 105;
        } else if ($time >= 105 && $time <= 120) {
            return 120;
        } else if ($time >= 121 && $time <= 135) {
            return 135;
        } else if ($time >= 136 && $time <= 150) {
            return 150;
        } else if ($time >= 151 && $time <= 165) {
            return 165;
        } else if ($time >= 166 && $time <= 180) {
            return 180;
        } else if ($time >= 181 && $time <= 195) {
            return 195;
        } else if ($time >= 196 && $time <= 210) {
            return 210;
        } else if ($time >= 211 && $time <= 225) {
            return 225;
        } else if ($time >= 226 && $time <= 240) {
            return 240;
        } else if ($time >= 241 && $time <= 255) {
            return 255;
        } else if ($time >= 256 && $time <= 270) {
            return 270;
        } else if ($time >= 271 && $time <= 285) {
            return 285;
        } else if ($time >= 286 && $time <= 300) {
            return 300;
        } else if ($time >= 301 && $time <= 315) {
            return 315;
        } else if ($time >= 316 && $time <= 330) {
            return 330;
        } else if ($time >= 331 && $time <= 345) {
            return 345;
        } else if ($time >= 346 && $time <= 360) {
            return 360;
        } else if ($time >= 361 && $time <= 375) {
            return 375;
        } else if ($time >= 376 && $time <= 390) {
            return 390;
        } else if ($time >= 391 && $time <= 405) {
            return 405;
        }
    }
	
	function chiko_round($time)
    {
		$opt = new option();

        if($total < 60) {
            $base_price = $opt->get_option('price_down_60');
        } else {
            $base_price = $opt->get_option('price_up_60');
        }
		
		if($time == 0) {
			return 0;
		}
		else if ($time > 0 && $time <= 30) {
            return 8000;
        }
		else if ($time >= 31 && $time <= 60) {
            return 14000;
        }
		else if($time >= 61 && $time <= 90) {
			return 22000;
		}
		else if($time >= 91 && $time <= 120) {
			return 28000;
		}
		else if($time >= 121 && $time <= 150) {
			return 36000;
		}
		else if($time >= 151 && $time <= 180) {
			return 42000;
		}
		else if($time >= 181 && $time <= 210) {
			return 50000;
		}
		else if($time >= 211 && $time <= 240) {
			return 56000;
		}
		else if($time >= 241 && $time <= 270) {
			return 64000;
		}
		else if($time >= 271 && $time <= 300) {
			return 70000;
		}
    }

    public function calc_normal_price($total)
    {
        $opt = new option();

        if($total < 60) {
            $base_price = $opt->get_option('price_down_60');
        } else {
            $base_price = $opt->get_option('price_up_60');
        }

        $round_type = $opt->get_option('round_type');
        if ($round_type == 'baloon') {
        
			$normal_price = $this->baloon_round($total);
        
		} else if ($round_type == 'quarter') {
            
			$normal_price = ($this->quarter_round($total) / 60) * $base_price;
        
		} else if($round_type == 'chiko'){
			
			$normal_price = $this->chiko_round($total);
			
		} else {
            $a = $base_price / 60;
			$b = $a * $total;
			$normal_price = $this->round_price($b);
        
		}
        return $normal_price;
    }

    public function calc_vip_price($total_vip)
    {
        $opt = new option();

        if($total_vip < 60) {
            $base_price = $opt->get_option('vip_price_down_60');
        } else {
            $base_price = $opt->get_option('vip_price_up_60');
        }

        $round_type = $opt->get_option('round_type');
        if ($round_type == 'baloon') {
            $vip_price = $this->vip_baloon_round($total_vip);
		} else if ($round_type == 'quarter') {
            $vip_price = ($this->quarter_round($total_vip) / 60) * $base_price;
		} else {
            $vip_price = ($this->round_price($total_vip) / 60) * $base_price;
			
		}
        return $vip_price;
    }
	
	public function calc_login_price($total_time)
	{
		$opt = new option();
		
		$login_deadline = $opt->get_option('login_deadline');
        $login_price = $opt->get_option('login_price');
        if (($total_time) <= $login_deadline) {
            return $login_price;
        } else {
			return 0;
		}
	}

}