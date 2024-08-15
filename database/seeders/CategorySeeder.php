<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = config('seeder.categories');

        foreach ($data as $categoryData) {
            $category = DB::table('categories')->insertGetId([
                'name' => $categoryData['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($categoryData['sub_categories'] as $subCategoryData) {
                DB::table('sub_categories')->insert([
                    'category_id' => $category,
                    'name' => $subCategoryData['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
