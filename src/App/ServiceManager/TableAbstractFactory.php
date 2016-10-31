<?php
namespace App\ServiceManager;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

/**
 * Class TableAbstractFactory
 * @package App\ServiceManager\AbstractFactory
 */
class TableAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName) {
        if (fnmatch('*Table', $requestedName)) {
            return true;
        }
        return false;
    }

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return bool
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        if (class_exists($requestedName)) {
            $tableGateway = $requestedName . 'Gateway';
            return new $requestedName($container->get($tableGateway));
        }

        return false;
    }
}
