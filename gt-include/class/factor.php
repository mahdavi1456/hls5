<?php

class factor
{

    public function load_light_factor_regular($p_id) { ?>
        <table class="table table-bordered text-center">
            <tr>
                <th class="text-center" colspan="4">فاکتور فروشگاه</th>
            </tr>
            <tr>
                <th class="text-center">ردیف</th>
                <th class="text-center">نام کالا</th>
                <th class="text-center">قیمت</th>
                <th class="text-center">حذف</th>
            </tr>
            <?php
            $i = 1;
            $total = 0;
            $res = get_select_query("select * from factor where p_id = $p_id and f_status = 0");
            foreach($res as $row){
                $pr_name = get_name("product", "pr_name", "pr_id", $row['pr_id']); ?>
                <tr>
                    <td><?php echo per_number($i); ?></td>
                    <td><?php echo $pr_name; ?></td>
                    <td><?php echo per_number(number_format($row['pr_price'])); ?></td>
                    <td><button data-fid="<?php echo $row['f_id']; ?>" data-pid="<?php echo $row['p_id']; ?>" class="remove-from-factor-regular btn btn-danger btn-sm">حذف</button></td>
                </tr>
                <?php
                $total += $row['pr_price'];
                $i++;
            }
            ?>
            <tr>
                <th></th>
                <th style="text-align: center">جمع کل: </th><th style="text-align: center"><?php echo per_number(number_format($total)); ?></th>
                <th></th>
            </tr>
        </table>
        <?php
    }

    public function shop_factor($p_id, $remove = 1)
    {
        $db = new database();
        $pr = new prime();
        $pro = new product();

        $res1 = $db->get_select_query("select * from factor where p_id = $p_id and f_status = 0");
        $total = 0;
        if (count($res1) > 0) { ?>
            <table class="table text-center table-bordered koodak">
                <tr>
                    <th class="text-center" colspan="6">فاکتور فروشگاه</th>
                </tr>
                <tr>
                    <th class="text-center">ردیف</th>
                    <th class="text-center">نام کالا</th>
                    <th class="text-center">قیمت</th>
					<th class="text-center">تعداد</th>
                    <?php if ($remove == 1) { ?>
                        <th class="text-center">حذف</th><?php } ?>
                </tr>
                <?php
                $i = 1;
                $res = $db->get_select_query("select * from factor where p_id = $p_id and f_status = 0");
                foreach ($res as $row) {
                    $pr_name = $pro->get_product_name($row['pr_id']); ?>
                    <tr>
                        <td><?php echo $pr->per_number($i); ?></td>
                        <td><?php echo $pr_name; ?></td>
                        <td><?php echo $pr->per_number(number_format($row['pr_price'])); ?></td>
						<td>
							<?php if ($remove == 1) { ?>
								<select class="change-count" data-pid="<?php echo $row['p_id']; ?>" data-prid="<?php echo $row['pr_id']; ?>" data-fid="<?php echo $row['f_id']; ?>" id="f_count<?php echo $row['f_id']; ?>">
									<option <?php if ($row['f_count'] == 1) echo "selected"; ?> value="1">1</option>
									<option <?php if ($row['f_count'] == 2) echo "selected"; ?> value="2">2</option>
									<option <?php if ($row['f_count'] == 3) echo "selected"; ?> value="3">3</option>
									<option <?php if ($row['f_count'] == 4) echo "selected"; ?> value="4">4</option>
									<option <?php if ($row['f_count'] == 5) echo "selected"; ?> value="5">5</option>
									<option <?php if ($row['f_count'] == 6) echo "selected"; ?> value="6">6</option>
									<option <?php if ($row['f_count'] == 7) echo "selected"; ?> value="7">7</option>
									<option <?php if ($row['f_count'] == 8) echo "selected"; ?> value="8">8</option>
									<option <?php if ($row['f_count'] == 9) echo "selected"; ?> value="9">9</option>
									<option <?php if ($row['f_count'] == 10) echo "selected"; ?> value="10">10</option>
								</select>
								<?php
							} else { echo $pr->per_number(number_format($row['f_count'])); }?>
						</td>
                        <?php if ($remove == 1) { ?>
                            <td>
                            <button data-fid="<?php echo $row['f_id']; ?>" data-pid="<?php echo $row['p_id']; ?>"
                                    class="remove-from-factor btn btn-danger btn-sm">حذف
                            </button>
							</td><?php 
						} ?>
                    </tr>
                    <?php
                    $total += $row['pr_price'];
                    $i++;
                }
                ?>
                <tr>
                    <th></th>
                    <th style="text-align: center">جمع کل:</th>
                    <th style="text-align: center"><?php echo $pr->per_number(number_format($total)); ?></th>
                    <?php if ($remove == 1) { ?>
                        <th></th><?php } ?>
						<th></th>
                </tr>
            </table>
            <?php
        }
        return $total;
    }

    public function load_factor($g_id, $p_id){
        calc_end($g_id);
    }

}
