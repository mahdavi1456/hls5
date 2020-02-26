<?php

	if(isset($_POST['load_factor'])){
			$pr_id = $_POST['pr_id'];
			$f_count = $_POST['f_count'];
			if($pr_id != "" && $f_count != ""){
				$pr_sale = $db->get_var_query("select pr_sale from product where pr_id = $pr_id");
				$total = $pr_sale * $f_count;
				echo $total;
			}
			else 
				echo "";
		}
