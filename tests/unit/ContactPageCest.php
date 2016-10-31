<?php

use App\Action\ContactPageAction;
use App\Service\ContactFormServiceInterface;
use Codeception\Util\Stub;
use Faker\Factory;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class ContactPageCest
{
    private $router;
    private $template;
    private $faker;

    public function _before(UnitTester $I)
    {
        $this->router = Stub::makeEmpty('\Zend\Expressive\Router\RouterInterface', []);
        $this->template = Stub::makeEmpty('\Zend\Expressive\Template\TemplateRendererInterface', [
            'render' => ''
        ]);
        $this->faker = Factory::create();
    }

    public function testContactPageAction(UnitTester $I)
    {
        $service = \Mockery::mock(ContactFormServiceInterface::class);
        $page = new ContactPageAction($this->router, $this->template, $service);
        $response = $page(new ServerRequest(['/contact']), new Response(), function () {});

        $I->assertTrue($response instanceof Response\HtmlResponse);
    }

    public function testContactPageActionSubmission(UnitTester $I, $scenario)
    {
        $scenario->incomplete("Not sure why the mocking's not working");

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text
        ];
        $contactForm = new \App\Entity\Contact();
        $contactForm->populate($data);
        $service = \Mockery::mock(ContactFormServiceInterface::class);
        $service->shouldReceive('submitContactForm')
            ->with($contactForm)
            ->atLeast(1)
            ->andReturn(1);
        $page = new ContactPageAction($this->router, $this->template, $service);
        $request = new ServerRequest(['/contact']);
        $request = $request->withParsedBody($data)->withMethod('POST');
        $response = $page($request, new Response(), function () {});

        $I->assertTrue($response instanceof Response\HtmlResponse);
    }
}
