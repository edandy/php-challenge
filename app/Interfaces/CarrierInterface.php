<?php

namespace App\Interfaces;

use App\Call;
use App\Contact;


interface CarrierInterface
{
	
	public function dialContact(Contact $contact);

	public function makeCall(): Call;

    public function setRecipient(Contact $contact);

    public function setMessage(Contact $contact);

    public function send();
}