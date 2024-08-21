<?php

namespace Database\Seeders;

use App\Models\Faqs\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('faqs.questions');

        foreach ($data as $questions) {
            Question::create($questions);
        }
    }
}
