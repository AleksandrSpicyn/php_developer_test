<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HouseIndexRequest;
use App\Models\House;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 * Class HouseController
 * @package App\Http\Controllers\API
 *
 */
class HouseController extends Controller
{
    /**
     * Get houses data with filter
     *
     * @route 'api/houses'
     *
     * @param  HouseIndexRequest  $request
     * @return JsonResponse
     * */
    public function index(HouseIndexRequest $request): JsonResponse
    {
        try {
            $housesQuery = House::query();

            if ($request->filled('name')) {
                $housesQuery->where('name', 'LIKE', "%".$request->get('name')."%");
            }
            if ($request->filled('min_price')) {
                $housesQuery->where('price', '>', $request->get('min_price'));
            }
            if ($request->filled('max_price')) {
                $housesQuery->where('price', '<', $request->get('max_price'));
            }
            if ($request->filled('bedrooms')) {
                $housesQuery->where('bedrooms', $request->get('bedrooms'));
            }
            if ($request->filled('bathrooms')) {
                $housesQuery->where('bathrooms', $request->get('bathrooms'));
            }
            if ($request->filled('storeys')) {
                $housesQuery->where('storeys', $request->get('storeys'));
            }
            if ($request->filled('garages')) {
                $housesQuery->where('garages', $request->get('garages'));
            }
            $houses = $housesQuery->paginate();

            return $this->sendResponse($houses->toArray());
        } catch (Exception $e) {
            Log::error('HouseController@index: '.$e->getMessage());

            return $this->sendError('Failed to get data');
        }
    }
}
