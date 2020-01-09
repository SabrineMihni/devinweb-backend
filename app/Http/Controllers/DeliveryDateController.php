<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryDateCollection;
use App\Http\Resources\DeliveryDateResource;
use App\Models\DeliveryDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryDateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(DeliveryDate::all()->toArray(), 'OK');
    }

    /**
     * @param $city_id
     * @param $days_to_get
     * @return DeliveryDateCollection
     */
    public function list($city_id, $days_to_get) {

        return new DeliveryDateCollection(DeliveryDate::where('city_id', $city_id)->with('deliveryTimes')->take($days_to_get)->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'date' => 'required|date',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['excluded'] = false;
        $input['day_name'] = (new \DateTime($input['date']))->format('l');

        $deliveryTime = DeliveryDate::create($input);

        return $this->sendResponse($deliveryTime->toArray(), 'DeliveryDate created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryDate  $deliveryDate
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryDate $deliveryDate)
    {
        return $this->sendResponse($deliveryDate->toArray(), 'OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryDate  $deliveryDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryDate $deliveryDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryDate  $deliveryDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryDate $deliveryDate)
    {
        //
    }
}
