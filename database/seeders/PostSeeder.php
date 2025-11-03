<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'First Post',
                'content' => 'This is the content of the first post.',
                'user_id' => 1,
            ],
            [
                'title' => 'Second Post',
                'content' => 'This is the content of the second post.',
                'user_id' => 2,
            ]
        ]);
    }
}
