<?php

namespace App;

use App\BookDonate;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';



    public function donate()
    {
        return $this->hasOne(BookDonate::class,'appointment_id','appointment_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public function buy()
    {
        return $this->hasOne(UserBookBuyer::class,'appointment_id','appointment_id');
    }

}
