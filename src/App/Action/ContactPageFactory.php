<?php

namespace App\Action;

use App\Service\ContactFormServiceInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ContactPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $router   = $container->get(RouterInterface::class);
        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $contactFormService = $container->get(ContactFormServiceInterface::class);

        return new ContactPageAction($router, $template, $contactFormService);
    }
}
