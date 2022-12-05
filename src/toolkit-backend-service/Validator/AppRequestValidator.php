<?php

namespace TheBachtiarz\Toolkit\Backend\Validator;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorReturn;
use TheBachtiarz\Toolkit\Backend\Interfaces\Rules\Rules;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\Toolkit\Helper\App\Response\ResponseHelper;

class AppRequestValidator
{
    use ResponseHelper, ErrorLogTrait;

    /**
     * Request
     *
     * @var Request
     */
    private static Request $request;

    /**
     * validates
     *
     * @var array
     */
    private static array $validates;

    // ? Public Methods.
    /**
     * Validate input request
     *
     * @param Request $request
     * @param array $validates
     * @param boolean $defaultMessage
     * @return ValidatorReturn
     */
    public static function validate(Request $request, array $validates = [], bool $defaultMessage = false): ValidatorReturn
    {
        self::$request = $request;
        self::$validates = $validates;

        return Validator::make(
            self::requests(),
            self::rules(),
            $defaultMessage ? [] : self::messages()
        );
    }

    /**
     * Custom error response for AppRequestValidator::class
     *
     * @param ValidatorReturn $validator
     * @return JsonResponse
     */
    public static function responseError(ValidatorReturn $validator): JsonResponse
    {
        return self::jsonResponse(self::errorResponse($validator->errors()), "Input request failed", 202, "error");
    }

    // ? Private Methods.
    /**
     * Get requests data
     *
     * @return array
     */
    private static function requests(): array
    {
        try {
            $result = [];

            foreach (self::$validates as $key => $request)
                $result[$key] = self::$request->{$key};

            return $result;
        } catch (\Throwable $th) {
            self::logCatch($th);

            return [];
        }
    }

    /**
     * Get rules data
     *
     * @return array
     */
    private static function rules(): array
    {
        try {
            $result = [];

            foreach (self::$validates as $key => $validate)
                $result[] = [$key => Rules::RULES_VALIDATOR[$validate]['rule']];

            return array_merge(...$result);
        } catch (\Throwable $th) {
            self::logCatch($th);

            return [];
        }
    }

    /**
     * Get messages data
     *
     * @return array
     */
    private static function messages(): array
    {
        try {
            $result = [];

            foreach (self::$validates as $key => $validate)
                $result["{$key}.*"] = preg_replace_array('/:[a-z]+/', [$key], Rules::RULES_VALIDATOR[$validate]['message']);

            return $result;
        } catch (\Throwable $th) {
            self::logCatch($th);

            return [];
        }
    }
}
