<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_orders')->insert([
            [
                'id' => 1,
                'title' => 'content',
                'description' => 'create 16 ideas',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 2,
                'title' => 'valentines',
                'description' => '16 valentines ideas',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 3,
                'title' => 'summer campaign',
                'description' => 'plan summer marketing ideas',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 4,
                'title' => 'product launch',
                'description' => 'create product launch materials',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 5,
                'title' => 'social media posts',
                'description' => 'generate weekly posts',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 6,
                'title' => 'holiday greetings',
                'description' => 'design holiday greeting cards',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 7,
                'title' => 'blog updates',
                'description' => 'write and edit blog articles',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 8,
                'title' => 'email newsletter',
                'description' => 'draft weekly newsletters',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 9,
                'title' => 'event promotion',
                'description' => 'create promotional materials for events',
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 10,
                'title' => 'case study',
                'description' => 'write case studies for clients',
                'issued_by' => 3,
                'renewable' => true,
            ],
        ]);
    }
}
