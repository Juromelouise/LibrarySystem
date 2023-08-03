<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'due_date', 'penalty_fee', 'status'];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
