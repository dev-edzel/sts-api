<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = config('seeder.ticket_types');

        foreach ($data as $ticketType) {
            TicketType::create($ticketType);
        }
    }
}
