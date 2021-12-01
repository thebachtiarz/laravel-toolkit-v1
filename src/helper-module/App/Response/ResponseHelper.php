<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

trait ResponseHelper
{
    use CarbonHelper;

    public static string $error403 = "Sorry, you don't have access here";

    /**
     * response success with data
     *
     * @param string $message
     * @param array ...$response_data
     * @return array
     */
    public static function successResponse(string $message, ...$response_data): array
    {
        return ['status' => 'success', 'message' => $message, 'response_data' => $response_data];
    }

    /**
     * response info
     *
     * @param string $message
     * @return array
     */
    public static function infoResponse($message): array
    {
        return ['status' => 'info', 'message' => $message];
    }

    /**
     * response error
     *
     * @param string $message
     * @return array
     */
    public static function errorResponse($message): array
    {
        return ['status' => 'error', 'message' => $message];
    }

    /**
     * response resources with data
     *
     * @param mixed $response_data
     * @param string $stat
     * @param string $message
     * @param string $time
     * @return array
     */
    public static function dataResponse($response_data, string $stat = '', string $message = '', string $time = ''): array
    {
        return [
            'status' => $stat ? $stat : 'success',
            'access' => $time ? $time : self::humanFullDateTimeNow(),
            'message' => $message ? $message : '',
            'response_data' => $response_data
        ];
    }

    /**
     * return response in JSON format
     *
     * @param mixed $response_data
     * @param string $message
     * @param integer $httpRes
     * @param string $status
     * @param string $time
     * @return object
     */
    public static function JsonResponse($response_data, string $message = '', int $httpRes = 200, string $status = '', string $time = ''): object
    {
        $response = self::dataResponse($response_data, $status, $message, $time);

        return response()->json($response, $httpRes);
    }

    /**
     * response json error status
     *
     * @param string $message
     * @param string $code
     * @return object
     */
    public static function _throwErrorResponse(string $message = '', string $code = ''): object
    {
        $setMsg = $message ? $message : self::$error403;
        $setCode = $code ? $code : "403";
        return response()->json(self::errorResponse($setMsg), $setCode);
    }
}
