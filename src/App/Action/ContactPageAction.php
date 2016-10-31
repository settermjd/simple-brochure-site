<?php

namespace App\Action;

use App\Entity\Contact;
use App\Service\ContactFormServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Form\Annotation\AnnotationBuilder;

class ContactPageAction
{
    /**
     * @var Router\RouterInterface
     */
    private $router;

    /** @var Template\TemplateRendererInterface  */
    private $template;

    /** @var ContactFormServiceInterface  */
    private $contactService;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        ContactFormServiceInterface $service
    ) {
        $this->router = $router;
        $this->template = $template;
        $this->contactService = $service;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $data = [];
        $form = (new AnnotationBuilder())->createForm(new Contact());

        if ($request->getMethod() === 'POST') {
            $form->bind(new Contact());
            $form->setData($request->getParsedBody());
            if ($form->isValid()) {
                if ($this->contactService->submitContactForm($form->getData())) {
                    $data['valid_submit'] = true;
                    $form->clearAttributes();
                }
            }
        }

        $data['form'] = $form;

        return new HtmlResponse($this->template->render('app::contact-page', $data));
    }
}
