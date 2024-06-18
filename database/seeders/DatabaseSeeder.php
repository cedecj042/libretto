<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Author::factory(10)->create()->each(
            function (Author $author) {
                $books = Book::factory(3)->create(
                    ['author_id'=>$author->id]
                );
                $books->each(
                    function (Book $book) {
                        $genres=Genre::factory(2)->create();
                        $book->genres()->attach($genres);
                        Review::factory(5)->create(['book_id'=>$book->id]);
                    }
                );
            }
        );

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
