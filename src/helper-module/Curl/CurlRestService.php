<?php

namespace TheBachtiarz\Toolkit\Helper\Curl;

use Illuminate\Http\Client\PendingRequest;
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
     * header curl
     *
     * @var array
     */
    protected static array $header = [];

    /**
     * url domain curl
     *
     * @var string
     */
    protected static string $url = "";

    /**
     * data body curl
     *
     * @var array
     */
    protected static array $data = [];

    // ? Public Methods
    /**
     * curl post
     *
     * @return array
     */
    public static function post(): array
    {
        $result = ['status' => false, 'data' => null, 'message' => ""];

        try {
            $_post = self::curl()->post(self::urlResolver(), self::dataResolver());

            $_result = self::jsonDecode($_post);

            /**
             * if there is validation errors
             */
            throw_if(in_array("errors", array_keys($_result)), 'Exception', $_result['message']);

            /**
             * if return status is not success
             */
            throw_if($_result['status'] !== "success", 'Exception', $_result['message']);

            $result['data'] = $_result['response_data'];
            $result['status'] = $_result['status'] === "success";
            $result['message'] = $_result['message'];
        } catch (\Throwable $th) {
            self::logCatch($th);

            $result['message'] = $th->getMessage();
        } finally {
            return $result;
        }
    }

    // ? Private Methods
    /**
     * create pre curl custom
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
     * base domain resolver
     *
     * @param boolean $secure
     * @return string
     */
    private static function baseDomainResolver(bool $secure = true): string
    {
        return "https://localhost/";
    }

    /**
     * url end point resolver
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
     * data form resolver
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
