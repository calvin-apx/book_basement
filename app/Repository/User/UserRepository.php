<?php
namespace App\Repository\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserInterface{

    /**
     * @author Calvin
     * @param array $data
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function all($data = [])
    {
        return User::with($data)
                    ->get();
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function store($data = [])
    {
        return User::insert($data);
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function storeWidthId($data = [])
    {
        return User::insertGetId($data);
    }

    /**
     * @author Calvin
     * @param mixed $id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find($id)
    {
        return User::where(['user_id' => $id])->first();
    }


}
