<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'name' => 'Kotlin',
                'percentage' => 55,
            ],
            [
                'name' => 'XML',
                'percentage' => 89,
            ],
            [
                'name' => 'Jetpack Compose',
                'percentage' => 35,
            ],
            [
                'name' => 'English',
                'percentage' => 32,
            ],
        ];
        foreach ($skills as $skill) {
            Skill::create([
                'name' => $skill['name'],
                'percentage' => $skill['percentage'],
            ]);
        }
    }
}
