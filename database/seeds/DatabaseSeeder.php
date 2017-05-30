<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the default admin user
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => bcrypt('admin'),
                'email' => 'admin@maengelmelder.app',
            ]
        ]);

        // Create default categories
        $categories = collect([
            'Anregungen und Lob',
            'Beleuchtung',
            'Graffiti',
            'Grünflächen',
            'Hundekot',
            'Illegaler Müll',
            'Radwege',
            'Schulweg',
            'Spielplätze',
            'Straßenschilder',
            'Straßenschäden',
        ])->each(function($category) {
            DB::table('categories')->insert(['name' => $category']);
        });
    }
}
