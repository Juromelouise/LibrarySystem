<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Author extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    //$timestamps = false;
    protected $fillable = ['name', 'gender', 'age'];

    public function books()
{
    return $this->hasMany(Book::class);
}
public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(200)
        ->height(200)
        ->sharpen(10);
}

}


