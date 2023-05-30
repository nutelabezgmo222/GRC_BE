<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RiskPeriodService extends Service
{
    public function _GET(Request $request) {
        // $threats = Threat::all();
        // $vulnerabilities = Vulnerability::all();
        // $levelOfThreats = Vulnerability::all();

        // return [
        //     'threats' => $threats->get(),
        //     'vulnerabilities' => $vulnerabilities->get(),
        //     'levelOfThreats' => $levelOfThreats->get(),
        // ];
    }


    public function _POST(Request $request) {
        // $errors = $this->validateBrand($request);

        // if($errors) {
        //   return response($errors, 422);
        // }

        // return Brand::create([
        //     'title' => $request['title'],
        //     'description' => $request['description'] || '',
        //     'Country_id' => $request['country_id']
        // ]);
    }

    public function _DELETE($id) {
        // $brandToDelete = Brand::find(intval($id));

        // if(!$brandToDelete) {
        //     return response('Item not found', 422);
        // }

        // return $brandToDelete->delete();
    }

    public function validateBrand(Request $request) {
        // $validationRules = [
        //     'title' => ['required', 'unique:brands', 'max:255'],
        //     'country_id' => ['required', 'exists:countries,id']
        // ];
        
        // return $this->validateRequest($request, $validationRules);
    }
}
