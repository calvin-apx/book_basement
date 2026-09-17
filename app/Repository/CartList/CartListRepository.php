<?php
namespace App\Repository\CartList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartListRepository implements CartListInterface{

    /**
     * @author Calvin
     * @var Model
     */
    protected $model;

    /**
     * @author Calvin
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function all($data = [])
    {
        return $this->model
                    ->with($data)
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
        $this->model->insert($data);
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function storeWidthId($data = [])
    {
        return $this->model->insertGetId($data);
    }

     /**
     * @author Calvin
     * @param array $data
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function update($data = [],$where)
    {
        $this->model->where($where)
                    ->update($data);
    }


    /**
     * @author Calvin
     * @param array $condition
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function updateOrInsert($condition = [] , $data = [])
    {
        $this->model->updateOrInsert($condition , $data);
    }


    /**
     * @author Calvin
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
       return $this->model->distinct()->leftJoin('book_information',function($join){
            $join->on('cart_list.book_id','=','book_information.book_id');
        })->leftJoin('book_genre',function($join){
            $join->on('book_information.genre_id','=','book_genre.genre_id');
        })->leftJoin('images',function($join){
            $join->on('book_information.image_id','=','images.image_id');
        })->leftJoin('admin_book_inventory',function($join){
            $join->on('book_information.book_id','=','admin_book_inventory.book_id');
        })->get();
    }

    /**
     * @author Calvin
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function delete($where)
    {
        return $this->model->where($where)->delete();
    }

    /**
     * @author Calvin
     *
     * @param array $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function find($where = [])
    {
       return $this->model->distinct()->leftJoin('book_information',function($join){
            $join->on('cart_list.book_id','=','book_information.book_id');
        })->leftJoin('book_genre',function($join){
            $join->on('book_information.genre_id','=','book_genre.genre_id');
        })->leftJoin('images',function($join){
            $join->on('book_information.image_id','=','images.image_id');
        })->leftJoin('admin_book_inventory',function($join){
            $join->on('book_information.book_id','=','admin_book_inventory.book_id');
        })->where($where)->get();
    }


}
