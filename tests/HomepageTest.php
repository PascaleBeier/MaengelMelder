<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testCanSeeCategories()
    {
        $this->seed(DatabaseSeeder::class);

        $categories = App\Category::all();

        $this->visit('/');

        foreach ($categories as $category) {
            $this->see($category->name);
        }
    }
}
