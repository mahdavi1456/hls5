<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!--div class="image">
                    <img src="" class="img-circle elevation-2" alt="User Image">
                </div-->
                <div class="info">
					<a id="push-menu" class="nav-link a-pos text-left" data-widget="pushmenu" href="#">x</a>
                    <a href="" class="r-pos d-block">سلام
						<?php 
							$db = new database();
							$u_id = $_SESSION['user_id'];
							$sql = "select * from user where u_id = $u_id";
							$u_level = $db->get_var_query("select u_level from user where u_id = $u_id", 1);
							$res = $db->get_select_query($sql, 1);
							if(count($res) > 0) {
								foreach($res as $row) {
									echo $row['u_name'] . " " . $row['u_family'];
								}
							} ?>
					</a>
					
                </div>
            </div>
            <?php $basename = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
						<?php 
					if($u_level == "مدیر"){ ?>
                    <li class="nav-header">عملیات</li>
                    <li class="nav-item has-treeview <?php if ($basename == 'fullday' || $basename == 'fullpay' || $basename == 'fullfactor' || $basename == 'person-report' || $basename == 'report-reserv') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                گزارشات
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>report/fullday.php" class="nav-link <?php if($basename == 'fullday') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش جامع روز</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>report/fullpay.php" class="nav-link <?php if($basename == 'fullpay') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش مالی روز</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>report/fullfactor.php" class="nav-link <?php if($basename == 'fullfactor') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش فاکتور روز</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>report/person-report.php" class="nav-link <?php if($basename == 'person-report') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش حساب اشخاص</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>report/report-reserv.php" class="nav-link <?php if($basename == 'report-reserv') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش رزرو غذاها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-item has-treeview <?php if ($basename == 'send-sms' || $basename == 'sms-report' || $basename == 'greeting' || $basename == 'anniversary') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-send"></i>
                            <p>
                                پیامک
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>sms/send-sms.php" class="nav-link <?php if($basename == 'send-sms') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ارسال پیامک</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>sms/sms-report.php" class="nav-link <?php if($basename == 'sms-report') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارشات ارسال</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>sms/greeting.php" class="nav-link <?php if($basename == 'greeting') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تبریک تولد</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>sms/anniversary.php" class="nav-link <?php if($basename == 'anniversary') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>سالگرد ازدواج</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-item has-treeview <?php if ($basename == 'set-book' || $basename == 'set-loan' || $basename == 'taken-books') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                کتابخانه
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>library/set-book.php" class="nav-link <?php if($basename == 'set-book') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تعریف کتب</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>library/set-loan.php" class="nav-link <?php if($basename == 'set-loan') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ثبت امانت</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>library/taken-books.php" class="nav-link <?php if($basename == 'taken-books') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش امانات</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-item has-treeview <?php if ($basename == 'food' || $basename == 'food-plan' || $basename == 'food-reserv' ) echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                آشپزخانه
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>kitchen/food.php" class="nav-link <?php if($basename == 'food') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>غذاها</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>kitchen/food-plan.php" class="nav-link <?php if($basename == 'food-plan') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>برنامه غذایی</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>kitchen/food-reserv.php" class="nav-link <?php if($basename == 'food-reserv') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>رزرو غذا</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-item has-treeview <?php if ($basename == 'headlines' || $basename == 'list-cost' ) echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-database"></i>
                            <p>
                                هزینه ها
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>cost/headlines.php" class="nav-link <?php if($basename == 'headlines') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>سرفصل ها</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>cost/list-cost.php" class="nav-link <?php if($basename == 'list-cost') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>مدیریت هزینه ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<?php
					} ?>
                    <li class="nav-header">تعاریف</li>
					<li class="nav-item has-treeview <?php if ($basename == 'person' || $basename == 'product' || $basename == 'package' || $basename == 'adjective' || $basename == 'offer' || $basename == 'course') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                تعاریف
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">					
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>person/person.php"
								   class="nav-link <?php if ($basename == 'person') echo 'active'; ?>">
									<i class="nav-icon fa fa-user"></i>
									<p>اشخاص</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>product/product.php"
								   class="nav-link <?php if ($basename == 'product') echo 'active'; ?>">
									<i class="nav-icon fa fa-apple"></i>
									<p>محصولات</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>package/package.php"
								   class="nav-link <?php if ($basename == 'package') echo 'active'; ?>">
									<i class="nav-icon fa fa-star"></i>
									<p>بسته ها</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>adjective/adjective.php"
								   class="nav-link <?php if ($basename == 'adjective') echo 'active'; ?>">
									<i class="nav-icon fa fa-bookmark"></i>
									<p>امانتی ها</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>offer/offer.php"
									class="nav-link <?php if ($basename == 'offer') echo 'active'; ?>">
									<i class="nav-icon fa fa-dollar"></i>
									<p>کدهای تخفیف</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo VIEW_URL; ?>course/course.php"
									class="nav-link <?php if ($basename == 'course') echo 'active'; ?>">
									<i class="nav-icon fa fa-book"></i>
									<p>کارگاه ها</p>
								</a>
							</li>
						</ul>
                    </li>
					<?php 
					if($u_level == "مدیر"){ ?>
                    <li class="nav-header">مدیریت</li>
                    <li class="nav-item has-treeview <?php if ($basename == 'global' || $basename == 'price' || $basename == 'sms') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-gears"></i>
                            <p> تنظیمات<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>setting/global.php"
                                   class="nav-link <?php if ($basename == 'global') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>عمومی</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>setting/price.php"
                                   class="nav-link <?php if ($basename == 'price') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تعرفه</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>setting/sms.php"
                                   class="nav-link <?php if ($basename == 'sms') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>پیامک</p>
                                </a>
                            </li>
                        </ul>
                    </li>
					<li class="nav-item has-treeview <?php if ($basename == 'user' || $basename == 'user_activity') echo 'menu-open'; ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p> پرسنل<i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>user/user.php"
                                   class="nav-link <?php if ($basename == 'user') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>حساب کاربری</p>
                                </a>
                            </li>
							<li class="nav-item">
                                <a href="<?php echo VIEW_URL; ?>user/user_activity.php"
                                   class="nav-link <?php if ($basename == 'user_activity') echo 'active'; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گزارش تردد</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo ROOT_URL; ?>support.php"
                           class="nav-link <?php if ($basename == 'support') echo 'active'; ?>">
                            <i class="nav-icon fa fa-phone-square"></i>
                            <p>پشتیبانی</p>
                        </a>
                    </li>
					<?php
					} ?>
                    <!--li class="nav-item">
                        <a href="<?php //echo INC_URL; ?>data/migration.php"
                           class="nav-link <?php //if ($basename == 'migration') echo 'active'; ?>">
                            <i class="nav-icon fa fa-refresh"></i>
                            <p>همگام سازی</p>
                        </a>
                    </li-->
                </ul>
            </nav>
        </div>
    </div>
</aside>