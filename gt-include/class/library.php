<?php
class library
{
    function get_book_name($b_id)
    {
        $b_name = get_var_query("select b_name from book where b_id = $b_id");
        if ($b_name) {
            return $b_name;
        } else {
            return "نامعتبر";
        }
    }
}