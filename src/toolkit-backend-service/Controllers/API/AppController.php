<?php

namespace TheBachtiarz\Toolkit\Backend\Controllers\API;

use Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppController extends Controller
{
    public function getAppName(Request $request): Response
    {
        return config('thebachtiarz_toolkit.app_name');
    }
}
