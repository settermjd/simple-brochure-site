<?php

use App\Entity\Contact;
use App\TableGateway\ContactTable;
use Faker\Factory;

/**
 * Class ContactTableTest
 * @group ContactPage
 * @group DataSourceLayer
 */
class ContactTableTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var ContactTable contactTable */
    private $contactTable;

    private $faker;

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->tester->truncateDb('tblcontact');
        $this->contactTable = $this->getModule('ZendExpressive')
            ->container
            ->get(ContactTable::class);
    }

    public function testCanInsertRecord()
    {
        $contactRecord = new Contact();
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text
        ];
        $contactRecord->populate($data);
        $contactRecordId = 1;

        $this->assertSame($contactRecordId, $this->contactTable->submitContactForm($contactRecord));
    }
}