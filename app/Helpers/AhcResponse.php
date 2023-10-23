<?php

namespace App\Helpers;

class AhcResponse
{
    static function sendResponse($data = [], $success = true, $errors = [],)
    {
        $response = [
            'success'    => $success,
            'result'      => $data,
            'errors'       => $errors
        ];

        return response()->json($response);
    }
}
