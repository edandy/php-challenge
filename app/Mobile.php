<?php

namespace App;

use App\Interfaces\CarrierInterface;
use App\Services\ContactService;


class Mobile
{

	protected $provider;
	
	function __construct(CarrierInterface $provider)
	{
		$this->provider = $provider;
	}


	public function makeCallByName($name = '')
	{
		if( empty($name) ) return;

		$contact = ContactService::findByName($name);

		$this->provider->dialContact($contact);

		return $this->provider->makeCall();
	}

    public function sendSms($number, $body)
    {
        if (!ContactService::validateNumber($number)) {
            throw new Exception("Invalid number: $number");
        }

        $this->provider->setRecipient($number);
        $this->provider->setMessage($body);

        return $this->provider->send();
    }
}
