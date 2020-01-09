<?php

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\DeliveryDate;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryTimeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(DeliveryTime::all()->toArray(), 'OK');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->add(null, $request->all());
    }

    /**
     * @param Request $request
     * @param $city_id
     * @return \Illuminate\Http\Response
     */
    public function attachCity(Request $request,$city_id ) {

        $city = City::find($city_id);

        return $this->add($city, $request->all());

    }

    /**
     * @param Request $request
     * @param $city_id
     * @param $del_date_id
     * @return \Illuminate\Http\Response
     */
    public function excludeDeliveryDate(Request $request, $city_id, $del_date_id) {

        $date = DeliveryDate::find($del_date_id);

        if($date && ($date->city_id === (int) $city_id)) {

            $date->excluded = true;
            $times_ids = $date->deliveryTimes->pluck('id');
            DeliveryTime::whereIn('id', $times_ids)->update(['excluded' => true]);
            $date->save();

        }else {
            return $this->sendError(null, 'Something went wrong!');
        }


        return $this->sendResponse(null, 'DeliveryTimes have been excluded successfully!');

    }

    /**
     * @param Request $request
     * @param $city_id
     * @return \Illuminate\Http\Response
     */
    public function excludeDeliveryTimes(Request $request, $city_id) {

        $dates_times_to_be_excluded = $request->input("dates");

        foreach ($dates_times_to_be_excluded as $data) {

            $date_id = array_keys($data)[0];
            $times_id = $data[$date_id];

            $date = DeliveryDate::find((int) $date_id);

            if($date && ($date->city_id === (int) $city_id)) {

                foreach ($times_id as $time_id) {

                    $time = DeliveryTime::find($time_id);

                    if($time->city_id === (int) $city_id && $time->delivery_date_id === (int) $date_id) {

                        $time->excluded = true;
                        $time->save();
                    }
                }
            }else {
                return $this->sendError(null, 'Something went wrong!');
            }
        }

        return $this->sendResponse(null, 'DeliveryTimes have been excluded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryTime $deliveryTime)
    {
        return $this->sendResponse($deliveryTime->toArray(), 'OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryTime $deliveryTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryTime $deliveryTime)
    {
        //
    }

    /**
     * @param $city
     * @param $input
     * @return \Illuminate\Http\Response
     */
    public function add($city, $input) {

        $validator = Validator::make($input, [
            'delivery_at' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['excluded'] = false;

        $deliveryTime = $city ? $city->deliveryTimes()->create($input) : DeliveryTime::create($input);

        return $this->sendResponse($deliveryTime->toArray(), 'DeliveryTime created successfully.');
    }
}
