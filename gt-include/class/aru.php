<?php
class aru
{
	
	public function get_list($table, $id_name)
    {
	    $db = new database();
		$sql = "select * from $table order by $id_name desc";
		$res = $db->get_select_query($sql);
		if(count($res)>0){
			return $res;
		}else{
			return null;
		}
	}

	public function list_by_type($table, $column, $val, $type, $order)
    {
		$db = new database();
	    if($type == "int"){
			$sql = "select * from $table where $column = $val order by $order desc";
		}else if($type == "string"){
			$sql = "select * from $table where $column = '$val' order by $order desc";
		}
		$res = $db->get_select_query($sql);
		if(count($res)>0){
			return $res;
		}else{
			return null;
		}
	}

	public function field_by_type($table, $field, $column, $value, $type)
    {
        $db = new database();
		if($type == "int"){
			$sql = "select $field from $table where $column = $value";
		}else if($type == "string"){	
			$sql = "select $field from $table where $column = '$value'";
		}
		$res = $db->get_var_query($sql);
		if($res){
			return $res;
		}else{
			return null;
		}
	}

	public function remove($table, $column, $value, $type)
    {
        $db = new database();
		if($type == "int"){
			$sql = "delete from $table where $column = $value";
		}else if($type == "string"){
			$sql = "delete from $table where $column = '$value'";
		}
		$db->ex_query($sql);
		echo "<meta http-equiv='refresh' content='0'/>";
		?><br>
		<div class="alert alert-success">مورد با موفقیت حذف شد</div>
		<script type="text/javascript">
			window.location.reload();
			return;
		</script>
	<?php
	}

	public function add($table, $array)
    {
        $prime = new prime();
        $db = new database();
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
                $sql_value .= $prime->eng_number($value);
            }else{
                $sql_value .= "'" . $prime->eng_number($value) . "'";
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
		$last_id = $db->ex_query($sql);
		return $last_id;
	}

	public function update($table, $array, $wfield, $wvalue)
    {
        $prime = new prime();
        $db = new database();
		$edit_btn = "update-" . $table;
		$sql = "update $table set";
        $sql_str = "";
        unset($array[$edit_btn]);
		$c = count($array);
		$i = 1;
		foreach($array as $key => $value){
            if(is_numeric($value)){
                $f_value = $prime->eng_number($value);
            }else{
                $f_value = "'" . $prime->eng_number($value) . "'";
            }
            
            $sql_str .= " " . $key . " = " . $f_value;
            
            if($i != $c){
                $sql_str .= ", ";
            }
			$i++;
		}
		$sql_str .= " where $wfield = $wvalue";
		$sql .= $sql_str;
		$db->ex_query($sql);
		?>
		<br>
		<div class="alert alert-success">
			مورد با موفقیت ویرایش شد
		</div>
		<script type="text/javascript">
			window.location.reload();
			return;
		</script>
		<?php
	}

	public function field_for_edit($table, $field, $column, $value){
		$out = $this->field_by_type($table, $field, $column, $value, "int");
		return $out;
	}
	
}