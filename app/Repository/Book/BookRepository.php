<?php

namespace App\Repository\Book;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repository\Book\BookInterface;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookInterface
{

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
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function selectByColumn($data = []){
        return $this->model
                    ->select($data)
                    ->get();
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
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
     * @param mixed $genre_id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getByGenreId($data = [],$genre_id)
    {
        return $this->model
                    ->where('genre_id',$genre_id)
                    ->with($data)
                    ->get();
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
     * @param mixed $column
     * @param mixed $action
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getWithOrderBy($column , $action)
    {
        return $this->model
                    ->orderBy($column,$action)
                    ->get();
    }

    /**
     * @author Calvin
     * @param mixed $column
     * @param mixed $action
     * @param mixed $genre_id
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGenreRecommended($column , $action , $genre_id)
    {
        return $this->model
                    ->where('genre_id_1',$genre_id)
                    ->orWhere('genre_id_2',$genre_id)
                    ->orderBy($column,$action)
                    ->get();
    }

    /**
     * @author Calvin
     * @param array $data
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function store($data = [])
    {
        $this->model->insert($data);
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
     * @param Request $request
     * @param string $category
     *
     * @return String
     */
    public function saveImage(Request $request,$category = "")
    {
        if($request->hasFile('image'))
        {
            //Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filanme
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = time().'.'.$extension;
            //upload image
            if($category == "books"){
                $request->file('image')->storeAs('public/images/books',$fileNameToStore);

            }else{
               $request->file('image')->storeAs('public/images/genres',$fileNameToStore);
            }

            return $fileNameToStore;
        }
    }

}


