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
     * Ensure we are being redirect to the installation.
     *
     * @return void
     */
    public function testRedirectstoInstallation()
    {
        $response = $this->get('/');
        $response->assertRedirect('/setup');
    }

    /**
     * Ensure that all active categories appear on the homepage.
     *
     * @return void
     */
    public function testListsActiveCategoriesAfterInstallation()
    {
        // Assume installed
        touch(storage_path('install.lock'));
        $this->seed(\DatabaseSeeder::class);

        $categories = Category::active();

        $response = $this->get('/');

        $categories->each(function ($category) use ($response) {
            $response->assertSee($category->name);
        });
    }
}
