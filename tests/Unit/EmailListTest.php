<?php

namespace Tests\Unit;

use App\Services\Email\Email;
use App\Services\Email\EmailList;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EmailListTest extends TestCase
{
    public function testToArray()
    {
        $email = $this->createMock(Email::class);

        $email->expects($this->once())
            ->method('getDomain')
            ->willReturn('Nash Tech');

        $email->expects($this->once())
            ->method('__toString')
            ->willReturn('user@nashtech.com|subject');

        $emailList = new EmailList('Test');
        $emailList->addEmail($email);

        $this->assertEquals(['Nash Tech' => '<user@nashtech.com|subject>'], $emailList->toArray());
    }
}
