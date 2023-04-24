<?php

namespace App\Http\Service;

use App\Models\Order;
use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ToyService extends Service
{
    public function _GET(Request $request) {
        return ['list' => 2];
        $toys = Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories']);

        if ($request->has('subCategoryId')) {
            $toys->whereHas('subCategories', function($q) use ($request) {
                $q->where('id', '=' , $request['subCategoryId']);
            });
        }

        return [
            'list' => $toys->orderByDesc('rating')->get()
        ];
    }

    public function _GET_toy_by_id($id) {
        $toy = Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories'])->where('id', '=', $id)->first();

        return [ 'data' => $toy ];
    }

    public function _GET_recommendations(Request $request) {
        $listOfIds = explode(',', $request['id']);
        $orders = Order::with('toyOrders')
            ->whereHas('toyOrders', function($q) use ($listOfIds) {
                $q->whereIn('Toy_id', $listOfIds);
            })->get();
        $toyIdsInOrders = [];

        foreach ($orders as $order) {
            foreach($order->toyOrders as $toy) {
                if(array_key_exists($toy->id, $toyIdsInOrders)) {
                    $toyIdsInOrders[$toy->id] = $toyIdsInOrders[$toy->id] + 1;
                } else {
                    $toyIdsInOrders[$toy->id] = 1;
                }
            }
        }

        return [
            'list' => $toyIdsInOrders
        ];
    }


    public function _POST(Request $request) {
        $errors = $this->validateToy($request);

        if($errors) {
          return response($errors, 422);
        }
        $description = '';
        $image = '';

        if($request['description']) {
            $description = $request['description'];
        }
        if($request['image']) {
            $image = $request['image'];
        }

        $newToy = Toy::create([
            'title' => $request['title'],
            'description' => $description,
            'price' => $request['price'],
            'rating' => 0,
            'number' => $request['number'],
            'image' => $image,
            'Brand_id' => $request['brand_id'],
            'GenderCategory_id' => $request['gender_id'],
            'AgeLimit_id' => $request['age_limit_id']
        ]);

        return $this->findWith($newToy->id);
    }

    public function _PATCH($id, Request $request) {
        $errors = $this->validateToy($request);

        if($errors) {
            return response($errors, 422);
        }

        $toyToPatch = Toy::find(intval($id));

        if(!$toyToPatch) {
            return response('Item not found', 422);
        }
        $requestData = $request->all();

        $toyToPatch->fill($requestData)->save();

        return $toyToPatch;
    }

    public function _DELETE($id) {
        $toyToDelete = Toy::find(intval($id));

        if(!$toyToPatch) {
            return response('Item not found', 422);
        }

        return $toyToDelete->delete();
    }

    public function validateToy(Request $request) {
        $validationRules = [
            'title' => ['required', 'unique:toys', 'max:255'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function findWith($id) {
        return Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories'])->find($id);
    }
}
