<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\api_response;

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
            $random_string = $this->generateRandomString();
            $file_name_with_path = $file_path.'/'.$random_string.'_'.$file_name;
            $response = Storage::disk('local')->put($file_name_with_path, \File::get($file));

            if($response) {
                $object = new \stdClass();
                $object->file_path = $file_name_with_path;

                $message = "Success";
                $code = 200;
                $success = true;
                $data = $object;
            }else {
                $message = "Error";
                $code = 500;
                $success = false;
                $data = null;
            }
        }

        return api_response($success, $code, $message, $data);
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function remove(Request $request) {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required',
        ]);

        $file_path = $request->file_path;

        if($validator->fails()) {
            $message = "Error Validation";
            $code = 422;
            $success = false;
            $data = $validator->errors()->messages();
        }else {
            $exists = Storage::disk('local')->exists($file_path);
            if($exists) {
                Storage::disk('local')->delete($file_path);

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

        return api_response($success, $code, $message, $data);
    }

    public function getFile($region, $type, $filename) {
        $path = storage_path('assets/' . $region . '/'. $type .'/'.$filename);

        if (!\File::exists($path)) {
            abort(404);
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
