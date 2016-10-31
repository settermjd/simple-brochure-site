<?php

namespace App\TableGateway;

use App\Entity\Contact;
use App\Service\ContactFormServiceInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class ContactTable
 * @package App\TableGateway
 */
class ContactTable implements ContactFormServiceInterface
{
    /**
     * @var TableGateway
     */
    protected $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param Contact $contactForm
     * @return int
     */
    public function submitContactForm(Contact $contactForm)
    {
        $data = [
            'name' => $contactForm->getName(),
            'email' => $contactForm->getEmail(),
            'message' => $contactForm->getMessage(),
        ];

        if ($this->tableGateway->insert($data)) {
            return (int)$this->tableGateway->getLastInsertValue();
        }
    }
}