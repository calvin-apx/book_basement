<?php

namespace App\Traits;

use App\Appointment;
use App\BookDonate;
use App\CartList;
use App\Repository\Appointment\AppointmentRepository;
use App\Repository\CartList\CartListRepository;
use App\Repository\Donate\DonateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

trait CartListTrait {

    /**
     * @author Calvin
     * @param Request $request
     *
     * @return json
     */
    public function store(Request $request)
    {
        Log::info($request);
        DB::beginTransaction();
        try {

            $cartListRepo = (new CartListRepository(new CartList()));

            $dataCondition = [
                'user_id'          =>  $request->user_id,
                'book_id'          =>  $request->book_id
            ];
            $dataCartList = [
                'qty'          =>  $request->cart_qty,
                'status'           =>  $request->status,
                'created_at'       =>  Carbon::now()
            ];



            $cartListRepo->updateOrInsert($dataCondition , $dataCartList);

            DB::commit();

            return json_encode(['success_message' => 'Successfully Added to the Cartlist']);

        }catch(\Exception $e) {
            DB::rollback();
              return json_encode(['error_message' =>$e]);
        }
    }

     /**
     * @author Calvin
     *
     * @return json
     */
    public function data($id)
    {


        try {
            $cartListRepo = (new CartListRepository(new CartList));

            $cartList = $cartListRepo->find(['user_id' => $id])->map(function($data){
                    return array(
                        'cart_list_id' => $data->cart_list_id,
                        'user_id'      => $data->user_id,
                        'book_id'      => $data->book_id,
                        'cart_qty'     => $data->qty,
                        'title'        => $data->title,
                        'sub_title'    => $data->sub_title,
                        'description'  => $data->description,
                        'authors'      => $data->authors,
                        'publisher'    => $data->publisher,
                        'page_count'   => $data->page_count,
                        'rating'       => $data->rating,
                        'genre'        => $data->name,
                        'price'        => $data->book_price,
                        'image_url'    => $data->image_url,
                        'status'       => $data->status,
                    );
                });


                DB::commit();

           return $cartList->toArray();
        }
        catch(\Exception $e){
            DB::rollback();
        }

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

            $cartListRepo = (new CartListRepository(new CartList()));

            $dataCondition = [
                'cart_list_id'  =>  $request->cart_list_id,
            ];

            $cartListRepo->delete($dataCondition);

            DB::commit();

            return json_encode(['success_message' => 'Successfully Delete Item']);

        }catch(\Exception $e) {
            DB::rollback();
              return json_encode(['error_message' =>$e]);
        }
    }



}
