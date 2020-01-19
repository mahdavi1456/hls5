<?php session_start();
define('site_name', 'helisoft');

define('ASSET_DIR', 'http://new.heliapp.ir/gt-content/asset/');
define('ASSET_URL', 'http://new.heliapp.ir/gt-content/asset/');

define('VIEW_DIR', 'http://new.heliapp.ir/gt-content/view/');
define('VIEW_URL', 'http://new.heliapp.ir/gt-content/view/');

define('ROOT_URL', 'http://new.heliapp.ir/');
define('ROOT_DIR', 'http://new.heliapp.ir/');
define('INC_DIR', 'gt-include/');
define('INC_URL', 'http://new.heliapp.ir/gt-include/');

define('LIB_DIR', 'gt-include/lib/');

include LIB_DIR . "jdf.php";

include INC_DIR . "class/prime.php";
include INC_DIR . "class/gdate.php";
include INC_DIR . "class/aru.php";
include INC_DIR . "class/database.php";
include INC_DIR . "class/migration.php";
include INC_DIR . "class/sms.php";

include INC_DIR . "class/option.php";

include INC_DIR . "class/product.php";
include INC_DIR . "class/factor.php";
include INC_DIR . "class/user.php";
include INC_DIR . "class/person.php";
include INC_DIR . "class/game.php";
include INC_DIR . "class/package.php";
include INC_DIR . "class/adjective.php";
include INC_DIR . "class/modal.php";
include INC_DIR . "class/offer.php";
include INC_DIR . "class/payment.php";
include INC_DIR . "class/book.php";