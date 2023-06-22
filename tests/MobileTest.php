<?php

namespace Tests;

use App\Contact;
use App\Interfaces\CarrierInterface;
use App\Mobile;
use App\Services\ContactService;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class MobileTest extends TestCase
{
	
	/** @test */
	public function it_returns_null_when_name_empty()
	{
        $provider = $this->createMock(CarrierInterface::class);

		$mobile = new Mobile($provider);

		$this->assertNull($mobile->makeCallByName(''));
	}

    /** @test */
    public function testFindByName()
    {
        $name = 'Dandy';

        $contactMock = m::mock(Contact::class);

        $contactMock->shouldReceive('getAttribute')
            ->with('name')
            ->andReturn($name);

        $databaseMock = m::mock('alias:ContactService');
        $databaseMock->shouldReceive('findByName')
            ->with($name)
            ->andReturn($contactMock);

        $provider = $this->createMock(CarrierInterface::class);

        $mobile = new Mobile($provider);

        $this->assertTrue((bool)$mobile->makeCallByName('Dandy'));
    }

    /** @test */
    public function testFindByNameContactNotFound()
    {
        $name = 'Benyamin';
        $contactMock = m::mock(Contact::class);

        $contactMock->shouldReceive('getAttribute')
            ->with('name')
            ->andReturn('Dandy');

        $databaseMock = m::mock('alias:ContactService');
        $databaseMock->shouldReceive('findByName')
            ->with('Dandy')
            ->andReturn($contactMock);

        $result = ContactService::findByName($name);

        $this->assertNull($result);
    }

    /** @test */
    public function testValidateNumber()
    {
        // Número válido
        $validNumber = '955106414';
        $isValid = ContactService::validateNumber($validNumber);
        $this->assertTrue($isValid);

        // Número inválido
        $invalidNumber = 'abc123';
        $isValid = ContactService::validateNumber($invalidNumber);
        $this->assertFalse($isValid);
    }
}
