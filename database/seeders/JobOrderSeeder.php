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
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 2,
                'title' => 'valentines',
                'description' => '16 valentines ideas',
                'content_writer_id' => 6,
                'graphic_designer_id' => 7,
                'client_id' => 2,
                'issued_by' => 4,
                'renewable' => true,
            ],
            [
                'id' => 3,
                'title' => 'summer campaign',
                'description' => 'plan summer marketing ideas',
                'content_writer_id' => 5,
                'graphic_designer_id' => 7,
                'client_id' => 1,
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 4,
                'title' => 'product launch',
                'description' => 'create product launch materials',
                'content_writer_id' => 6,
                'graphic_designer_id' => 8,
                'client_id' => 2,
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 5,
                'title' => 'social media posts',
                'description' => 'generate weekly posts',
                'content_writer_id' => 5,
                'graphic_designer_id' => 7,
                'client_id' => 1,
                'issued_by' => 4,
                'renewable' => true,
            ],
            [
                'id' => 6,
                'title' => 'holiday greetings',
                'description' => 'design holiday greeting cards',
                'content_writer_id' => 6,
                'graphic_designer_id' => 7,
                'client_id' => 2,
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 7,
                'title' => 'blog updates',
                'description' => 'write and edit blog articles',
                'content_writer_id' => 5,
                'graphic_designer_id' => 7,
                'client_id' => 1,
                'issued_by' => 4,
                'renewable' => true,
            ],
            [
                'id' => 8,
                'title' => 'email newsletter',
                'description' => 'draft weekly newsletters',
                'content_writer_id' => 6,
                'graphic_designer_id' => 7,
                'client_id' => 2,
                'issued_by' => 3,
                'renewable' => true,
            ],
            [
                'id' => 9,
                'title' => 'event promotion',
                'description' => 'create promotional materials for events',
                'content_writer_id' => 6,
                'graphic_designer_id' => 8,
                'client_id' => 1,
                'issued_by' => 4,
                'renewable' => true,
            ],
            [
                'id' => 10,
                'title' => 'case study',
                'description' => 'write case studies for clients',
                'content_writer_id' => 5,
                'graphic_designer_id' => 7,
                'client_id' => 1,
                'issued_by' => 3,
                'renewable' => true,
            ],
        ]);
    }
}
