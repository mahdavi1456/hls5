<?php

class gdate
{
    public function timeDiff($time2, $time1)
    {
		if(strtotime($time2) != '0000-00-00') {
			$list2 = explode('-', $time2);
			$time2 = jalali_to_gregorian($list2[0], $list2[1], $list2[2], '-');
			$list1 = explode('-', $time1);
			$time1 = jalali_to_gregorian($list1[0], $list1[1], $list1[2], '-');
			$diff = strtotime($time2) - strtotime($time1);
			return ($diff / 3600) / 24;
		} else {
			return 0;
		}
    }

    public function add_to_datee($datee, $add)
    {
        $list2 = explode('/', $datee);
        $date2 = jalali_to_gregorian($list2[0], $list2[1], $list2[2], '-');
        return jdate('Y/m/d', strtotime($date2 . ' + ' . $add . ' days'));
    }

    public function convert_time($time)
    {
        $display_used_time_list = explode(".", $time);
        $c = count($display_used_time_list);
        if ($c == 2) {
            $h = round($display_used_time_list[0]);
            $m = round(($display_used_time_list[1] * 60) / 100);
            if ($m < 10) {
                $m = "0" . $m;
            }
            if ($h < 10) {
                $h = "0" . $h;
            }
            $display_used_time = $h . ":" . $m;
            return $display_used_time;
        } else {
            return $time;
        }
    }

    public function convert_minute($minute)
    {
        $prime = new prime();

        return $prime->per_number(round($minute / 60) . ":" . round($minute % 60));
        $h = floor($minute / 60) ? floor($minute / 60) . '' : '';
        $m = $minute % 60 ? $minute % 60 . '' : '';

        $mm = $h && $m ? $h . ':' . $m : $h . $m;

        if($minute < 60){
            if(is_a($minute, 'DateTime')) {
                return $prime->per_number("0") . " دقیقه";
            } else {
                return $prime->per_number($mm) . " دقیقه";
            }
        } else {
            return $prime->per_number($mm) . " ساعت";
        }
    }

    public function new_diff($startdate, $enddate)
    {
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = abs($endtimestamp - $starttimestamp) / 3600;
        return $difference;
    }

    public function new_convert_time($time)
    {
        return gmdate('H:i:s', floor($time * 3600));
    }

    public function convert_time_to_per($time)
    {
        $list = explode(':', $time);
        return ($list[0] * 60) + ($list[1]);
    }

    public function convert_per_to_min($per)
    {
        return $per * 60;
    }

    public function convert_min_to_hour($minute)
    {
        $prime = new prime();

        $hours = floor($minute / 60);
        $min = $minute - ($hours * 60);
        echo $prime->per_number($hours . ":" . $min);
    }
	
	public function get_name_month($month)
    {
        if($month == 1) {
			$name = "فروردین";
		}
		if($month == 2) {
			$name = "اردیبهشت";
		}
		if($month == 3) {
			$name = "خرداد";
		}
		if($month == 4) {
			$name = "تیر";
		}
		if($month == 5) {
			$name = "مرداد";
		}
		if($month == 6) {
			$name = "شهریور";
		}
		if($month == 7) {
			$name = "مهر";
		}
		if($month == 8) {
			$name = "آبان";
		}	
		if($month == 9) {
			$name = "آذر";
		}	
		if($month == 10) {
			$name = "دی";
		}	
		if($month == 11) {
			$name = "بهمن";
		}	
		if($month == 12) {
			$name = "اسفند";
		}
		return $name;
    }

}