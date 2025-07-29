<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('events')->insert([
        //     [
        //         'title' => 'Event One',
        //         'description' => 'Description for event one.',
        //         'start_day' => Carbon::create('2024', '11', '15'),
        //         'end_day' => Carbon::create('2024', '11', '20'),
        //         'location' => 'Northern Idaho',
        //         'featured_image' => 'https://placehold.co/600x400', 
        //     ],
        //     [
        //         'title' => 'Event Two',
        //         'description' => 'Description for event two.',
        //         'start_day' => Carbon::create('2024', '12', '01'),
        //         'end_day' => Carbon::create('2024', '12', '05'),
        //         'location' => 'Southern Idaho',
        //         'featured_image' => 'https://placehold.co/600x400', 
        //     ],
        //     [
        //         'title' => 'Event Three',
        //         'description' => 'Description for event three.',
        //         'start_day' => Carbon::create('2025', '01', '10'),
        //         'end_day' => Carbon::create('2025', '01', '15'),
        //         'location' => 'Boise, Idaho',
        //         'featured_image' => 'https://placehold.co/600x400', 
        //     ],
        // ]);
    }
}
