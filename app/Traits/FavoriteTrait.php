<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Repository\Favorite\FavoriteRepository;
use App\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

trait FavoriteTrait {


    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $favoriteRepo = (new FavoriteRepository(new Favorite));
            $condition = array(
                'user_id'       =>  $request->user_id,
                'book_id'       =>  $request->book_id
            );
            $data = array(
                'status'        =>  $request->status,
                'created_at'    =>  Carbon::now()
            );

            $favoriteRepo->updateOrInsert($condition , $data);

            DB::commit();

            return json_encode(['success_message' => 'Successfully Added']);

        }catch(\Exception $ex){
            DB::rollBack();
            return json_encode(['error_message' =>$ex]);
        }

    }

     /**
     * @author Calvin
     * @param mixed $user_id
     *
     * @return Collection
     */
    public function data($user_id)
    {
        $favoriteRepo = new FavoriteRepository(new Favorite());
        return $favoriteRepo->getByUserId(['user_id' => $user_id])->map(function($data){
            return array(
                'favorite_id'     =>  $data->favorite_id,
                'user_id'         =>  $data->user_id,
                'book_id'         =>  $data->book_id,
                'title'           =>  $data->title,
                'sub_title'       =>  $data->sub_title,
                'description'     =>  $data->description,
                'authors'         =>  $data->authors,
                'publisher'       =>  $data->publisher,
                'page_count'      =>  $data->page_count,
                'rating'          =>  $data->rating,
                'genre'           =>  $data->name,
                'image_url'       =>  $data->image_url,
                'price'           =>  $data->book_price,
                'qty'             =>  $data->book_qty,
                'status'          =>  $data->status,
            );
        });
    }

    /**
     * @author Calvin
     * @param Request $request
     *
     * @return json
     */
    public function remove(Request $request)
    {
        DB::beginTransaction();
        try {

            $favoriteRepo = (new FavoriteRepository(new Favorite()));

            $dataCondition = [
                'favorite_id'  =>  $request->favorite_id,
            ];

            $favoriteRepo->delete($dataCondition);

            DB::commit();

            return json_encode(['success_message' => 'Successfully Delete Item']);

        }catch(\Exception $e) {
            DB::rollback();
              return json_encode(['error_message' =>$e]);
        }
    }

}
