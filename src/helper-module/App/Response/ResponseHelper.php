<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

trait ResponseHelper
{
    use CarbonHelper;

    private static string $error403 = "Sorry, you don't have access here";

    /**
     * response resources with data
     *
     * @param mixed $response_data
     * @param string $stat
     * @param string $message
     * @param string $time
     * @return array
     */
    private static function dataResponse($response_data, string $stat = '', string $message = '', string $time = ''): array
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
    private static function JsonResponse($response_data, string $message = '', int $httpRes = 200, string $status = '', string $time = ''): object
    {
        $response = self::dataResponse($response_data, $status, $message, $time);

        return response()->json($response, $httpRes);
    }

    /**
     * response error
     *
     * @param string $message
     * @return array
     */
    private static function errorResponse($message): array
    {
        return ['status' => 'error', 'message' => $message];
    }

    /**
     * response json error status
     *
     * @param string $message
     * @param string $code
     * @return object
     */
    private static function _throwErrorResponse(string $message = '', string $code = ''): object
    {
        $setMsg = $message ? $message : self::$error403;
        $setCode = $code ? $code : "403";
        return response()->json(self::errorResponse($setMsg), $setCode);
    }
}
