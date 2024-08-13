<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus consequatur officia obcaecati.',
            'status' => 'done'

        ]);
    }
}
