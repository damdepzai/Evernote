<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function responseAPI($status, $message, $data, $status_code)
    {
        $array = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
        return response()->json($array, $status_code);
    }
}
