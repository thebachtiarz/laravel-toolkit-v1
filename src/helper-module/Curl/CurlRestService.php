<?php

namespace TheBachtiarz\Toolkit\Helper\Curl;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http as CURL;
use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

/**
 * Curl Rest Service
 */
trait CurlRestService
{
    use ArrayHelper, ErrorLogTrait;

    /**
     * Header curl
     *
     * @var array
     */
    protected static array $header = [];

    /**
     * Url domain curl
     *
     * @var string
     */
    protected static string $url = "";

    /**
     * Data body curl
     *
     * @var array
     */
    protected static array $data = [];

    // ? Public Methods
    /**
     * Curl get
     *
     * @return array
     */
    public static function get(): array
    {
        $_post = self::curl()->get(self::urlResolver(), self::dataResolver());

        return self::responseResolver($_post);
    }

    /**
     * Curl post
     *
     * @return array
     */
    public static function post(): array
    {
        $_post = self::curl()->post(self::urlResolver(), self::dataResolver());

        return self::responseResolver($_post);
    }

    // ? Private Methods
    /**
     * Create pre curl custom
     *
     * @return PendingRequest
     */
    private static function curl(): PendingRequest
    {
        $_headers = [
            'Accept' => 'application/json'
        ];

        if (count(self::$header))
            $_headers = array_merge($_headers, self::$header);

        return CURL::withHeaders($_headers);
    }

    /**
     * Curl response resolver
     *
     * @param Response $response
     * @return array
     */
    private static function responseResolver(Response $response): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_response = $response->json();

            /**
             * If there is validation errors
             */
            throw_if(in_array("errors", array_keys($_response)), 'Exception', $_response['message']);

            /**
             * If there is no 'status' indexes. Assume there is an error in the result.
             */
            throw_if(!@$_response['status'], 'Exception', $_response['message']);

            /**
             * If return status is not success
             */
            throw_if($_response['status'] !== "success", 'Exception', $_response['message']);

            $result['data'] = $_response['response_data'];
            $result['status'] = $_response['status'] === "success";
            $result['message'] = $_response['message'];
        } catch (\Throwable $th) {
            self::logCatch($th);

            $result['message'] = $th->getMessage();
        } finally {
            return $result;
        }
    }

    /**
     * Base domain resolver
     *
     * @param boolean $secure
     * @return string
     */
    private static function baseDomainResolver(bool $secure = true): string
    {
        return "https://localhost/";
    }

    /**
     * Url end point resolver
     *
     * @return string
     */
    private static function urlResolver(): string
    {
        $_baseDomain = self::baseDomainResolver(true);

        $_prefix = "";

        $_endPoint = "";

        return "{$_baseDomain}{$_prefix}/{$_endPoint}";
    }

    /**
     * Data form resolver
     *
     * @return array
     */
    private static function dataResolver(): array
    {
        return self::$data;
    }

    // ? Setter Modules
    /**
     * Set header curl
     *
     * @param array $header header curl
     * @return self
     */
    public static function setHeader(array $header): self
    {
        self::$header = $header;

        return new self;
    }

    /**
     * Set url domain curl
     *
     * @param string $url url domain curl
     * @return self
     */
    public static function setUrl(string $url): self
    {
        self::$url = $url;

        return new self;
    }

    /**
     * Set data body curl
     *
     * @param array $data data body curl
     * @return self
     */
    public static function setData(array $data): self
    {
        self::$data = $data;

        return new self;
    }
}
