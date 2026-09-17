<?php
namespace App\Repository\Donate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateRepository implements DonateInterface{

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


}
