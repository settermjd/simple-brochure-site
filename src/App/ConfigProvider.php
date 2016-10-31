<?php

namespace App;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'routes' => $this->getRouteConfig(),
        ];
    }

    public function getRouteConfig()
    {
        return [
            [
                'name' => 'home',
                'path' => '/',
                'middleware' => Action\HomePageAction::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'contact',
                'path' => '/contact',
                'middleware' => Action\ContactPageAction::class,
                'allowed_methods' => ['GET', 'POST'],
            ],
            [
                'name' => 'disclaimer',
                'path' => '/disclaimer',
                'middleware' => Action\DisclaimerPageAction::class,
                'allowed_methods' => ['GET'],
            ],
            [
                'name' => 'api.ping',
                'path' => '/api/ping',
                'middleware' => Action\PingAction::class,
                'allowed_methods' => ['GET'],
            ],
        ];
    }

    public function getDependencyConfig()
    {
        return [
            'invokables' => [
                Action\PingAction::class => Action\PingAction::class,
            ],
            'factories' => [
                Action\HomePageAction::class => Action\HomePageFactory::class,
                Action\DisclaimerPageAction::class => Action\GenericPageFactory::class,
                Action\ContactPageAction::class => Action\GenericPageFactory::class,
            ],
            'abstract_factories' => [
                ServiceManager\TableAbstractFactory::class,
                ServiceManager\TableGatewayAbstractFactory::class,
            ]
        ];
    }
}
