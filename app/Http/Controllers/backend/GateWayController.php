<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\GateWay;
use Illuminate\Http\Request;
use App\Services\BackendServices\GateWayServices as Services;
use App\Services\BackendServices\SensorServices as Sensor;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class GateWayController extends Controller
{
    protected $_service;
    protected $_sensor;

    public function __construct(Services $services, Sensor $sensor)
    {
        $this->_service = $services;
        $this->_sensor = $sensor;

    }

    public function index(Request $request) {
        
        $listGateWay = $this->_service->listGateWay($request,50);
        return view('backend.gateway.index', compact(['listGateWay']));

    }

    public function create() {

        return view('backend.gateway.create');
    }
    public function store(Request $request) {
        $request->validate([
            'code'=>'required|unique:gateway|max:255',
        ]); 
        if($this->_service->storeGateWay($request)) {
            return redirect()->route('gateway-list', $request->status)->with(['success' => 'Thêm gate thành công!']);
        }
        return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    }
    public function edit($id) {
        $data = $this->_service->getOne($id);
        return view('backend.gateway.edit', compact('data'));
    }

    public function update(Request $request) {
        $request->validate([
            'code'=>['required','max:255',
                        Rule::unique('gateway')->ignore($request->id),
            ],
        ]);
        
        if($this->_service->update($request)) {
            return back()->with(['success' => 'Cập nhật thành công!']);
        }
        return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    }
    public function detail($id){
        $data = $this->_service->getOne($id);
        $listSensor = $this->_sensor->listSensor($id,20);

        return view('backend.gateway.detail', compact('data','listSensor'));
    }
    public function checkGateWayType(Request $request){
        $gateway_id = $request->gateway_id;
        $oneGateWay = $this->_service->getOne($gateway_id);

        $listDistance = $oneGateWay->gatewayType->distance;
        return view('backend.gateway.load-distance', compact('oneGateWay','listDistance'));
      
    }
    public function delete($id){
        if($this->_service->boxTrash($id)) {
            return redirect()->route('list-box', config('constant.box_remove'))->with(['success' => 'Bài đã được gỡ thành công !!']);
        }
        return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    }
}