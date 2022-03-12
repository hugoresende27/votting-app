<?php

namespace Database\Seeders;

use App\Models\CommunityLink;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        \DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'trusted'=>1
        ]);

        \DB::table('users')->insert([
            'name' => 'hugo',
            'email' => 'a@a',
            'password' => bcrypt('1111'),
        ]);

        \DB::table('channels')->insert([
            'title' => 'PHP',
            'slug' => 'php',
            'color' => 'red',
        ]);

        \DB::table('channels')->insert([
            'title' => 'JS',
            'slug' => 'js',
            'color' => 'blue',
        ]);
        
        \DB::table('channels')->insert([
            'title' => 'Ruby',
            'slug' => 'ruby',
            'color' => 'green',
        ]);


        \App\Models\CommunityLink::factory(10)->create();
    }
}
