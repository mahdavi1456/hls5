<?php
class migration
{
    public function migrate_backup($table_temp)
    {
        $db = new database();
        $sql_backup = "CREATE TABLE $table_temp AS SELECT * FROM user";
        $db->ex_query($sql_backup);
    }

    public function migrate_drop($table)
    {
        $db = new database();
        $drop = $db->ex_query("DROP TABLE $table");
    }

    public function migrate_user()
    {
        $db = new database();

        //create backup into temp_table
        $this->migrate_backup('user_temp');

        //drop table
        $this->migrate_drop('user');

        //create new table
        $sql_new = "CREATE TABLE `user` (";
        $sql_new .= "`u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد',";
        //$sql_new .= "`a_id` int(11) NOT NULL COMMENT 'کد اکانت',";
        $sql_new .= "`u_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',";
        $sql_new .= "`u_family` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',";
        $sql_new .= "`u_username` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام کاربری',";
        $sql_new .= "`u_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'رمز',";
        $sql_new .= "`u_level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'سطح دسترسی',";
        $sql_new .= "`u_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل',";
        $sql_new .= "PRIMARY KEY (`u_id`)";
        $sql_new .= ") ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;";
        $db->ex_query($sql_new);

        //insert into table from temp table
        $sql_ins = "INSERT INTO user(u_id, u_name, u_family, u_username, u_password, u_level, u_mobile) ";
        $sql_ins .= "SELECT u_id, u_name, u_family, u_username, u_password, u_level, u_mobile FROM user_temp";
        $db->ex_query($sql_ins);

        //drop temp table
        $this->migrate_drop('user_temp');
    }

    public function migrate_person()
    {
        $db = new database();

        //create backup into temp_table
        $this->migrate_backup('person_temp');

        //drop table
        $this->migrate_drop('person');

        //create new table
        $sql_new = "CREATE TABLE `person` (";
        $sql_new .= "`p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد',";
        $sql_new .= "`p_name` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',";
        $sql_new .= "`p_family` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',";
        $sql_new .= "`p_fname` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام پدر',";
        $sql_new .= "`p_birth` date CHARACTER SET utf8 DEFAULT NULL COMMENT 'تاریخ تولد',";
        $sql_new .= "`p_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'کد اشتراک',";
        $sql_new .= "`p_phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'تلفن',";
        $sql_new .= "`p_mobile` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل',";
        $sql_new .= "`p_address` text CHARACTER SET utf8 DEFAULT NULL COMMENT 'آدرس',";
        $sql_new .= "`p_sharj` int(11) CHARACTER SET utf8 DEFAULT NULL COMMENT 'شارژ',";
        $sql_new .= "`p_expire` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT 'تاریخ انقضا',";
        $sql_new .= "`p_pack` int(11) CHARACTER SET utf8 DEFAULT NULL COMMENT 'بسته',";
        $sql_new .= "`p_regdate` date CHARACTER SET utf8 DEFAULT NULL COMMENT 'تاریخ ثبت نام',";
        $sql_new .= "`p_commitment` date CHARACTER SET utf8 DEFAULT NULL COMMENT 'تاریخ تعهد',";
        $sql_new .= "PRIMARY KEY (`p_id`)";
        $sql_new .= ") ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;";
        $db->ex_query($sql_new);
        echo $sql_new;

        //insert into table from temp table
        $sql_ins = "INSERT INTO person(p_id, p_name, p_family, p_fname, p_birth, p_code, p_phone, p_mobile, p_address, p_sharj, p_expire, p_pack, p_regdate, p_commitment) ";
        $sql_ins .= "SELECT p_id, p_name, p_family, p_fname, p_birth, p_code, p_phone, p_mobile, p_address, p_sharj, p_expire, p_pack, p_regdate, p_commitment FROM person_temp";
        $db->ex_query($sql_ins);

        //drop temp table
        $this->migrate_drop('person_temp');
    }

}