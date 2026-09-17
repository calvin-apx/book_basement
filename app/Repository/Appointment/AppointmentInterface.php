<?php
namespace App\Repository\Appointment;
use Illuminate\Http\Request;

interface AppointmentInterface{

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
     * @param array $payload
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findById($id , $payload = []);

    /**
     * @author Calvin
     * @param array $data
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function update($data = [],$where);

    /**
     * @param array $where
     * @param array $payload
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByUserId($where = [], $payload = []);

}
