<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Carbon\Carbon;
use GuzzleHttp\Client;
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

    private function modelMapping(array $request) {
        $formData = [];
        $formData['name'] = $request['name'];
        $formData['email'] = $request['email'];
        $formData['role'] = (isset($request['role'])) ? $request['role'] : "user";
        $formData['birth_of_date'] = Carbon::parse($request['birth_of_date'])->format('Y-m-d H:i:s');
        $formData['phone_number'] = $request['phone_number'];
        $formData['password'] = $request['password'];

        return $formData;
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
                $user = $request->user();
                $user['access_token'] = $user->createToken('Personal Access Token')->accessToken;

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'Login Success',
                    'data' => $user
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
            'birth_of_date' => 'required|date',
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
            $formData = $this->modelMapping($request->all());
            $data = $this->userRepository->create($formData);

            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'User Created',
                'data' => $data
            ];
        }

        return $response;
    }

    public function get(Request $request)
    {
        $filter = $request->filter;

        $text = ($filter['text'] == null) ? "" : $filter['text'];
        $page = ($filter['page'] == null) ? 1 : (int)$filter['page'];
        $per_page = ($filter['per_page'] == null) ? 10 : (int)$filter['per_page'];

        $data = $this->userRepository->get($text, $page, $per_page);

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
            'birth_of_date' => 'required|date',
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
                $formData = $this->modelMapping($request->all());
                $data = $this->userRepository->update($id, $formData);

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
