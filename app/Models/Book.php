<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Book extends Model implements HasMedia, Searchable
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = ['author_id', 'title', 'date_released'];
    // protected $table = "books";

    public function borrows()
    {
        return $this->belongsToMany(Borrow::class)->withPivot('quantity');
    }

    public static function boot()
    {
        parent::boot();

        static::restored(function ($book) {
            $book->borrows()->withTrashed()->update(['due_date' => null]);
        });
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'borrows');
    // }
    public function getSearchResult(): SearchResult
    {
       $url = route('moreinfo', $this->id);

        return new SearchResult(
           $this,
           $this->title,
           $url
        );
    }
}
