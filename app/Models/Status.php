<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    public function bookCard()
    {
        return $this->hasMany(BookCard::class);
    }
}
