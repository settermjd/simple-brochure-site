<?php

namespace App\Action;

use App\Entity\Contact;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Form\Annotation\AnnotationBuilder;

class ContactPageAction
{
    private $router;

    private $template;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null
    ) {
        $this->router   = $router;
        $this->template = $template;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        return new HtmlResponse($this->template->render('app::contact-page', [
            'form' => (new AnnotationBuilder())->createForm(new Contact())
        ]));
    }
}
