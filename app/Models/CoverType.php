<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverType extends Model
{
    public $timestamps = false;

    public function bookCard()
    {
        return $this->hasMany(BookCard::class);
    }
}
