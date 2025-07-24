<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name', 'description', 'genre', 'release_date'
    ];

    public function images()
    {
        return $this->hasMany(GameImage::class);
    }
}

