<?php

namespace Tests\Unit;

use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_making_a_comment_by_api(): void
    {
        $response = $this->postJson('/api/comments', [
            'name' => fake()->name,
            'body' => fake()->paragraph(),
        ]);
        $response->assertStatus(201);
    }

    public function test_making_an_replies_by_api(): void
    {
        $comment = Comment::factory()->create();

        $response1 = $this->postJson('/api/comments', [
            'name' => fake()->name,
            'body' => fake()->paragraph(),
            'parent_id' => $comment->id,
        ]);
        $response1->assertStatus(201);

        $response2 = $this->postJson('/api/comments', [
            'name' => fake()->name,
            'body' => fake()->paragraph(),
            'parent_id' => $comment->id,
        ]);
        $response2->assertStatus(201);
    }

    public function test_get_all_comments_by_api(): void
    {
        Comment::factory()->create();
        $response = $this->getJson('/api/comments');
        $response->assertStatus(200);
        $response->assertJsonCount(1, $key = null);
    }
}
