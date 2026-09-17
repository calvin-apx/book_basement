<?php

namespace App;

use App\BookInformation;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    //
    protected $table = 'images';

    protected $primaryKey = 'image_id';

    public function BookInfo(){
        return $this->belongsTo(BookInformation::class,'image_id','image_id');
    }
}
