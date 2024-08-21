<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MerchantSeeder::class,
            CategorySeeder::class,
            StatusSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
