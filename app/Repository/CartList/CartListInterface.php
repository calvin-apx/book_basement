<?php
namespace App\Repository\CartList;
use Illuminate\Http\Request;

interface CartListInterface{

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

     /**
     * @param array $condition
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function updateOrInsert($condition = [] , $data = []);

     /**
     * @author Calvin
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getList();


    /**
     * @author Calvin
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function delete($where);

     /**
     * @author Calvin
     *
     * @param array $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find($where = []);

}
