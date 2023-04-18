<?php


	namespace App\Services\BackendServices;

	use App\Repository\Backend\Contracts\NodeRepositoryInterface as Model;
    use Maatwebsite\Excel\Facades\Excel;

    use Illuminate\Http\Request;



    class NodeServices
	{
	    protected $_model;

	    public function __construct(Model $model)
        {
            $this->_model = $model;
        }

        public function listNode(Request $request, $paginate =20){
	        $listNode = $this->_model->getListNode($request,$paginate);
            return $listNode;
        }
        public function getAllNode(){
            return $this->_model->getAllNode();
        }
        public function storeNode(Request $request){

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
            $allNode =  $this->_model->getDataChill();
            return ['allNode'=>$allNode,'kpi'=>$kpi];
        }
        public function updateNode(Request $request){
            return $this->_model->syncNodeUpdate($request);
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
