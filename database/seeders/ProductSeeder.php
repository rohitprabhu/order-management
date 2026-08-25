<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load product listings from file
        $productListings = include database_path("seeders/data/product_listings.php");

        foreach ($productListings as &$listing) {
            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert product listings
        DB::table('products')->insert($productListings);
        echo 'Products created successfully';
    }
}
