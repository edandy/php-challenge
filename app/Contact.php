<?php

namespace App;


class Contact
{
    /**
     * @var
     */
    private $name;

	function __construct($name)
	{
        $this->name = $name;
	}

    public function getName()
    {
        return $this->name;
    }
}