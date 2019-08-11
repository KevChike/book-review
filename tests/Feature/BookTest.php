<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_veiw_books()
    {
        $books = factory(\App\Models\Book::class, 3)->create();
        $response = $this->json('GET', route('api.books.index'));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
            'isbn' => $books->first()->isbn,
            'title' => $books->first()->title,
            'author' => $books->first()->author,
            'publication_year' => $books->first()->publication_year,
        ]);
    }
}
