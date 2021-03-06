<?php

namespace App\Entity;

use App\Entity\Exception\HydrationException;
use Zend\Form\Annotation;

/**
 * @Annotation\Hydrator("Zend\Hydrator\ArraySerializable")
 * @Annotation\Name("Contact")
 * @Annotation\Options({
 *     "method":"POST"
 * })
 */
class Contact
{
    /**
     * @Annotation\AllowEmpty
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required(false)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"Digits"})
     * @Annotation\Filter({"name":"ToInt"})
     * @Annotation\Attributes({"value":"0"})
     *
     * @var int
     */
    private $id;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true"})
     * @Annotation\Validator({"name":"NotEmpty"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Attributes({
     *     "class":"form-control"
     * })
     * @Annotation\Options({
     *     "label":"Your Name:"
     * })
     *
     * @var string
     */
    private $name;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"false"})
     * @Annotation\Validator({"name":"NotEmpty"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Attributes({
     *     "class":"form-control"
     * })
     * @Annotation\Options({"label":"Your Email Address:"})
     * @Annotation\Validator({"name":"EmailAddress"})
     *
     * @var string
     */
    private $email;

    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"false"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Attributes({
     *     "class":"form-control"
     * })
     * @Annotation\Options({"label":"Your Message:"})
     *
     * @var string
     */
    private $message;

    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({
     *     "value":"Submit",
     *     "class":"btn btn-default btn-block"
     * })
     *
     * @var string
     */
    private $submit;

    /**
     * @param $data
     */
    public function populate($data)
    {
        if (is_array($data) && empty($data)) {
            throw new HydrationException();
        }

        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->message = $data['message'];
    }

    public function getArrayCopy()
    {
        $objCopy = get_object_vars($this);
        unset($objCopy['submit']);

        return $objCopy;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}
