<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data['properties'] = Property::get();
        return View('property.index',$data);
    }
	
	/**
     * Display a listing of the resource from the filtered request.
     *
     * @return \Illuminate\Http\Response
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
		
		// Fetch the datasets from the database.
		$properties = $propertyQuery->get();
		$ajaxcontent= '';
		// Fetched data iteration
        if(!empty($properties) && count($properties)>0){
			foreach($properties as $key => $property)
			$ajaxcontent .= '<tr><td>'.$property->name.'</td><td>'.$property->price.'</td><td>'.$property->bedrooms.'</td><td>'.$property->bathrooms.'</td><td>'.$property->storeys.'</td><td>'.$property->garages.'</td></tr>';
		}else{
			$ajaxcontent= '<tr><td class="nodata" colspan="5">No records found!!!<td></tr>';
		}
		return Response::json($ajaxcontent);
    }
}
