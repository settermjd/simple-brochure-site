<?php

namespace Apptests\unit\Entity;

use App\Entity\Contact;
use Codeception\Test\Unit;
use Faker\Factory;
use Zend\Form\Annotation\AnnotationBuilder;

class ContactTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    protected function _before()
    {
        $this->faker = Factory::create();
    }

    public function testCanPopulateContact()
    {
        $contact = new Contact();
        $data = [
            'id' => $this->faker->randomDigitNotNull,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text,
        ];

        $contact->populate($data);

        $this->assertSame($data['id'], $contact->getId());
        $this->assertSame($data['name'], $contact->getName());
        $this->assertSame($data['email'], $contact->getEmail());
        $this->assertSame($data['message'], $contact->getMessage());
    }

    /**
     * @dataProvider formValidatorDataProvider
     *
     * @param array $data
     * @param bool  $isValid
     */
    public function testFormValidatesSuccessfully(array $data, $isValid)
    {
        $form = (new AnnotationBuilder())->createForm(new Contact());
        $form->setData($data);
        $this->assertSame($isValid, $form->isValid());
    }

    /**
     * @dataProvider formFilterDataProvider
     *
     * @param array $preFilterData
     * @param array $postFilterData
     */
    public function testFormFiltersSuccessfully(array $preFilterData, array $postFilterData)
    {
        $form = (new AnnotationBuilder())->createForm(new Contact());
        $form->setData($preFilterData);
        $form->isValid();
        $this->assertEquals($postFilterData, $form->getData());
    }

    /**
     * Validate the the properties of the form are as they should be.
     */
    public function testFormProperties()
    {
        $form = (new AnnotationBuilder())->createForm(new Contact());

        // check form labels
        $this->assertEquals('Your Name:', $form->get('name')->getLabel());
        $this->assertEquals('Your Email Address:', $form->get('email')->getLabel());
        $this->assertEquals('Your Message:', $form->get('message')->getLabel());
        $this->assertEquals('Submit', $form->get('submit')->getValue());
    }

    public function formFilterDataProvider()
    {
        $faker = Factory::create();

        $name = $faker->name;
        $email = $faker->email;
        $message = $faker->text;

        return [
            [
                [
                    'id' => '0',
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'submit' => null,
                ],
                [
                    'id' => 0,
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                    'submit' => null,
                ],
            ],
        ];
    }

    public function formValidatorDataProvider()
    {
        $faker = Factory::create();

        return [
            [
                [
                    'id' => $faker->randomDigit,
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'message' => $faker->text,
                ],
                true,
            ],
            [
                [
                    'id' => $faker->randomDigit,
                    'name' => $faker->text,
                    'email' => $faker->dateTimeThisYear,
                    'message' => $faker->text,
                ],
                false,
            ],
        ];
    }
}
