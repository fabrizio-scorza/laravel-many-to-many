<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public static function getSlug($name)
    {
        $base_slug = Str::slug($name);
        $slug = $base_slug;

        $n = 1;

        do {
            $find = Technology::where('slug', $slug)->first();

            if ($find !== null) {
                $slug = $base_slug . '-' . $n;
                $n++;
            }
        } while ($find !== null);

        return $slug;
    }
}
