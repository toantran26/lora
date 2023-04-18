<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Services\BackendServices\SensorServices as Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class SensorController extends Controller
{
    protected $_service;

    public function __construct(Services $services)
    {
        $this->_service = $services;

    }

    public function index(Request $request) {
        
     
        $listSensor = $this->_service->listSensor($request,50);
        return view('backend.node.index', compact(['listSensor']));

    }

    public function create() {

        return view('backend.node.create');
    }
    public function store(Request $request) {

        $array = explode("#", $request->data);
        // $q = 'nhiet:37#am:80#acquy:70';
        // $array = explode("#", $q);
        // temp:80#hum:78#bat:40
        $nhiet = explode(":", $array[0]);
        $am = explode(":", $array[1]);
        $acquy = explode(":", $array[2]);
        $request->temperature = $nhiet[1];
        $request->humidity = $am[1];
        $request->acquy = $acquy[1];
        $json = array();
        if($this->_service->storeSensor($request)) {
            $json['temperature'] =  $request->temperature;
            $json['humidity'] =  $request->humidity;
            $json['pin'] =  $request->acquy;

            $api = [
                'status' => true,
                'code' => 200,
                'data'=>$json
            ];
            return response()->json($api);
        }
        $api = [
            'status' => false,
            'code' => 404,
        ];
        return response()->json($api);

    }
}