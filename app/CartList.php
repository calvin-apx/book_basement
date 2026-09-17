<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartList extends Model
{
    //
    protected $table = 'cart_list';

    protected $primaryKey = 'cart_list_id';

    public function book()
    {
        return $this->hasOne(BookInformation::class,'book_id','book_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

}
