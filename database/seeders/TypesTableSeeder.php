<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $types = [
            [
                'name'          => 'No Type',
                'description'   => 'This Project doesn\'t have a type',
            ],
            [
                'name'          => 'Front-End',
                'description'   => $faker->words(rand(20, 40), true),
            ],
            [
                'name'          => 'Back-End',
                'description'   => $faker->words(rand(20, 40), true),
            ],
            [
                'name'          => 'Full Stack',
                'description'   => $faker->words(rand(20, 40), true),
            ]
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}