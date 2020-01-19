<?php
class aru{
	
	public function get_list($table, $id_name){
		$sql = "select * from $table order by $id_name desc";
		$res = get_select_query($sql);
		if(count($res)>0){
			return $res;
		}else{
			return null;
		}
	}

	public function list_by_type($table, $column, $val, $type, $order){
		if($type == "int"){
			$sql = "select * from $table where $column = $val order by $order desc";
		}else if($type == "string"){
			$sql = "select * from $table where $column = '$val' order by $order desc";
		}
		$res = get_select_query($sql);
		if(count($res)>0){
			return $res;
			}else{
			return null;
		}
	}

	public function field_by_type($table, $field, $column, $value, $type){
		if($type == "int"){
			$sql = "select $field from $table where $column = $value";
		}else if($type == "string"){	
			$sql = "select $field from $table where $column = '$value'";
		}
		$res = get_var_query($sql);
		if($res != null){
			return $res;
		}else{
			return null;
		}
	}

	public function remove($table, $column, $value, $type, $refresh=1){
		if($type == "int"){
			$sql = "delete from $table where $column = $value";
		}else if($type == "string"){
			$sql = "delete from $table where $column = '$value'";
		}
		$last_id = ex_query($sql);
		
		if($refresh){
			//$home_dir = get_the_url();
			//echo "<div class='alert-aru col-xs-12'><div class='alert alert-success col-xs-6'><img src='$home_dir/dist/img/check4.gif'> مورد با موفقیت حذف شد</div></div>";
			echo '<meta http-equiv="refresh" content="2"/>';
			//echo '<script type="text/javascript">setTimeout(function(){ window.location.reload(); return; }, 2000);</script>';
		}else{
			return $last_id;
		}
	}

	public function add($table, $array, $refresh = 1){
		$confirm_btn = "add-" . $table;
		$sql = "insert into $table ";
		$sql_key = " (";
        $sql_value = " values(";
        unset($array[$confirm_btn]);
		$c = count($array);
        $i = 1;
		foreach($array as $key => $value){
            $sql_key .= $key;
            
            if(is_numeric($value)){
                $sql_value .= eng_number($value);
            }else{
                $sql_value .= "'" . eng_number($value) . "'";
            }
        
            if($i != $c){
                $sql_key .= ", ";
                $sql_value .= ", ";
            }
			$i++;
		}
		$sql_key .= ")";
		$sql_value .= ")";
		$sql .= $sql_key . $sql_value;
		$last_id = ex_query($sql);
		if($refresh){
			$home_dir = get_the_url();
			echo "<div class='alert-aru col-xs-12'><div class='alert alert-success col-xs-6'><img src='$home_dir/dist/img/check4.gif'>مورد با موفقیت ثبت شد</div></div>";
			echo '<meta http-equiv="refresh" content="2"/>';
			echo '<script type="text/javascript">setTimeout(function(){ window.location.reload(); return; }, 2000);</script>';
		}else{
			return $last_id;
		}
	}
	
	public function add_if_not_exists($table, $array, $column, $value, $type, $orderby, $refresh=1){
		if($type == "int"){
			$exists_sql = "select count($orderby) from $table where $column = $value";
		}else if($type == "string"){
			$exists_sql = "select count($orderby) from $table where $column = '$value'";
		}
		$exists_sql = "select count($orderby) from $table where $column = '$value'";
		$exists = get_var_query($exists_sql);
		
		if($exists){
			if($refresh){
				$home_dir = get_the_url();
				echo "<div class='alert-aru col-xs-12'><div class='alert alert-danger col-xs-6'>این مورد موجود می باشد</div></div>";
				echo '<meta http-equiv="refresh" content="2"/>';
				//echo '<script type="text/javascript">setTimeout(function(){ window.location.reload(); return; }, 2000);</script>';
			}else{
				return 0;
			}
		}else{
			$confirm_btn = "add-" . $table;
			$sql = "insert into $table ";
			$sql_key = " (";
			$sql_value = " values(";
			unset($array[$confirm_btn]);
			$c = count($array);
			$i = 1;
			foreach($array as $key => $value){
				$sql_key .= $key;
				
				if(is_numeric($value)){
					$sql_value .= eng_number($value);
				}else{
					$sql_value .= "'" . eng_number($value) . "'";
				}
			
				if($i != $c){
					$sql_key .= ", ";
					$sql_value .= ", ";
				}
				$i++;
			}
			$sql_key .= ")";
			$sql_value .= ")";
			$sql .= $sql_key . $sql_value;
			$last_id = ex_query($sql);
			if($refresh){
				$home_dir = get_the_url();
				echo "<div class='alert-aru col-xs-12'><div class='alert alert-success col-xs-6'><img src='$home_dir/dist/img/check4.gif'>مورد با موفقیت ثبت شد</div></div>";
				echo '<meta http-equiv="refresh" content="2"/>';
				//echo '<script type="text/javascript">setTimeout(function(){ window.location.reload(); return; }, 2000);</script>';
			}else{
				return $last_id;
			}
		}
	}

	public function update($table, $array, $wfield, $wvalue, $refresh=1){
		$edit_btn = "update-" . $table;
		$sql = "update $table set";
        $sql_str = "";
        unset($array[$edit_btn]);
		$c = count($array);
		$i = 1;
		foreach($array as $key => $value){
            if(is_numeric($value)){
                $f_value = eng_number($value);
            }else{
                $f_value = "'" . eng_number($value) . "'";
            }
            
            $sql_str .= " " . $key . " = " . $f_value;
            
            if($i != $c){
                $sql_str .= ", ";
            }
			$i++;
		}
		$sql_str .= " where $wfield = $wvalue";
		$sql .= $sql_str;
		
		$last_id = ex_query($sql);
		
		if($refresh){
			$home_dir = get_the_url();
			echo "<div class='alert-aru col-xs-12'><div class='alert alert-success col-xs-6'><img src='$home_dir/dist/img/check4.gif'> مورد با موفقیت ویرایش شد</div></div>";
			echo '<meta http-equiv="refresh" content="2"/>';
			//echo '<script type="text/javascript">setTimeout(function(){ window.location.reload(); return; }, 2000);</script>';
		}else{
			return $last_id;
		}
	}

	public function field_for_edit($table, $field, $column, $value){
		$out = $this->field_by_type($table, $field, $column, $value, "int");
		return $out;
	}
	
}