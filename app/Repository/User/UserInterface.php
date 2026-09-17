<?php
namespace App\Repository\User;
use Illuminate\Http\Request;

interface UserInterface{

    /**
     * @author Calvin
     * Select data from database
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($data = []);


    /**
     * @author Calvin
     * Store data to the database
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function store($data = []);

    /**
     * @author Calvin
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function storeWidthId($data = []);

    /**
     * @author Calvin
     * @param mixed $id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find($id);

}
