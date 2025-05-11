<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usastates = [
            'CA' => 'California',
            'TX' => 'Texas',
            'NY' => 'New York',
            'FL' => 'Florida',
            'IL' => 'Illinois',
            'PA' => 'Pennsylvania',
            'OH' => 'Ohio',
            'GA' => 'Georgia',
            'NC' => 'North Carolina',
        ];
        $countries = [
            ['code' => 'usa', 'name' => 'United States', 'states' => json_encode($usastates)],
            ['code' => 'mx', 'name' => 'Mexico', 'states' => null],
            ['code' => 'gb', 'name' => 'United Kingdom', 'states' => json_encode(['ENG' => 'England', 'SCT' => 'Scotland'])],
            ['code' => 'CA', 'name' => 'Canada', 'states' => null],
            // Add more countries as needed
        ];

        \App\Models\Country::insert($countries);
    }
}
