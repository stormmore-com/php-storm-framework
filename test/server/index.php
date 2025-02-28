<?php

require  __DIR__ . '/../../vendor/autoload.php';

use Stormmore\Framework\App;
use Infrastructure\Middleware\AliasMiddleware;
use Infrastructure\Middleware\AppUserMiddleware;
use Infrastructure\Middleware\ErrorMiddleware;
use Infrastructure\Middleware\LocaleMiddleware;
use Infrastructure\Middleware\SettingsMiddleware;

$app = App::create(projectDir: "../", sourceDir: "../src", cacheDir: "../.cache");
$app->addRoute('/hello', function() {
    return "hello world";
});

$app->add(AliasMiddleware::class);
$app->add(SettingsMiddleware::class);
$app->add(LocaleMiddleware::class);
$app->add(ErrorMiddleware::class);
$app->add(AppUserMiddleware::class);

$app->run();