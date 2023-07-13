<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $types = Type::all()->except(1);
        $technolgies = Technology::all()->pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->words(rand(2, 8), true);
            $slug = Project::slugger($title);

            $project = Project::create([
                'type_id'       => $faker->randomElement($types)->id,
                'title'         => $title,
                'slug'          => $slug,
                'author'        => 'Gianluca Giardella',
                'github_url'    => 'https://github.com/GianlucaGiardella/' . $slug,
                'description'   => $faker->paragraphs(rand(2, 20), true),
            ]);

            $project->technologies()->sync($faker->randomElements($technolgies, null));
        }
    }
}