<?php

$router->addHandler(new BasicRouteHandler());
$router->setbaseUri('/nartra');
$router->setMaximumRetry(5);

$router->route('ANY', '/', function($kanya) {
    $kanya->response()->write('test');
});

$router->any('/', function($kanya) {
    $kanya->response()->write('test');
})->name();

$router->route('GET POST', '/', function($kanya) {
    $kanya->response()->write('test');
})->name('a');

$router->route('GET POST', '/', 'App.Controller:index')->name('a');
$router->route('GET POST', '/', Handler::create('App.Controller', 'index', [1, 2]))->name('a');

$router->any('/')
        ->call(function($kanya) {
            $kanya->response()->write('test');
        })
        ->call(function($kanya) {
            $kanya->router()->routeTo('a');
            $kanya->router()->setRoute('GET:/home');
            $kanya->router()->setRoute(new Uri('/home', 'GET', ['id' => 1]));
            $kanya->router()->retry();
            $kanya->router()->skip();
            $kanya->router()->cancel();
            $kanya->router()->notFound();
            $kanya->router()->notOk(500, 'internal error');
        })
        ->call(function($kanya) {
            return false;
        })
        ->name();

$router->any('/article')
        ->sub(function(Route $router) {
            $router->call();
            $router->any('/create')->call();
        });

$router->notFound()->call();
$router->notOk()->call();

//custom
$router->any('/admin')->call(Middleware\Access\Permission\Admin::class)->call('Admin.index');
$router->permissionDenied()->call();
