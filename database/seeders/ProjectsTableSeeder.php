<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Function\Helper;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++){
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->name = $faker->sentence();
            $new_project->slug = Helper::generateSlug($new_project->name, Project::class);
            $new_project->description = $faker->paragraph();
            $new_project->creation_date = $faker->date();

            $new_project->save();
        }
    }
}
