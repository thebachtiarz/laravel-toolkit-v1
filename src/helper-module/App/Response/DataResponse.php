<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use Illuminate\Http\JsonResponse;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

/**
 * Response data service resolver
 */
trait DataResponse
{
    use ResponseHelper, ErrorLogTrait;

    /**
     * Create response data
     *
     * @param mixed $data
     * @param string $message
     * @param integer $resCode
     * @return array
     */
    private static function responseData(
        mixed $data,
        string $message = "",
        int $resCode = 200
    ): array {
        return [
            'status' => (bool) true,
            'data' => $data,
            'message' => $message,
            'http_code' => $resCode
        ];
    }

    /**
     * Create response error
     *
     * @param \Throwable $throwable
     * @return array
     */
    private static function responseError(\Throwable $throwable): array
    {
        return [
            'status' => (bool) false,
            'throwable' => $throwable
        ];
    }

    /**
     * Convert response service to response web page
     *
     * @param array $response
     * @return array
     */
    private static function responseWebPage(array $response): array
    {
        $result = ['status' => false, 'data' => null, 'message' => '', 'http_code' => 200];

        try {
            throw_if(!$response['status'], 'Exception', '');

            $result['data'] = $response['data'];
            $result['status'] = true;
            $result['message'] = @$response['message'] ?: '';
        } catch (\Throwable $th) {
            $_th = self::getErrorData($response['throwable']);

            $result['message'] = @$_th['message'] ?: $th->getMessage();
        } finally {
            $result['http_code'] = @$response['http_code'] ?: 200;

            return $result;
        }
    }

    /**
     * Convert response service to response rest api
     *
     * @param array $response
     * @return JsonResponse
     */
    private static function responseApiRest(array $response): JsonResponse
    {
        try {
            throw_if(!$response['status'], 'Exception', '');

            return self::responseDataJson($response['data'], $response['message'], $response['http_code'], 'success');
        } catch (\Throwable $th) {
            return self::responseErrorJson($response['throwable'] ?? $th);
        }
    }

    /**
     * Convert response service to response graphql api
     *
     * @param array $response
     * @return array
     */
    private static function responseApiGraphql(array $response): array
    {
        try {
            throw_if(!$response['status'], 'Exception', '');

            return self::responseDataGraphql($response['data'], $response['message'], 'success');
        } catch (\Throwable $th) {
            return self::responseErrorGraphql($response['throwable'] ?? $th);
        }
    }

    /**
     * Data response json
     *
     * @param mixed $data
     * @param string $message
     * @param integer $resCode
     * @param string $resStatus
     * @param string $resTime
     * @return JsonResponse
     */
    private static function responseDataJson(
        mixed $data,
        string $message = "",
        int $resCode = 200,
        string $resStatus = "",
        string $resTime = ""
    ): JsonResponse {
        return self::jsonResponse($data, $message, $resCode, $resStatus, $resTime);
    }

    /**
     * Data response graphql
     *
     * @param mixed $data
     * @param string $message
     * @param string $resStatus
     * @return array
     */
    private static function responseDataGraphql($data, string $message = "", string $resStatus = ""): array
    {
        return self::dataResponse($data, $resStatus, $message);
    }

    /**
     * Error response json
     *
     * @param \Throwable $throwable
     * @return JsonResponse
     */
    private static function responseErrorJson(\Throwable $throwable): JsonResponse
    {
        self::logCatch($throwable);

        $_errorData = self::getErrorData($throwable);

        return self::jsonResponse(
            $_errorData,
            $_errorData['message'],
            $throwable->getCode() ?: 202,
            'error'
        );
    }

    /**
     * Error response graphql
     *
     * @param \Throwable $throwable
     * @return array
     */
    private static function responseErrorGraphql(\Throwable $throwable): array
    {
        self::logCatch($throwable);

        $_errorData = self::getErrorData($throwable);

        return self::dataResponse(
            $_errorData,
            'error',
            $_errorData['message']
        );
    }

    /**
     * Get error data
     *
     * @param \Throwable $throwable
     * @return array
     */
    private static function getErrorData(\Throwable $throwable): array
    {
        $_result['message'] = config('app.env') === "production"
            ? ((iconv_strlen($throwable->getMessage()) >= 100)
                ? "Some error happen"
                : $throwable->getMessage())
            : $throwable->getMessage();

        if (config('app.env') !== "production") {
            $_result['code'] = $throwable->getCode();
            $_result['line'] = $throwable->getLine();
        }

        return $_result;
    }
}
