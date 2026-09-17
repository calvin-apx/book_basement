<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    //
    protected $table = 'book_genre';

    protected $primaryKey = 'genre_id';
}
