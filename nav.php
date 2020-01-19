<?php require_once "gt-include.php"; ?>
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
            <a href="<?php echo ROOT_URL; ?>index.php" class="nav-link">داشبورد</a>
        </li>
    </ul>

    <!--form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form-->

    <ul class="navbar-nav mr-auto">
        <!--li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-comments-o"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="<?php //echo ASSET_URL; ?>dist/img/user1-128x128.jpg" alt="User Avatar"
                             class="img-size-50 ml-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                حسام موسوی
                                <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">با من تماس بگیر لطفا...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="<?php //echo ASSET_URL; ?>dist/img/user8-128x128.jpg" alt="User Avatar"
                             class="img-size-50 img-circle ml-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                پیمان احمدی
                                <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">من پیامتو دریافت کردم</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="<?php //echo ASSET_URL; ?>dist/img/user3-128x128.jpg" alt="User Avatar"
                             class="img-size-50 img-circle ml-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                سارا وکیلی
                                <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
            </div>
        </li-->
        <li class="nav-item dropdown">
            <?php
			$db = new database();
			$p_m_date = jdate('-m-d');
			$sql_m = "select * from person inner join person_meta on person.p_id = person_meta.p_id where person_meta.pm_meta = 'marry_date' and person_meta.pm_value like '%$p_m_date%' order by person.p_id desc";
			$res_m = $db->get_select_query($sql_m);
			
			$p_birth = jdate('-m-d');
			$sql_birth = "select * from person where p_birth like '%$p_birth%' order by p_id desc";
			$res_birth = $db->get_select_query($sql_birth);	
			
			$t =  count($res_m) + count($res_birth)
			?>
			<a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge"><?php echo $t; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <span class="dropdown-item dropdown-header"><?php echo $t; ?> اعلان</span>
                <div class="dropdown-divider"></div>
                <a href="<?php echo VIEW_URL; ?>sms/greeting.php" class="dropdown-item">
                    <i class="fa fa-envelope ml-2"></i> <?php echo count($res_birth); ?> تولد
                    <span class="float-left text-muted text-sm">امروز</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo VIEW_URL; ?>sms/anniversary.php" class="dropdown-item">
                    <i class="fa fa-envelope ml-2"></i> <?php echo count($res_m); ?> سالگرد ازدواج
                    <span class="float-left text-muted text-sm">امروز</span>
                </a>
            </div>
        </li>
        <!--li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
        </li-->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?logout=1"><i
                        class="fa fa-power-off"></i></a>
        </li>
    </ul>
</nav>