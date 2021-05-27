<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ExampleDatabaseTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/example';

    public function testStore()
    {
        $author = ['id' => 1,'name' => 'UK', 'bio' => 'London'];
        $response = $this->json('POST', $this->url, $author);
        $response->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->has(3)->whereAll($author));
    }

    public function testIndex()
    {
        Author::factory()->count(10)->create();
        $response = $this->json('GET', $this->url);
        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has(10)->whereAllType([
                '0.id' => 'integer',
                '0.author_name' => 'string',
                '0.author_bio' => 'string',
            ])
        );
    }


}
