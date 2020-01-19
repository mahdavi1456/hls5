<?php

class adjective
{
    public function load_adjective($g_id)
    {
		$db = new database();
        $adj = $db->get_var_query("select g_adjective from game where g_id = $g_id");
        if ($adj != "") { ?>
            <div class="col-md-12">
                <div class="alert alert-danger text-center">
                    <b>لیست امانتی ها:</b><span dir="ltr" class="alert-numbers"><?php echo $adj; ?></span>
                </div>
            </div>
            <?php
        }
    }
}