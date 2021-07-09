<?php

namespace App\Http\Controllers;

use App\Services\DataProviderService;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DataProviderController extends Controller
{
    /**
     * @param Request $request
     * @param DataProviderService $dataProviderService
     * @return JsonResponse
     */
    public function index(Request $request, DataProviderService $dataProviderService): JsonResponse
    {
        $this->validate($request, [
            'provider' => 'valid',
            'statusCode'=> 'allowed'
        ]);

        $files = !empty($request->provider) ? [base_path('data/'.$request->provider.'.json')] : glob(base_path("data/*.json"));

        foreach ($files as $fileName) {
            $result[] = $dataProviderService->extractData($fileName);
        }
        $result = !empty($result) ? Arr::collapse($result) : [];

        if (!empty($request->input())) {
            $result = $dataProviderService->filter($result, $request->input());
        }

        return response()->json($result);
    }
}
