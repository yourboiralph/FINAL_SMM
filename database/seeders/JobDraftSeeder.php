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

        for ($i = 1; $i <= 10; $i++) {
            DB::table('job_drafts')->insert([
                'id' => $i,
                'job_order_id' => $faker->numberBetween(1, 5),
                'type' => $faker->randomElement(['content_writer', 'graphic_designer']),
                'date_started' => $faker->date('Y-m-d', 'now'),
                'date_target' => $faker->date('Y-m-d', '+30 days'),
                'signature_admin' => $faker->randomElement([null, 'signed']),
                'signature_top_manager' => $faker->randomElement([null, 'signed']),
                'status' => $faker->randomElement(['completed', 'pending']),
            ]);
        }
    }
}
