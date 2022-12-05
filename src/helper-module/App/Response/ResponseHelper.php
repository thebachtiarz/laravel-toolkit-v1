<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use Illuminate\Http\JsonResponse;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\Cache\PaginateCache;
use TheBachtiarz\Toolkit\Helper\Cache\PaginatorCache;
use TheBachtiarz\Toolkit\Helper\Helper\PaginatorTrait;

trait ResponseHelper
{
    use CarbonHelper, PaginatorTrait;

    private static string $error403 = "Sorry, you don't have access here";

    /**
     * Response resources with data
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

        if (PaginatorCache::isEnable()) {
            $_responses = self::addPaginatorInformation($_responses);
        }

        if (PaginateCache::isPaginateActive()) {
            $_responses = self::addPaginateInformation($_responses);
        }

        return $_responses;
    }

    /**
     * Return response in JSON format
     *
     * @param mixed $response_data
     * @param string $message
     * @param integer $httpRes
     * @param string $status
     * @param string $time
     * @return JsonResponse
     */
    private static function jsonResponse(
        mixed $response_data,
        string $message = "",
        int $httpRes = 200,
        string $status = "",
        string $time = ""
    ): JsonResponse {
        $response = self::dataResponse($response_data, $status, $message, $time);

        return response()->json($response, $httpRes);
    }

    /**
     * Response error
     *
     * @param string $message
     * @return array
     */
    private static function errorResponse(string $message): array
    {
        return ['status' => 'error', 'message' => $message];
    }

    /**
     * Response json error status
     *
     * @param string $message
     * @param string $code
     * @return JsonResponse
     */
    private static function _throwErrorResponse(string $message = "", string $code = ""): JsonResponse
    {
        $setMsg = $message ? $message : self::$error403;
        $setCode = $code ? $code : "403";
        return response()->json(self::errorResponse($setMsg), $setCode);
    }

    /**
     * Modify response data for paginate availability
     *
     * @param array $initData
     * @return array
     */
    private static function addPaginatorInformation(array $initData): array
    {
        try {
            $initData['response_data'] = self::getPaginateResult(
                $initData['response_data'],
                PaginatorCache::getPerPage(),
                PaginatorCache::getCurrentPage()
            );
        } catch (\Throwable $th) {
        } finally {
            return $initData;
        }
    }

    /**
     * Add paginate information if exist
     *
     * @param array $initData
     * @return array
     */
    private static function addPaginateInformation(array $initData): array
    {
        try {
            $initData = array_merge(
                $initData,
                PaginateCache::getPaginateSummaryInfo()
            );
        } catch (\Throwable $th) {
        } finally {
            return $initData;
        }
    }
}
