<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;

class VersionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function version_code()
    {
        //
        return Version::where('version_id', '1')->get();
        //return Version::all();

    }


}
