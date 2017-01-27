<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => bcrypt('admin'),
                'email' => 'admin@maengelmelder.app',
            ],
            [
                'name' => 'frank',
                'password' => bcrypt('frank'),
                'email' => 'frank@maengelmelder.app'
            ]
        ]);


        $categories = [
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
        ];

        foreach($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'body' => '',
            ]);
        }
    }
}
