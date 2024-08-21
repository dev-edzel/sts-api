<?php

namespace Database\Seeders;

use App\Models\Faqs\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('faqs.answers');

        foreach ($data as $answers) {
            Answer::create($answers);
        }
    }
}
