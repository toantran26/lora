<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;
use App\Services\BackendServices\NodeServices as Services;
use App\Services\BackendServices\GateWayServices as GateWay;
use App\Services\BackendServices\SensorServices as Sensor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;


class NodeController extends Controller
{
    protected $_service;
    protected $_gateway;
    protected $_sensor;

    public function __construct(Services $services, GateWay $gateway, Sensor $sensor)
    {
        $this->_service = $services;
        $this->_gateway = $gateway;
        $this->_sensor = $sensor;

    }

    public function index(Request $request) {
        
        $listNode = $this->_service->listNode($request,50);
        $listGateway = $this->_gateway->getAllGateWay();
        return view('backend.node.index', compact(['listNode','listGateway']));

    }

    public function create() {

        return view('backend.node.create');
    }
    // public function store(Request $request) {
    //     $request->validate([
    //         'code'=>'required|unique:node|max:255',
    //     ]); 
    //     $codeConver = hexdec($request->code);
    //     $addNode = $this->_service->storeNode($request);
    //     if($addNode) {
    //         $gateway = $addNode->gateway;
    //         $data ='\''.$gateway->code.'/'.$gateway->remote.'\''.','.'\'add#'.$codeConver.'\'';
            
    //         return redirect()->route('node-list')->with(['success' => 'Thêm node thành công!','dataAdd' =>$data]);
    //     }
    //     return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    // }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'code'=>'required|unique:node|max:255',
            'gateway_id' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $codeConver = hexdec($request->code);
            $addNode = $this->_service->storeNode($request);
            if($addNode) {
                $gateway = $addNode->gateway;
                $push =$gateway->code.'/'.$gateway->remote;
                $toppic = 'add#'.$codeConver;
                
                    return json_encode(['success' => 'Thêm thành công!','push'=>$push,'toppic'=>$toppic]);

                // return redirect()->route('node-list')->with(['success' => 'Thêm node thành công!','dataAdd' =>$data]);
            }
            return response()->json(['error'=> 'Đã có lỗi xảy ra!']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    public function edit($id) {
        $data = $this->_service->getOne($id);
        $listGateway = $this->_gateway->getAllGateWay();

        return view('backend.node.edit', compact('data','listGateway'));
    }

    public function update(Request $request) {
        if($this->_service->update($request)) {
            return back()->with(['success' => 'Cập nhật thành công!']);
        }
        return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    }
    public function destroy($id){
        if($this->_service->delete($id)) {
            return redirect()->route('node-list')->with(['success' => 'Xóa thành công !!']);
        }
        return back()->with(['error' => 'Đã có lỗi xảy ra!']);
    }
    public function detail($id){
        $data = $this->_service->getOne($id);
        $listSensor = $this->_sensor->listSensor($id,20);

        return view('backend.node.detail', compact('data','listSensor'));
    }
}