<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Services\BackendServices\SensorServices as Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{
    protected $_service;

    public function __construct(Services $services)
    {
        $this->_service = $services;

    }

    public function index(Request $request) {
        
     
        $listSensor1 = $this->_service->listSensor(1,20);
        $listSensor2 = $this->_service->listSensor(2,20);
        return view('backend.home', compact(['listSensor1','listSensor2']));

    }
}