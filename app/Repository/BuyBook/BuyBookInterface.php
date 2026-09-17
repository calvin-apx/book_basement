<?php
namespace App\Repository\BuyBook;
use Illuminate\Http\Request;

interface BuyBookInterface{

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
     * @param array $data
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function update($data = [],$where);

}
