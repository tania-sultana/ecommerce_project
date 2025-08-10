<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
class Product extends Model
{
    use HasFactory;
    use Sluggable;

    public function Sluggable():array
    {
        return
        [
            'slug'=>
            [
                'source' => 'title'
            ]
            ];
    }

}
