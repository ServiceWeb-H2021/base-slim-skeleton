<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Middleware\BasicAuthMiddleware;
use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->post('/users', \App\Action\UserCreateAction::class)
    // La route sera protégé par une authentification basique
    ->add(BasicAuthMiddleware::class);

    // Documentation de l'api
    $app->get('/docs/v1', \App\Action\Docs\SwaggerUiAction::class);


};

