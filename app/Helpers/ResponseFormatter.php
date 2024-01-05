<?php
namespace App\Helpers;

class ResponseFormatter {
    protected static $response = [
        'code' => null,
        'status' => null,
        'message' => null,
        'data' => null,
    ];
    public static function success($code = null, $message = null, $data = null)
    {
        self::$response['code'] = $code;
        self::$response['status'] = 'success';
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        return response()->json(self::$response, self::$response['code']);
    }

    public static function error($code = null, $message = null, $data = null)
    {
        self::$response['code'] = $code;
        self::$response['status'] = 'error';
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['code']);
    }

}
?>  