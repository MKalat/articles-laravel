<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use App\Models\Article;

class Articles extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIfCanGetArticleUnAuthUser(): void
    {
        $response = $this->getJson('/api/article/1');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 1)
                 ->where('title', 'test')
                 ->where('body', 'testing body'));
    }

    public function testIfCanListArticleUnAuthUser(): void
    {
        $response = $this->getJson('/api/article/list');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 1)
                 ->where('title', 'test')
                 ->where('body', 'testing body'));
    }

    public function testIfCanPostArticleAuthUser(): void
    {
        $user = User::factory()->create([
            'id' => 2,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response = $this->actingAs($user)->postJson('/api/article/add', [
        'title' => 'apitest title',
        'body' => 'api test body',
        'publication_date' => now()
        ],
        ['Content-Type' => 'application/json']);

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('title', 'apitest title')
                 ->where('body', 'api test body'));
    }

    public function testIfCanPutArticleAuthUser(): void
    {
        $user = User::factory()->create([
            'id' => 2,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Article::factory()->create([
            'id' => 2,
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => 2,

        ]);

        $response = $this->actingAs($user)->putJson('/api/article/update/2', [
        'title' => 'apitest title 1',
        'body' => 'api test body 1',
        'publication_date' => now()
        ],
        ['Content-Type' => 'application/json']);

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id',1)
                ->where('title', 'apitest title 1')
                ->where('body', 'api test body 1'));
    }

    public function testIfCanDeleteArticleAuthUser(): void
    {
        $user = User::factory()->create([
            'id' => 2,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Article::factory()->create([
            'id' => 2,
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => 2,

        ]);

        $response = $this->actingAs($user)->deleteJson('/api/article/delete/2', [], ['Content-Type' => 'application/json']);

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 2)
        );
    }
}
