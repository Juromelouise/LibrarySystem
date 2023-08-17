<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Stock extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $fillable = ['book_id','stock'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(200)
        ->height(200)
        ->sharpen(10);
}

}

