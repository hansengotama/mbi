<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class UserService implements UserServiceInterface
{

    private $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ];
        }else {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                $response = [
                    'success' => false,
                    'code' => 404,
                    'message' => 'User not Found!',
                    'data' => null
                ];
            }else {
                $user = Auth::user();

                $response = [
                    'success' => false,
                    'code' => 200,
                    'message' => 'Login Success',
                    'data' => null
                ];
            }
        }

        return $response;
    }

    public function create(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'birthday_of_date' => 'required|date',
            'phone_number' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()
            ];
        } else {
            $data = $this->userRepository->create($request->all());

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'User Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function get()
    {
        $data = $this->userRepository->get();

        return [
            'success' => true,
            'code' => 200,
            'message' => 'Get User',
            'data' => $data
        ];
    }

    public function update(int $id, Request $request)
    {
        $response = [];
        $user = $this->userRepository->find($id);

        $validate = [
            'name' => 'required',
            'birthday_of_date' => 'required|date',
            'phone_number' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8'
        ];

        if($user != null) {
            if ($user->email != $request->email)
                $validate = array_merge($validate, ['email' => 'required|email|unique:users']);
            else
                $validate = array_merge($validate, ['email' => 'required|email']);

            $validator = Validator::make($request->all(), $validate);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()
                ];
            } else {
                $data = $this->userRepository->update($id, $request->all());

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'User Updated',
                    'data' => $data
                ];
            }
        }else {
            $response = [
                'success' => false,
                'code' => 404,
                'message' => 'User Not Found',
                'data' => null
            ];
        }


        return $response;
    }

    public function find(int $id)
    {
        $data = $this->userRepository->find($id);
        $message = 'User Found';
        $code = 200;

        if ($data == null) {
            $message = 'User not Found';
            $code = 404;
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }

    public function delete(int $id)
    {
        $user = $this->userRepository->find($id);
        $data = null;
        $message = 'User Deleted';
        $code = 200;

        if($user == null) {
            $message = 'User not Found';
            $code = 404;
        }else {
            $data = $this->userRepository->delete($id);
        }

        return [
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}
