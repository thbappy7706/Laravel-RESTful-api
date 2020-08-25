<?php

namespace App\Http\Controllers\country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CountryController extends Controller
{


    public function country()
    {
return response()->json(Country::get(),200);

    }


    public function countryById($id)
{
   $country= Country::find($id);

   if(is_null($country))
   {
       return response()->json(["message"=>"Record Not Found!!!"], 404);

   }
   return response()->json($country, 200);

}


public function countrySave(Request $request)
{

    $rules = [

        'name'=> 'required|min:3',
        'iso'=> 'required|min:2|max:2',


    ];

    $valid= Validator::make($request->all(), $rules);

    if($valid->fails())
    {

        return response()->json($valid->errors(),400);

    }


    $country = Country::create($request->all());

    return response()->json($country, 201);

}


public function countryUpdate(Request $request , $id)
{
    $country= Country::find($id);
    if(is_null($country))
    {
        return response()->json(["message"=>"Record Not Found!!!"], 404);

    }
    $country->update($request->all());
    return response()->json($country, 200);

}

public function countryDelete(Request $request, $id)
{

    $country = Country::find($id);
    if(is_null($country))
    {
        return response()->json(["message"=>"Record Not Found!!!"], 404);
    }
$country->delete();
return response()->json(null, 204);


}

}
