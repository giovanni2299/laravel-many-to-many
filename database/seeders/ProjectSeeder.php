<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $types = Type::all();
        $ids = $types->pluck('id')->all();

        //
        DB::table('projects')->truncate();



        for($i =0; $i < 10; $i++){
            $new_project = new Project();
            $title = $faker->sentence(6);
            $new_project->title = $title;
            $new_project->slug = Str::slug($title);
            $new_project->github_link = $faker->url();
            $new_project->description = $faker->text(255);
            $new_project->type_id = $faker->optional()->randomElement($ids);


            $new_project->save();



        }
    }
}
