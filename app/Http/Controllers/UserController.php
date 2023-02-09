<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends HandleController
{
    public function login(Request $request)
    {
        $uspesno = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($uspesno){
            $authUser = Auth::user();
            $response['name'] =  $authUser->name;
            $response['token'] =  $authUser->createToken('Token')->plainTextToken;

            return $this->success($response, 'Uspesno ste se logovali.');
        }
        else{
            return $this->error('Autentifikacija neuspesna.', ['error'=>'Greska pri podacima za logovanje']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->error('Greska pri validaciji', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $response['name'] =  $user->name;
        return $this->success($response, 'Uspesno napravljen korisnik.');
    }
}
