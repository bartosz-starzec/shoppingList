<?php


namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Response;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @param $data
     * @return JsonResponse
     */
    public function respond($data): JsonResponse
    {
        $body = [
            'ver' => env('APP_VER', 2.0),
            'timestamp' => time(),
            'data' => $data
        ];

        return Response::json($body);
    }
}
