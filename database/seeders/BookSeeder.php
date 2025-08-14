<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $faker = Faker::create();
        $now = Carbon::now();
        $batchSize = 10000;
        $total = 100000;
        $data = [];

        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'author_id' => rand(1, 1000),
                'category_id' => rand(1, 3000),
                'title' => $faker->sentence(rand(2, 5)), // random 2-5 kata
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($i % $batchSize === 0) {
                DB::table('books')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('books')->insert($data);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
