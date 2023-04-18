<?php


	namespace App\Services\BackendServices;

	use App\Repository\Backend\Contracts\GateWayRepositoryInterface as Model;
    use Maatwebsite\Excel\Facades\Excel;

    use Illuminate\Http\Request;



    class GateWayServices
	{
	    protected $_model;

	    public function __construct(Model $model)
        {
            $this->_model = $model;
        }

        public function listGateWay(Request $request, $paginate =20){
	        $listGateWay = $this->_model->getListGateWay($request,$paginate);
            return $listGateWay;
        }
        public function getAllGateWay(){
            return $this->_model->getAll();
        }
        public function storeGateWay(Request $request){

            return $this->_model->syncStore($request);
        }
        public function update(Request $request){
            return $this->_model->syncUpdate($request);
        }

        public function getOne($id){
            return $this->_model->getOne($id);
        }

        public function delete($id){
            return $this->_model->syncDelete($id);
        }
        
        public function getFormUpdate($id) {
            $kpi = $this->_model->getOne($id);
            $allGateWay =  $this->_model->getDataChill();
            return ['allGateWay'=>$allGateWay,'kpi'=>$kpi];
        }
        public function updateGateWay(Request $request){
            return $this->_model->syncGateWayUpdate($request);
        }
        public function converTrimArray($array){
            while (!empty($array) && empty($array[0])) {
                array_shift($array);
            }
            while (!empty($array) && empty(end($array))) {
                array_pop($array);
            }
            return($array);
        }
    }
