<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReviewTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function authenticated_user_can_access_create_review_api()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $review = factory(\App\Models\Review::class)->create();
        $response = $this->json('POST', route('api.reviews.store'), $review->toArray());
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 201,
            'title' => 'Created',
            'book_id' => $review->book_id,
            'user_id' => $review->user_id,
            'content' => $review->content,
            'rating' => $review->rating,
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_create_review_api()
    {
        $this->withExceptionHandling();
        $review = factory(\App\Models\Review::class)->create();
        $response = $this->json('POST', route('api.reviews.store'), $review->toArray());
        $response->assertStatus(401);
    }
}
