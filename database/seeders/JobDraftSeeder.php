<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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

        DB::table('job_drafts')->insert(
            [
                'id' => 1,
                'job_order_id' => 1,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => 'signed',
                'signature_top_manager' => 'signed',
                'status' => 'completed',
            ],
            [
                'id' => 2,
                'job_order_id' => 1,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => 'pending',
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
            ],
            [
                'id' => 4,
                'job_order_id' => 4,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 5,
                'job_order_id' => 5,
                'type' => 'content_writer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 6,
                'job_order_id' => 1,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 7,
                'job_order_id' => 2,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 8,
                'job_order_id' => 3,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 9,
                'job_order_id' => 4,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ],
            [
                'id' => 10,
                'job_order_id' => 5,
                'type' => 'graphic_designer',
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ]
        );
    }
}
