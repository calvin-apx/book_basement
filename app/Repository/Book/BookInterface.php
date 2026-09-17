<?php

namespace App\Repository\Book;
use Illuminate\Http\Request;
interface BookInterface
{

    /**
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($data = []);

    /**
     * @param array $data
     * @param mixed $genre_id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByGenreId($data = [],$genre_id);

    /**
     * @param mixed $id
     * @param array $payload
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function findById($id , $payload = []);

    /**
     * @param array $data
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function selectByColumn($data = []);

    /**
     * @param Request $request
     * @param string $category
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function saveImage(Request $request,$category = "");

    /**
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function storeWidthId($data = []);

    /**
     * @param mixed $column
     * @param mixed $action
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getWithOrderBy($column , $action);

    /**
     * @param mixed $column
     * @param mixed $action
     * @param mixed $genre_id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGenreRecommended($column , $action , $genre_id);

    /**
     * @param array $data
     * @param mixed $where
     *
     * @return Illuminate\Database\Eloquent\Collection
     * @return boolean
     */
    public function update($data = [],$where);

    /**
     * @param mixed $where
     *
     * @return boolean
     */
    public function delete($where);

}
