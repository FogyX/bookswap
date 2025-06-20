<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCard extends Model
{
    use HasFactory;

    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'author',
        'title',
        'card_type_id',
        'status_id',
        'publisher',
        'publication_year',
        'cover_type_id',
        'book_condition_id',
    ];

    protected $casts = [
        'publication_year' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function coverType()
    {
        return $this->belongsTo(CoverType::class);
    }

    public function bookCondition()
    {
        return $this->belongsTo(BookCondition::class);
    }

    public function rejection()
    {
        return $this->hasOne(Rejection::class);
    }
}
