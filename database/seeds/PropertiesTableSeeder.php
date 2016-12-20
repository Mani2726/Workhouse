<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->delete();

        \App\Property::create([
            'name' => 'The Victoria',
            'price' => '374662',
            'bedrooms' => 4,
            'bathrooms' => 2,
            'storeys' => 2,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Xavier',
            'price' => '513268',
            'bedrooms' => 4,
            'bathrooms' => 2,
            'storeys' => 1,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Como',
            'price' => '454990',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'storeys' => 2,
            'Garages' => 3,
        ]);

        \App\Property::create([
            'name' => 'The Aspen',
            'price' => '384356',
            'bedrooms' => 4,
            'bathrooms' => 2,
            'storeys' => 2,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Lucretia',
            'price' => '572002',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'storeys' => 2,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Toorak',
            'price' => '521951',
            'bedrooms' => 5,
            'bathrooms' => 2,
            'storeys' => 1,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Skyscape',
            'price' => '263604',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'storeys' => 2,
            'Garages' => 2,
        ]);

        \App\Property::create([
            'name' => 'The Clifton',
            'price' => '386103',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'storeys' => 1,
            'Garages' => 1,
        ]);

        \App\Property::create([
            'name' => 'The Geneva',
            'price' => '390600',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'storeys' => 2,
            'Garages' => 2,
        ]);
    }
}
