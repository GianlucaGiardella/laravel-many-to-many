<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnologiesTableSeeder extends Seeder
{
    public function run()
    {
        $technologies = [
            [
                'name'  => 'HTML',
            ],
            [
                'name'  => 'CSS',
            ],
            [
                'name'  => 'JAVASCRIPT',
            ],
            [
                'name'  => 'PHP',
            ],
        ];


        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}