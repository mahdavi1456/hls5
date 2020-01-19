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

        $res = $db->get_select_query("select * from factor where p_id = $p_id and f_status = 0");
        $total = 0;
        if (count($res) > 0) { ?>
            <table class="table text-center table-bordered koodak">
                <tr>
                    <th class="text-center" colspan="4">فاکتور فروشگاه</th>
                </tr>
                <tr>
                    <th class="text-center">ردیف</th>
                    <th class="text-center">نام کالا</th>
                    <th class="text-center">قیمت</th>
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
                        <?php if ($remove == 1) { ?>
                            <td>
                            <button data-fid="<?php echo $row['f_id']; ?>" data-pid="<?php echo $row['p_id']; ?>"
                                    class="remove-from-factor btn btn-danger btn-sm">حذف
                            </button></td><?php } ?>
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