<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Laravel\SerializableClosure\Serializers\Signed;

class JobDraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('job_drafts')->insert([
            [
                'id' => 1,
                'job_order_id' => 1,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 2,
                'job_order_id' => 1,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => null,
                'signature_top_manager' => null,
                'status' => 'pending',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 3,
                'job_order_id' => 2,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => null,
                'signature_top_manager' => null,
                'status' => 'pending',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 4,
                'job_order_id' => 3,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 5,
                'job_order_id' => 3,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 6,
                'job_order_id' => 3,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => null,
                'signature_top_manager' => null,
                'status' => 'pending',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 7,
                'job_order_id' => 4,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 8,
                'job_order_id' => 4,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 9,
                'job_order_id' => 4,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ],
            [
                'id' => 10,
                'job_order_id' => 4,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
                'content_writer_id' => 5,
                'graphic_designer_id' => 8,
                'client_id' => 1,
            ]
        ]);
    }
}
