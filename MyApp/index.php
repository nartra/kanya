<?php

define('KANYA_PATH', '/webroot/www/Kanya');
define('GLOBAL_PATH', '/webroot/www/Global');
define('APP_PATH', '/webroot/www/MyApp');

$initializer = include KANYA_PATH . '/bootstrap.php';

//$initializer->setBasePath(KANYA_PATH);
//$initializer->setApplicationPath(APP_PATH);
//$initializer->setGlobalPath(GLOBAL_PATH);

$kanya = $initializer->make(App\Core\MyKanya::class);

//router
$kanya->loader->include(APP_PATH . '/router.php', [
    'router' => $kanya->router()
]);

$kanya->run();
//$initializer->run();
//or

$app = include '../Kanya/bootstrap.php';
$app->run();
