<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use HasFactory;


    protected $fillable = ['author_id', 'title', 'date_released'];

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
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows');
    }
}
