<?php

use App\Action\DisclaimerPageAction;
use Codeception\Util\Stub;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

/**
 * Class DisclaimerPageActionCest
 * @group BusinessPages
 */
class DisclaimerPageActionCest
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

    // tests
    public function tryToTest(UnitTester $I)
    {
        $page = new DisclaimerPageAction($this->router, $this->template);
        $response = $page(new ServerRequest(['/disclaimer']), new Response(), function () {});

        $I->assertTrue($response instanceof Response\HtmlResponse);
    }
}
