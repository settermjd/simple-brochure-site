<?php

namespace App\Service;

use App\Entity\Contact;

interface ContactFormServiceInterface
{
    /**
     * This method takes the data provided and makes a contact form submission with it
     *
     * @param Contact $contactForm
     * @return boolean
     */
    public function submitContactForm(Contact $contactForm);
}