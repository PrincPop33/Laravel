<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class HandleController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function success($data, $message)
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * @return \Illuminate\Http\Response
     */
    public function error($error, $errors = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errors)){
            $response['data'] = $errors;
        }

        return response()->json($response, $code);
    }
}
