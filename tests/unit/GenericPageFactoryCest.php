<?php

use App\Action\DisclaimerPageAction;
use App\Action\GenericPageFactory;
use AspectMock\Test as test;
use Codeception\Util\Stub;
use Interop\Container\ContainerInterface;
use Mockery as m;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class GenericPageFactoryCest
{
    private $container;
    private $router;
    private $template;

    public function _before(UnitTester $I)
    {
        $this->template = m::mock(TemplateRendererInterface::class);
        $this->router = m::mock(RouterInterface::class, []);
        $this->container = m::mock(ContainerInterface::class);
    }

    public function tryToTest(UnitTester $I)
    {
        $this->container
            ->shouldReceive('has')
            ->with(TemplateRendererInterface::class)
            ->andReturn(true);

        $this->container
            ->shouldReceive('get')
            ->with(RouterInterface::class)
            ->andReturn($this->router);

        $this->container
            ->shouldReceive('get')
            ->with(TemplateRendererInterface::class)
            ->andReturn($this->template);

        $pageFactory = new GenericPageFactory($this->container, DisclaimerPageAction::class);

        $I->assertInstanceOf(
            DisclaimerPageAction::class,
            $pageFactory->__invoke($this->container, DisclaimerPageAction::class)
        );

    }
}
