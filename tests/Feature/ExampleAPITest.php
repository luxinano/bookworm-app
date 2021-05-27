<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleAPITest extends TestCase
{
    private $url = 'api/example/';

    public function testGetEmail()
    {
        $address = 'user@gmail.com';
        $subject = 'subject';
        $data = ['address' => $address, 'subject' => $subject];
        $response = $this->json('GET', $this->url . 'getEmail', $data);
        $response->assertStatus(200)->assertExactJson(['domain' => 'Google',  'email' => "$address|$subject***"]);
    }
}
