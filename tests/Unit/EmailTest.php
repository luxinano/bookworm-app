<?php

namespace Tests\Unit;

use App\Services\Email\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            Email::class,
            new Email('user@example.com', 'subject')
        );
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com|subject***',
            new Email('user@example.com', 'subject')
        );
    }

    /**
     * @depends testCanBeUsedAsString
     */
    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('invalid', 'subject');
    }
}
