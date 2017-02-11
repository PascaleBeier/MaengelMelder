<?php

namespace Tests\Feature;

use App\User;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeCategoryUserCreateTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testListsUnattachedUsers()
    {
        $this->seed(\DatabaseSeeder::class);

        $user = User::find(1);

        $this->actingAs($user);

        $categories = Category::all();
        $users = User::all();

        $categories->each(function ($category) use ($users) {
            $response = $this->get('/admin/categories/'.$category->id.'/users/create');
            $users->each(function ($user) use ($response) {
                $response->assertSee($user->name);
                $response->assertSee($user->email);
            });
        });
    }
}
