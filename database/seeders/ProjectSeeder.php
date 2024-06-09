<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $types = Type::all();
        $type_ids = $types->pluck('id')->all();

        $technologies_ids = Technology::all()->pluck('id')->all();
        //
        for ($i = 0; $i < 20; $i++) {

            $project = new Project();

            $name = $faker->sentence(5);

            $project->name = $name;
            $project->slug = Str::slug($name);
            $project->description = $faker->optional()->text(250);
            $project->link = $faker->url();
            $project->type_id = $faker->randomElement($type_ids);

            $project->save();

            $project->technologies()->attach($faker->randomElements($technologies_ids, null));
        }
    }
}
