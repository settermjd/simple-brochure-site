<?php

use App\Action\ContactPageAction;
use Codeception\Util\Stub;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class ContactPageCest
{
    private $router;
    private $template;

    public function _before(UnitTester $I)
    {
        $this->router = Stub::makeEmpty('\Zend\Expressive\Router\RouterInterface', []);
        $this->template = Stub::makeEmpty('\Zend\Expressive\Template\TemplateRendererInterface', [
            'render' => ''
        ]);
    }

    public function testContactPageAction(UnitTester $I)
    {
        $page = new ContactPageAction($this->router, $this->template);
        $response = $page(new ServerRequest(['/contact']), new Response(), function () {});

        $I->assertTrue($response instanceof Response\HtmlResponse);
    }
}
