<?php

require INC_ROOT . '/app/routes/home.php';

require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/logout.php';

require INC_ROOT . '/app/routes/userprofile/profile.php';
require INC_ROOT . '/app/routes/userprofile/wallet.php';

require INC_ROOT . '/app/routes/advert/add.php';
require INC_ROOT . '/app/routes/advert/view.php';
require INC_ROOT . '/app/routes/advert/viewall.php';
require INC_ROOT . '/app/routes/advert/viewbyuser.php';
require INC_ROOT . '/app/routes/advert/update.php';
require INC_ROOT . '/app/routes/advert/remove.php';