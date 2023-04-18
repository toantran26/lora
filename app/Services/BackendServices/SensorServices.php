<?php


	namespace App\Services\BackendServices;

	use App\Repository\Backend\Contracts\SensorRepositoryInterface as Model;
    use Maatwebsite\Excel\Facades\Excel;

    use Illuminate\Http\Request;



    class SensorServices
	{
	    protected $_model;

	    public function __construct(Model $model)
        {
            $this->_model = $model;
        }

        public function listSensor($gateway_id =1, $paginate =20){
	        $listSensor = $this->_model->getListSensor($gateway_id,$paginate);
            return $listSensor;
        }
        public function getAllSensor(){
            return $this->_model->getAllSensor();
        }
        public function storeSensor($request){
            // $array = explode("#", $request->data);
            // // $q = 'nhiet:37#am:80#acquy:70';
            // // $array = explode("#", $q);
            // // temp:80#hum:78#bat:40
            // $nhiet = explode(":", $array[0]);
            // $am = explode(":", $array[1]);
            // $acquy = explode(":", $array[2]);
            // $request->temperature = $nhiet[1];
            // $request->humidity = $am[1];
            // $request->acquy = $acquy[1];

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
            $allSensor =  $this->_model->getDataChill();
            return ['allSensor'=>$allSensor,'kpi'=>$kpi];
        }
        public function updateSensor(Request $request){
            return $this->_model->syncSensorUpdate($request);
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
