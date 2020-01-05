<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;

class UserController extends Controller
{

    private $userService;

    function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    private function checkUserNull(int $id)
    {
        $data = $this->userService->find($id);

        if ($data == null) return true;
        else return false;
    }

    private function responseUserNull()
    {
        return [
            'message' => 'User not Found',
            'code' => 404,
            'data' => null,
            'success' => false
        ];
    }

    public function login(Request $request)
    {
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
                    'message' => 'Unauthorized',
                    'code' => 401,
                    'data' => null,
                    'success' => false
                ];
            } else {
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

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function logout()
    {
        if (Auth::check())
            Auth::user()->OauthAccessToken()->delete();

        return api_response(true, 200, 'User Logout', null);
    }

    public function create(Request $request)
    {
        $validate = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'birth_of_date' => 'required|date',
            'phone_number' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8',
        ];

        if(isset($request->district_id)) $validate = array_merge($validate, ['district_id' => 'exists:districts,id']);
        if(isset($request->region_id)) $validate = array_merge($validate, ['region_id' => 'exists:regions,id']);

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        } else {
            $tempData = [];
            $tempData['name'] = $request->name;
            $tempData['email'] = $request->email;
            $tempData['role'] = $request->role;
            $tempData['birth_of_date'] = $request->birth_of_date;
            $tempData['phone_number'] = $request->phone_number;
            $tempData['password'] = Hash::make($request->password);
            $tempData['district_id'] = (!isset($request->district_id)) ? null : $request->district_id;
            $tempData['region_id'] = (!isset($request->region_id)) ? null : $request->region_id;

            $data = $this->userService->create($tempData);
            $response = [
                'success' => true,
                'code' => 200,
                'message' => 'User Created',
                'data' => $data
            ];
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function get(Request $request)
    {
        $data = $this->userService->get($request);

        return api_response(true, 200, 'Get User', $data);
    }

    public function find($id)
    {
        $id = intval($id);

        $checkUserNull = $this->checkUserNull($id);
        if($checkUserNull) return $this->responseUserNull();
        else {
            $data = $this->userService->find($id);

            return api_response(true, 200, 'User Found', $data);
        }
    }

    public function update($id, Request $request)
    {
        $id = intval($id);

        $checkUserNull = $this->checkUserNull($id);
        if($checkUserNull) return $this->responseUserNull();
        else {
            $user = $this->userService->find($id);
            $validate = [
                'name' => 'required',
                'birth_of_date' => 'required|date',
                'phone_number' => 'required'
            ];

            if(isset($request->district_id)) $validate = array_merge($validate, ['district_id' => 'exists:districts,id']);
            if(isset($request->region_id)) $validate = array_merge($validate, ['region_id' => 'exists:regions,id']);

            if ($user->email != $request->email) $validate = array_merge($validate, ['email' => 'required|email|unique:users']);
            else $validate = array_merge($validate, ['email' => 'required|email']);

            $validator = Validator::make($request->all(), $validate);

            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'code' => 422,
                    'message' => 'Error Validation',
                    'data' => $validator->errors()->messages()
                ];
            } else {
                $tempData = [];
                $tempData['name'] = $request->name;
                $tempData['email'] = $request->email;
                $tempData['role'] = $request->role;
                $tempData['birth_of_date'] = $request->birth_of_date;
                $tempData['phone_number'] = $request->phone_number;
                $tempData['district_id'] = (!isset($request->district_id)) ? null : $request->district_id;
                $tempData['region_id'] = (!isset($request->region_id)) ? null : $request->region_id;
                $tempData['password'] = ($request->password == null) ? $user->password : Hash::make($request->password);

                $data = $this->userService->update($id, $tempData);

                $response = [
                    'success' => true,
                    'code' => 200,
                    'message' => 'User Updated',
                    'data' => $data
                ];
            }

            return api_response($response['success'], $response['code'], $response['message'], $response['data']);
        }
    }

    public function delete($id)
    {
        $id = intval($id);

        $checkUserNull = $this->checkUserNull($id);
        if($checkUserNull) return $this->responseUserNull();
        else {
            $data = $this->userService->delete($id);

            return api_response(true, 200, 'User Deleted', $data);
        }
    }

    public function check()
    {
        $response = [];
        $user = Auth::user();

        if($user == null) {
            $response['success'] = false;
            $response['code'] = 401;
            $response['message'] = 'Unauthorized';
            $response['data'] = null;
        }else {
            $response['success'] = true;
            $response['code'] = 200;
            $response['message'] = 'Success';
            $response['data'] = $user;
        }

        return api_response($response['success'], $response['code'], $response['message'], $response['data']);
    }

    public function checkUserPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        $user = Auth::user();


        if ($validator->fails()) {
            $response = [
                'success' => false,
                'code' => 422,
                'message' => 'Error Validation',
                'data' => $validator->errors()->messages()
            ];
        }else {
            if (!Hash::check($request->password, $user->password)) {
                $response = [
                    'message' => 'Unauthorized',
                    'code' => 401,
                    'data' => null,
                    'success' => false
                ];
            } else {
                $response = [
                    'message' => 'Success',
                    'code' => 200,
                    'data' => null,
                    'success' => true
                ];
            }
        }

        return $response;
    }
}
