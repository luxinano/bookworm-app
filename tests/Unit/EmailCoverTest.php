<?php

namespace Tests\Unit;

use App\Services\Email\Email;
use PHPUnit\Framework\TestCase;

class EmailCoverTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testFormatSubject(string $subject, string $expected): void
    {
        $address = 'user@example.com';
        $this->assertSame($expected, (new Email($address, $subject))->getSubject());
    }

    public function additionProvider(): array
    {
        return [
            'longer than 10 characters'  => ['long subject', 'long subje'],
            'equal 10 characters' => ['subject 10', 'subject 10'],
            'less than character' => ['subject', 'subject***'],
        ];
    }

}
