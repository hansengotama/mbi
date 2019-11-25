<?php

namespace App\Services;

use App\Exceptions\HttpRequestException;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService implements UserServiceInterface {

    private $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) throw new HttpRequestException(422, $validator->errors(), null);
        if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])) throw new HttpRequestException(422, 'User not Found!', null);

        return 1;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique',
            'birthday_of_data' => 'required|date',
            'phone_number' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8'
        ]);

        if($validator->fails()) throw new HttpRequestException(422, $validator->errors(), null);


    }
}
