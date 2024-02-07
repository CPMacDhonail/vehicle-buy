<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\Vehicle_subcategory;
use Illuminate\Database\Seeder;
use App\Models\Vehicle_category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application database with the top cats,
     * sub cats and vehicles required for basic testing
     */
    public function run(): void
    {
        //create two top level categories
        $carCat = Vehicle_category::factory()->create([
            'name' => 'cars',
        ]);

        $vanCat = Vehicle_category::factory()->create([
            'name' => 'vans',
        ]);

        $carSubs = ['hatchback','saloon','estate'];
        $vanSubs = ['pickup','flatbed','lcv'];

        //create three sub cats in each category, each with 4 associated 'vehicles'
        foreach($carSubs as $sub){
            Vehicle_subcategory::factory()
                ->has(
                    Vehicle::factory()
                        ->count(4)
                )
                ->create(['vehicle_categories_id'=>$carCat->id,'name'=>$sub]);
        }

        foreach($vanSubs as $sub){
            Vehicle_subcategory::factory()
                ->has(
                    Vehicle::factory()
                        ->count(4)
                )
                ->create(['vehicle_categories_id'=>$vanCat->id,'name'=>$sub]);
        }

    }
}
