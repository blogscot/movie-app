<?php

require INC_ROOT . '/app/routes/home.php';

require INC_ROOT . '/app/routes/admin/users.php';
require INC_ROOT . '/app/routes/admin/transactions.php';
require INC_ROOT . '/app/routes/admin/adverts.php';
require INC_ROOT . '/app/routes/admin/faq.php';

require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/logout.php';
require INC_ROOT . '/app/routes/auth/password.php';
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/delete.php';

require INC_ROOT . '/app/routes/dashboard/profile.php';
require INC_ROOT . '/app/routes/dashboard/wallet.php';

require INC_ROOT . '/app/routes/advert/add.php';
require INC_ROOT . '/app/routes/advert/transactions.php';
require INC_ROOT . '/app/routes/advert/remove.php';
require INC_ROOT . '/app/routes/advert/update.php';
require INC_ROOT . '/app/routes/advert/view.php';
require INC_ROOT . '/app/routes/advert/viewall.php';
require INC_ROOT . '/app/routes/advert/adverts.php';

require INC_ROOT . '/app/routes/errors/404.php';
