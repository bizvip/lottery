<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function resp(mixed $data = null, string $msg = '成功', int $code = 0): \Illuminate\Http\JsonResponse
    {
        return response()->json(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }
}
