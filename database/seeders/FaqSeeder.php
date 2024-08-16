<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('seeder.faqs');

        foreach ($data as $faq) {
            // Check if the 'answer' field is an array, and if so, encode it as JSON
            if (is_array($faq['answers'])) {
                $faq['answers'] = json_encode($faq['answers']);
            } else {
                // If it's not an array, wrap it in an array and then encode
                $faq['answers'] = json_encode([$faq['answers']]);
            }
            // Create the FAQ entry in the database
            Faqs::create($faq);
        }
    }
}
