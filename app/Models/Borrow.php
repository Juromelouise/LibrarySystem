<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'due_date', 'penalty_fee', 'status'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_borrow', 'borrow_id', 'book_id', 'id', 'id')->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
