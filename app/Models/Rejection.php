<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    use HasFactory;

    public $timestamps = true;

    const CREATED_AT = 'rejected_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'rejected_by',
        'book_card_id',
        'reason',
    ];

    public function bookCard()
    {
        return $this->belongsTo(BookCard::class);
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
