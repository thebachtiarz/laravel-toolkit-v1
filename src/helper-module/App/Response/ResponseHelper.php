<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\Cache\PaginateCache;

trait ResponseHelper
{
    use CarbonHelper;

    private static string $error403 = "Sorry, you don't have access here";

    /**
     * response resources with data
     *
     * @param mixed $response_data
     * @param string $status
     * @param string $message
     * @param string $datetime
     * @return array
     */
    private static function dataResponse(
        mixed $response_data,
        string $status = "",
        string $message = "",
        string $datetime = ""
    ): array {
        $_responses = [
            'status' => $status ?: 'success',
            'access' => $datetime ?: self::humanFullDateTimeNow(),
            'message' => $message,
            'response_data' => $response_data
        ];

        $_responses = self::addPaginateInformation($_responses);

        return $_responses;
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
    private static function JsonResponse(
        mixed $response_data,
        string $message = "",
        int $httpRes = 200,
        string $status = "",
        string $time = ""
    ): object {
        $response = self::dataResponse($response_data, $status, $message, $time);

        return response()->json($response, $httpRes);
    }

    /**
     * response error
     *
     * @param string $message
     * @return array
     */
    private static function errorResponse(string $message): array
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
    private static function _throwErrorResponse(string $message = "", string $code = ""): object
    {
        $setMsg = $message ? $message : self::$error403;
        $setCode = $code ? $code : "403";
        return response()->json(self::errorResponse($setMsg), $setCode);
    }

    /**
     * add paginate information if exist
     *
     * @param array $initData original data without paginate information
     * @return array
     */
    private static function addPaginateInformation(array $initData): array
    {
        try {
            /**
             * set data paginate information
             */
            if (PaginateCache::isPaginateActive()) {
                $initData = array_merge(
                    $initData,
                    PaginateCache::getPaginateSummaryInfo()
                );
            }
        } catch (\Throwable $th) {
        } finally {
            return $initData;
        }
    }
}
