<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'slug_fa'];
    public function getRouteKeyName()
    {
        return 'Slug';
    }
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug_fa' =>['source'=>'title']
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
