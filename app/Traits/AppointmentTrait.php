<?php

namespace App\Traits;

use App\Appointment;
use App\BookDonate;
use App\CartList;
use App\Repository\Appointment\AppointmentRepository;
use App\Repository\Donate\DonateRepository;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;
use App\Repository\BuyBook\BuyBookRepository;
use App\Repository\CartList\CartListRepository;
use App\UserBookBuyer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

trait AppointmentTrait {


    /**
     * @author Calvin
     * @return [type]
     */
    public function index()
    {
        $appointmentRepo = (new AppointmentRepository(new Appointment()));
        $appointments = $appointmentRepo->all(['donate','user']);

        return view('bookbasement.appointments.list',compact('appointments'));
    }


    /**
     * @author Calvin
     * @param AppointmentRequest $request
     *
     * @return json
     */
    public function donateStore(AppointmentRequest $request)
    {

        DB::beginTransaction();
        try {
            $appointmentRepo = (new AppointmentRepository(new Appointment()));
            $donateRepo = (new DonateRepository(new BookDonate()));
            $dataAppointment = array(
                'user_id'          =>  $request->user_id,
                'location'         =>  $request->location,
                'meetup_datetime'  =>  Carbon::parse(strtotime($request->date.' '.$request->time)),
                'purpose'          =>  $request->purpose,
                'status'           =>  $request->status,
                'created_at'       =>  Carbon::now()
            );

            $appointment_id = $appointmentRepo->storeWidthId($dataAppointment);

            $dataDonate = array(
                'qty'             =>  $request->qty,
                'appointment_id'  =>  $appointment_id,
                'status'          =>  $request->status,
                'created_at'   =>  Carbon::now()
            );
            $donateRepo->store($dataDonate);


            DB::commit();

            return json_encode(['success_message' => 'Successfully Added to the Appointment']);

        }catch(\Exception $e) {
            DB::rollback();
              return json_encode(['error_message' =>$e]);
        }
    }

     /**
     * @author Calvin
     * @param AppointmentRequest $request
     *
     * @return json
     */
    public function buyStore(AppointmentRequest $request)
    {

        DB::beginTransaction();
        try {
            $appointmentRepo = (new AppointmentRepository(new Appointment()));
            $buyRepo         = (new BuyBookRepository(new UserBookBuyer()));
            $cartListRepo    = (new CartListRepository(new CartList()));

            $dataAppointment = array(
                'user_id'          =>  $request->user_id,
                'location'         =>  $request->location,
                'meetup_datetime'  =>  Carbon::parse(strtotime($request->date.' '.$request->time)),
                'purpose'          =>  $request->purpose,
                'status'           =>  $request->status,
                'created_at'       =>  Carbon::now()
            );

            $appointment_id = $appointmentRepo->storeWidthId($dataAppointment);

            $cartList = $cartListRepo->find(['user_id' => $request->user_id]);

            $dataBuyBook = [];
            foreach($cartList as $list){
                $dataBuyBook[] = [
                   'appointment_id' => $appointment_id,
                   'book_id'        => $list->book_id,
                   'qty'            => $list->qty,
                   'price'          => $list->book_price,
                   'total'          => $list->book_price * $list->qty,
                   'status'         => $request->status
                ];
            }

            $buyRepo->store($dataBuyBook);

            $cartListRepo->delete(['user_id' => $request->user_id]);

            DB::commit();

            return json_encode(['success_message' => 'Successfully Added to the Appointment']);

        }catch(\Exception $e) {
            DB::rollback();
              return json_encode(['error_message' =>$e]);
        }
    }

    /**
     * @author Calvin
     * @param mixed $id
     *
     * @return Collection
     */
    public function find($id)
    {
        $appointmentRepo = new AppointmentRepository(new Appointment());
        return  $appointmentRepo->findById($id,['donate','user','buy']);
    }



    /**
     * @author Calvin
     * @param Request $request
     *
     * @return String
     */
    public function cancel(Request $request)
    {
        DB::beginTransaction();
        try {

            $appointments = $this->find($request->id);

            $appointmenRepo = (new AppointmentRepository(new Appointment()));
            $donateRepo     = (new DonateRepository(new BookDonate()));
            $buyRepo        = (new BuyBookRepository(new UserBookBuyer()));

            $updateStatus = array('status' => 'cancel');


            $appointmenRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);
            $donateRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);
            $buyRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);

            DB::commit();

            return back()->with('success','Successfully Updated');

        }catch(\Exception $e){
            DB::rollback();
        }

    }

    /**
     * @author Calvin
     * @param Request $request
     *
     * @return String
     */
    public function done(Request $request)
    {

        DB::beginTransaction();
        try {

            $appointments = $this->find($request->id);

            $appointmenRepo = (new AppointmentRepository(new Appointment()));
            $donateRepo = (new DonateRepository(new BookDonate()));
            $buyRepo        = (new BuyBookRepository(new UserBookBuyer()));

            $updateStatus = array('status' => 'done');


            $appointmenRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);
            $donateRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);
            $buyRepo->update($updateStatus,['appointment_id' => $appointments->appointment_id]);

            DB::commit();

            return back()->with('success','Successfully Updated');

        }catch(\Exception $e){
            DB::rollback();
        }
    }

    /**
     * @author Calvin
     * @param mixed $user_id
     *
     * @return Collection
     */
    public function data($user_id){
        $appointmentRepo = new AppointmentRepository(new Appointment());
        return $appointmentRepo->getByUserId(['user_id' => $user_id],['donate','user','buy'])->map(function($data){
            return array(
                'appointment_id'  =>  $data->appointment_id,
                'user_id'         =>  $data->user_id,
                'location'        =>  $data->location,
                'date'            =>  Carbon::parse(strtotime($data->date))->format('Y-m-d'),
                'time'            =>  Carbon::parse(strtotime($data->date))->format('h:i:s'),
                'purpose'         =>  $data->purpose,
                'status'          =>  $data->status,

            );
        });;
    }



}
