<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $technologies = ['css','js','laravel','php','vue','vite'];

        foreach($technologies as $technology_name){
            $new_technology = new Technology();
            $new_technology->name = $technology_name;
            $new_technology->slug = Str::slug($technology_name);

            $new_technology->save();
        }
    }
}
