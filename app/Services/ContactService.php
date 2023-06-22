<?php

namespace App\Services;

use App\Contact;


class ContactService
{

    /**
     * @param $name
     * @return Contact|null
     */
    public static function findByName($name): Contact|null
	{
        $contacts = [
            new Contact('Dandy'),
        ];

        foreach ($contacts as $contact) {
            if ($contact->getName() === $name) {
                return $contact;
            }
        }

        return null;
	}

	public static function validateNumber(string $number): bool
	{
        // Verificar si el número contiene solo dígitos y guiones
        if (!preg_match('/^[0-9-]+$/', $number)) {
            return false;
        }

        return true;
	}
}