<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $now = Carbon::now();
        $batchSize = 10000;
        $total = 500000;
        $data = [];

        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'book_id' => rand(1, 100000),
                'rating' => rand(3, 9),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($i % $batchSize === 0) {
                DB::table('ratings')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('ratings')->insert($data);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
