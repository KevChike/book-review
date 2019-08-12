<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Name of table
     *
     * @var string
     */
    protected $tableName = 'books';

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
            'id' => $books->first()->id,
            'isbn' => $books->first()->isbn,
            'title' => $books->first()->title,
            'author' => $books->first()->author,
            'publication_year' => $books->first()->publication_year,
        ]);
    }

    /** @test */
    public function authenticated_user_can_access_create_book_api()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $book = factory(\App\Models\Book::class)->make();
        $response = $this->json('POST', route('api.books.store'), $book->toArray());
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 201,
            'title' => 'Created',
            'edition' => $book->edition,
            'isbn' => $book->isbn,
            'title' => $book->title,
            'author' => $book->author,
            'publication_year' => $book->publication_year,
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_create_book_api()
    {
        $this->withExceptionHandling();
        $book = factory(\App\Models\Book::class)->make();
        $response = $this->json('POST', route('api.books.store'), $book->toArray());
        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_access_update_book_api()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');
        $book = factory(\App\Models\Book::class)->create();
        $book->title = "New book title";
        $book->edition = "1";
        $this->assertArrayHasKey('id', $book->toArray());
        $response = $this->json('PUT', route('api.books.update', $book->id), $book->toArray());
        $this->assertDatabaseHas($this->tableName, [
            'title' => $book->title,
            'edition' => $book->edition
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success',
            'code' => 200,
            'title' => 'OK',
        ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_update_book_api()
    {
        $this->withExceptionHandling();
        $book = factory(\App\Models\Book::class)->create();
        $book->title = "New book title";
        $book->edition = "1";
        $this->assertArrayHasKey('id', $book->toArray());
        $response = $this->json('PUT', route('api.books.update', $book->id), $book->toArray());
        $this->assertDatabaseMissing($this->tableName, [
            'title' => $book->title,
            'edition' => $book->edition
        ]);
        $response->assertStatus(401);
    }

}
