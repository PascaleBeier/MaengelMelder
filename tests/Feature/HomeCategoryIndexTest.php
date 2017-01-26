<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ {
    DatabaseMigrations,
    DatabaseTransactions
};
use App\ {
    User,
    Category
};

class HomeCategoryIndex extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testListsCategories()
    {
        $this->seed(\DatabaseSeeder::class);

        $user = User::find(1);
        $categories = Category::all();

        $this->actingAs($user);

        $response = $this->get('/home/categories/');

        $categories->each(function ($category) use ($response) {
            $response->assertSee($category->name);
        });
    }
}
