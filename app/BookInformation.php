<?php

namespace App;

use App\AdminInventory;
use App\Images;
use App\BookGenre;
use Illuminate\Database\Eloquent\Model;

class BookInformation extends Model
{
    //
    protected $table = 'book_information';

    protected $primaryKey = 'book_id';

    public function adminInventory()
    {
        return $this->hasOne(AdminInventory::class,'book_id','book_id');
    }

    public function images()
    {
        return $this->hasOne(Images::class,'image_id','image_id');
    }

    public function genres()
    {
        return $this->hasOne(BookGenre::class,'genre_id','genre_id');
    }
}
