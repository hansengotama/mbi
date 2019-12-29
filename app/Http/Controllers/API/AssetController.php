<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required',
            'file' => 'required|file',
        ]);

        if($validator->fails()) {
            $message = "Error Validation";
            $code = 422;
            $success = false;
            $data = $validator->errors()->messages();
        }else {
            $file = $request->file;
            $file_path = $request->file_path;
            $file_name = $file->getClientOriginalName();
            $file_name_with_path = $file_path.'/'.$file_name;
            $response = Storage::disk('local')->put($file_name_with_path, \File::get($file));

            if($response) {
                $message = "Success";
                $code = 200;
                $success = true;
                $data = null;
            }else {
                $message = "Error";
                $code = 500;
                $success = false;
                $data = null;
            }
        }

        return [
            'message' => $message,
            'code' => $code,
            'data' => $data,
            'success' => $success
        ];
    }

    public function remove(Request $request) {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required',
        ]);

        if($validator->fails()) {
            $message = "Error Validation";
            $code = 422;
            $success = false;
            $data = $validator->errors()->messages();
        }else {
            $exists = Storage::disk('local')->exists('sadhuband/123/videoplayback.mp3');
            if($exists) {
                Storage::disk('local')->delete('sadhuband/123/videoplayback.mp3');

                $message = "Success";
                $code = 200;
                $success = true;
                $data = null;
            } else {
                $message = "Error";
                $code = 500;
                $success = false;
                $data = null;
            }
        }

        return [
            'message' => $message,
            'code' => $code,
            'data' => $data,
            'success' => $success
        ];
    }
}
