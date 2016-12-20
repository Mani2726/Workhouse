<?php

namespace App\Http\Controllers\Api;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class PropertyController extends Controller
{
    /*
    * Search the property table.
    *
    * @param  Request $request
    * @return mixed
    */
    public function search(Request $request)
    {
        // Query construction for Properites table.
		$propertyQuery	= Property::select();
		
		// Check whether request input empty or not
		if(!empty($request->get('name'))){
			$propertyQuery->where('name', 'like', $request->get('name').'%');
		}
		if(!empty($request->get('price')) && is_numeric($request->get('price'))){
			$propertyQuery->where('price', $request->get('price'));
		}
		if(!empty($request->get('bedrooms')) && is_numeric($request->get('bedrooms'))){
			$propertyQuery->where('bedrooms', $request->get('bedrooms'));
		}
		if(!empty($request->get('bathrooms')) && is_numeric($request->get('bathrooms'))){
			$propertyQuery->where('bathrooms', $request->get('bathrooms'));
		}
		if(!empty($request->get('storeys')) && is_numeric($request->get('storeys'))){
			$propertyQuery->where('storeys', $request->get('storeys'));
		}
		if(!empty($request->get('garages')) && is_numeric($request->get('garages'))){
			$propertyQuery->where('garages', $request->get('garages'));
		}
		if(!empty($request->get('start')) && is_numeric($request->get('start'))){
			$propertyQuery->offset($request->get('start'));
		}
		if(!empty($request->get('limit')) && is_numeric($request->get('limit'))){
			$propertyQuery->limit($request->get('limit'));
		}
		// Fetch the datasets from the database.
		$properties = $propertyQuery->get();
        // Return the result as json data.
        return Response::json(array(
            'success' => true,
			'recordsTotal'=>Property::count(),
			'records_found'=>count($properties),
            'data' => $properties,
            'status_code' => 200
        ));
    }
}
