<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = ['HTML', 'CSS', 'JS', 'Vue', 'Vite', 'PHP', 'Laravel'];

        foreach ($types as $type) {
            $new_type = new Technology();
            $new_type->name = $type;
            $new_type->slug = Str::slug($type);

            $new_type->save();
        }
    }
}
