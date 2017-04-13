<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomePageTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Ensure that all active categories appear on the homepage.
     *
     * @return void
     */
    public function testListsActiveCategories()
    {
        $this->seed(\DatabaseSeeder::class);

        $categories = Category::active();

        $response = $this->get('/');

        $categories->each(function ($category) use ($response) {
            $response->assertSee($category->name);
        });
    }
}
