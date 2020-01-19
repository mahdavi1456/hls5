<?php
session_start();
require_once ("../class/database.php");
require_once ("../class/product.php");
require_once ("../class/person.php");
require_once ("../class/factor.php");
require_once ("../class/prime.php");

if(isset($_POST['search_person'])) {
	$db = new database();
	$pr = new prime();
    
	$p_family = $_POST['p_family'];
	$sql = "select p_id, p_name, p_family, p_mobile from person where p_family like '%" . $p_family . "%' order by p_id desc";
	$res = $db->get_select_query($sql);
	if(count($res) > 0) { ?>
		<p class="hide-person-item"><b>بستن پیشنهادات</b></p>
		<?php
		foreach($res as $row) {
			?>
			<p class="person-item" data-p_id="<?php echo $row['p_id']; ?>" data-p_fullname="<?php echo $row['p_name'] . ' ' . $row['p_family']; ?>"><?php echo $row['p_name'] . " " . $row['p_family'] . " - " . $pr->per_number($row['p_mobile']); ?></p>
			<?php
		}
	}
	exit();
}

if(isset($_POST['load_person_extra_form'])) {
    $p_id = $_POST['p_id'];
    ?>
    <form action="" method="post">
        <?php
        $person = new person();
        $person->create_person_extra_form($p_id);
        ?>
    </form>
    <?php
    exit();
}

if(isset($_POST['load_person_edit_form'])) {
	$p_id = $_POST['p_id'];
	?>
	<form action="" method="post">
		<?php
		$person = new person();
		$person->create_person_edit_form($p_id);
		?>
	</form>
	<?php
	exit();
}

if(isset($_POST['get_package_info'])){
	$db = new database();
	$pk_id = $_POST['pk_id'];
	$res = $db->get_select_query("select * from package where pk_id = $pk_id");
	$pk_time = $res[0]['pk_time'];
	$pk_expire = $res[0]['pk_expire'];
	$pk_price = $res[0]['pk_price'];
	echo $pk_time . "," . $pk_expire . "," . $pk_price;
	exit();
}