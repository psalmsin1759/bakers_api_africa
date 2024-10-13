<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('delivery_methods')->insert([
            [
                'name' => 'Lagos Mainland',
                'description' => 'Delivery within Lagos Mainland',
                'amount' => 3000.00,
                'sort_order' => 1,
                'status' => 1,
                'default_method' => 1, // This is the default method
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lagos Island',
                'description' => 'Delivery within Lagos Island',
                'amount' => 5000.00,
                'sort_order' => 2,
                'status' => 1,
                'default_method' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outside Lagos',
                'description' => 'Delivery outside Lagos',
                'amount' => 7000.00,
                'sort_order' => 3,
                'status' => 1,
                'default_method' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outside Nigeria',
                'description' => 'International delivery',
                'amount' => 10000.00,
                'sort_order' => 4,
                'status' => 1,
                'default_method' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
