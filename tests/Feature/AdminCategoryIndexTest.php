<?php

namespace Tests\Feature;

use App\ User;
use App\ Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\ DatabaseMigrations;
use Illuminate\Foundation\Testing\ DatabaseTransactions;

class AdminCategoryIndex extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testListsCategories()
    {
        $this->seed(\DatabaseSeeder::class);

        $user = User::find(1);
        $categories = Category::all();

        $this->actingAs($user);

        $response = $this->get('/admin/categories');

        $categories->each(function ($category) use ($response) {
            $response->assertSee($category->name);
        });
    }
}
