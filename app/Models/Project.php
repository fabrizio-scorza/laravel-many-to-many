<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'name', 'slug', 'description', 'link'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public static function getSlug($name)
    {
        $base_slug = Str::slug($name);
        $slug = $base_slug;

        $n = 1;

        do {
            $find = Project::where('slug', $slug)->first();

            if ($find !== null) {
                $slug = $base_slug . '-' . $n;
                $n++;
            }
        } while ($find !== null);

        return $slug;
    }
}
