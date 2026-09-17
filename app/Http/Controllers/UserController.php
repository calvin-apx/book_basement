<?php

namespace App\Http\Controllers;

use App\Repository\User\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function register(Request $request){
        Log::info($request);
        DB::beginTransaction();
        try {

            $userRepo = new UserRepository(new User());
            $data = [
                'name'       => $request->name,
                'password'   => Hash::make($request->password),
                'email'      => $request->email,
                'birth_date' => Carbon::parse(strtotime($request->birth_date)),
                'gender'     => $request->gender,
                'phone'      => $request->phone,
                'status'     => 'AC',
                'type'       => 'user'
            ];
            $id = $userRepo->storeWidthId($data);
            Log::info($userRepo->find($id)->toArray());

            DB::commit();

            return response()->json($userRepo->find($id)->toArray() , 200);

        }catch(\Exception $e) {
            DB::rollback();
              return response()->json(['error_message' =>$e] , 404);
        }
    }
    public function checkUser(Request $request){
        Log::info($request);
        DB::beginTransaction();
        try {

            if (Auth::attempt(array('email' => $request->email, 'password' => $request->password)))
            {
                $userRepo = new UserRepository(new User());
                return response()->json($userRepo->find(Auth::user()->user_id)->toArray() , 200);
            }else{
                return response()->json(["error_message" => [ "errorInfo" => ["error" ,"error" ,"Invalid username or password"]]], 404);
            }

            DB::commit();


        }catch(\Exception $e) {
            DB::rollback();
              return response()->json(['error_message' =>$e] , 404);
        }
    }
}
