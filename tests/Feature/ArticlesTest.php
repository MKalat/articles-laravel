<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use App\Models\Articles;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_if_can_get_article_unauthuser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->getJson('/api/article/'.$article->id);

        $response
        ->assertJsonFragment(['id'=> $article->id])
        ->assertJsonFragment(['title' => 'test'])
        ->assertJsonFragment(['body' => 'testing body']);
    }

    public function test_if_can_list_article_unAuthUser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->getJson('/api/article/list');

        $response
        ->assertJsonFragment(['id' => 1])
        ->assertJsonFragment(['title' => 'test'])
        ->assertJsonFragment(['body' => 'testing body']);
    }

    public function test_if_can_post_article_AuthUser(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/article', [
        'title' => 'apitest title',
        'body' => 'api test body',
        'publication_date' => now()
        ],
        ['Content-Type' => 'application/json']);

        $response
        ->assertJsonFragment(['title' => 'apitest title'])
        ->assertJsonFragment(['body' => 'api test body']);
    }

    public function test_if_can_put_article_AuthUser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->actingAs($user)->putJson('/api/article', [
        'id' => $article->id,
        'title' => 'apitest title 1',
        'body' => 'api test body 1',
        'publication_date' => now()
        ],
        ['Content-Type' => 'application/json']);

        $response
        ->assertJsonFragment(['id' => $article->id])
        ->assertJsonFragment(['title' => 'apitest title 1'])
        ->assertJsonFragment(['body' => 'api test body 1']);
    }

    public function test_if_can_delete_article_AuthUser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->actingAs($user)->deleteJson('/api/article', ['id' => $article->id], ['Content-Type' => 'application/json']);

        $response
        ->assertJsonFragment(['id' => $article->id]);
    }

    public function test_if_can_delete_article_UnAuthUser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->deleteJson('/api/article', ['id' => $article->id], ['Content-Type' => 'application/json']);

        $response
        ->assertStatus(403);
    }

    public function test_if_can_put_article_UnAuthUser(): void
    {
        $user = User::factory()->create();

        $article = Articles::factory()->create([
            'title' => 'test',
            'body' => 'testing body',
            'publication_date' => now(),
            'user_id' => $user->id,

        ]);

        $response = $this->putJson('/api/article', [
        'id' => $article->id,
        'title' => 'apitest title 1',
        'body' => 'api test body 1',
        'publication_date' => now()
        ],
        ['Content-Type' => 'application/json']);

        $response
        ->assertStatus(403);
    }
}
