<?php
namespace App\ServiceManager;

use App\Entity\Contact;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ArraySerializable;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Zend\Db\TableGateway\TableGateway;

class TableGatewayAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (fnmatch('*TableGateway', $requestedName)) {
            return true;
        }

        return false;
    }

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TableGateway|null
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Adapter $dbAdapter */
        $dbAdapter = $container->get(Adapter::class);
        $tableGateway = null;

        switch ($requestedName) {
            case ('App\TableGateway\ContactTableGateway'):
                $hydrator = new ArraySerializable();
                $tableGateway = new TableGateway(
                    'tblcontact',
                    $dbAdapter,
                    null,
                    new HydratingResultSet($hydrator, new Contact())
                );
                break;
        }

        return $tableGateway;
    }
}
