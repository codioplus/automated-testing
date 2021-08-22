<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [

            [
                'product_code' => "FR1",
                'price' => "3.11",
                'name' => "Fruit tea",
                'description' => "description for product"
            ],
            [
                'product_code' => "SR1",
                'price' => "5.00",
                'name' => "Strawberries",
                'description' => "description for product"
            ],

            [
                'product_code' => "CF1",
                'price' => "11.23",
                'name' => "Coffee",
                'description' => "description for product"
            ]

        ];

        Product::insert($products);
    }
}
