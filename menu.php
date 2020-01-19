<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!--div class="image">
                    <img src="" class="img-circle elevation-2" alt="User Image">
                </div-->
                <div class="info">
                    <a href="" class="d-block">سلام
						<?php /*if(isset($_SESSION['name']) && isset($_SESSION['family'])) {
						echo $_SESSION['name'] . " " . $_SESSION['family']; } */?>
					</a>
                </div>
            </div>
            <?php $basename = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-header">عملیات</li>
                    <li class="nav-item has-treeview <?php if ($basename == 'fullday' || $basename == 'fullpay' || $basename == 'fullfactor' || $basename == 'person-report') echo 'menu-open'; ?>">
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