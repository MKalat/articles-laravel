<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class Articles extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIfGetArticle(): void
    {
        $response = $this->getJson('/api/article/1');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 1)
                 ->where('title', 'test')
                 ->where('body', 'testing body'));
    }
}
