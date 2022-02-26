<?php

namespace TheBachtiarz\Toolkit\Helper\App\Response;

use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

/**
 * Response data service resolver
 */
trait DataResponse
{
    use ResponseHelper, ErrorLogTrait;

    /**
     * create response data
     *
     * @param mixed $data
     * @param string $message
     * @param integer $resCode
     * @return array
     */
    private static function responseData($data, string $message = '', int $resCode = 200): array
    {
        return [
            'status' => (bool) true,
            'data' => $data,
            'message' => $message,
            'http_code' => $resCode
        ];
    }

    /**
     * create response error
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
     * convert response service to response rest api
     *
     * @param array $response
     * @return object
     */
    public static function responseApiRest(array $response): object
    {
        try {
            throw_if(!$response['status'], 'Exception', '');

            return self::responseDataJson($response['data'], $response['message'], $response['http_code'], 'success');
        } catch (\Throwable $th) {
            return self::responseErrorJson($response['throwable'] ?? $th);
        }
    }

    /**
     * convert response service to response graphql api
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
     * data response json
     *
     * @param mixed $data
     * @param string $message
     * @param integer $resCode
     * @param string $resStatus
     * @param string $resTime
     * @return object
     */
    private static function responseDataJson($data, string $message = '', int $resCode = 200, string $resStatus = '', string $resTime = ''): object
    {
        return self::JsonResponse($data, $message, $resCode, $resStatus, $resTime);
    }

    /**
     * data response graphql
     *
     * @param mixed $data
     * @param string $message
     * @param string $resStatus
     * @return array
     */
    private static function responseDataGraphql($data, string $message = '', string $resStatus = ''): array
    {
        return self::dataResponse($data, $resStatus, $message);
    }

    /**
     * error response json
     *
     * @param \Throwable $throwable
     * @return object
     */
    private static function responseErrorJson(\Throwable $throwable): object
    {
        self::logCatch($throwable);

        $_errorData = self::getErrorData($throwable);

        return self::JsonResponse(
            $_errorData,
            $_errorData['message'],
            $throwable->getCode() ?: 202,
            'error'
        );
    }

    /**
     * error response graphql
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
     * get error data
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
