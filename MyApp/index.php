<?php

$initializer = include '../Kanya/bootstrap.php';

$initializer->setBasePath('/webroot/www/Kanya');
$initializer->setApplicationPath('/webroot/www/MyApp');

$initializer->setHandler(App\Core\MyKanya::class);

$initializer->getHandler()->run();
$initializer->run();

//or

$app = include '../Kanya/bootstrap.php';
$app->run();