<?php
namespace App\Repository\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppointmentRepository implements AppointmentInterface{

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
        return $this->model->insert($data);
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
     * @param mixed $id
     * @param array $payload
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findById($id , $payload = [])
    {
        return $this->model
                    ->with($payload)
                    ->find($id);
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
        return $this->model->where($where)
                    ->update($data);
    }


    /**
     * @param array $where
     * @param array $payload
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId($where = [], $payload = [])
    {
        return $this->model
                ->with($payload)
                ->where($where)
                ->orderBy('created_at','desc')
                ->get();
    }


}
