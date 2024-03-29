<?php

namespace TheBachtiarz\Toolkit\Backend\Controllers\API;

use Illuminate\Http\{Request, Response};
use TheBachtiarz\Toolkit\Backend\Controllers\Controller;
use TheBachtiarz\Toolkit\Backend\Service\ConfigBackendService;
use TheBachtiarz\Toolkit\Backend\Validator\AppRequestValidator;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Helper\App\Response\ResponseHelper;

class AppController extends Controller
{
    use ResponseHelper;

    /**
     * Get app name
     *
     * @param Request $request
     * @return Response
     */
    public function getAppName(Request $request)
    {
        $config = ConfigBackendService::getAppName()
            ?? tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME)
            ?? '';

        return self::jsonResponse($config);
    }

    /**
     * Get app name
     *
     * @param Request $request
     * @return Response
     */
    public function getAppUrl(Request $request)
    {
        $config = ConfigBackendService::getAppUrl()
            ?? tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME)
            ?? '';

        return self::jsonResponse($config);
    }

    /**
     * Get app name
     *
     * @param Request $request
     * @return Response
     */
    public function getAppTimezone(Request $request)
    {
        $config = ConfigBackendService::getAppTimezone()
            ?? tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME)
            ?? '';

        return self::jsonResponse($config);
    }

    /**
     * Get app prefix
     *
     * @param Request $request
     * @return Response
     */
    public function getAppPrefix(Request $request)
    {
        $config = ConfigBackendService::getAppPrefix()
            ?? tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_PREFIX_NAME)
            ?? '';

        return self::jsonResponse($config);
    }

    /**
     * Set app name
     *
     * @param Request $request
     * @return Response
     */
    public function setAppName(Request $request)
    {
        $validator = AppRequestValidator::validate($request, [
            'name' => 'name-simple'
        ]);

        if ($validator->fails()) return AppRequestValidator::responseError($validator);

        $config = ConfigBackendService::setAppName($request->name);

        return self::jsonResponse($config);
    }

    /**
     * Set app url
     *
     * @param Request $request
     * @return Response
     */
    public function setAppUrl(Request $request)
    {
        $validator = AppRequestValidator::validate($request, [
            'url' => 'url-simple'
        ]);

        if ($validator->fails()) return AppRequestValidator::responseError($validator);

        $config = ConfigBackendService::setAppUrl($request->url);

        return self::jsonResponse($config);
    }

    /**
     * Set app timezone
     *
     * @param Request $request
     * @see timezone_identifiers_list or \DateTimeZone::listIdentifiers()
     * @return Response
     */
    public function setAppTimezone(Request $request)
    {
        $validator = AppRequestValidator::validate($request, [
            'timezone' => 'timezone-simple'
        ]);

        if ($validator->fails()) return AppRequestValidator::responseError($validator);

        $config = ConfigBackendService::setAppTimezone($request->timezone);

        return self::jsonResponse($config);
    }

    /**
     * Set app prefix
     *
     * @param Request $request
     * @return Response
     */
    public function setAppPrefix(Request $request)
    {
        $validator = AppRequestValidator::validate($request, [
            'prefix' => 'prefix-simple'
        ]);

        if ($validator->fails()) return AppRequestValidator::responseError($validator);

        $config = ConfigBackendService::setAppPrefix($request->url);

        return self::jsonResponse($config);
    }
}
