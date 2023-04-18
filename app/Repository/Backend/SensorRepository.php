<?php


namespace App\Repository\Backend;

use App\Models\Sensor as Model;
use Illuminate\Support\Carbon;


class SensorRepository implements Contracts\SensorRepositoryInterface
{
    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function getListSensor($gateway_id, $paginate)
    {
        $modelSensor = $this->_model->where('gateway_id',$gateway_id);

        return $modelSensor->orderBy('created_at','DESC')
            ->paginate($paginate);
    }
    public function getAll()
    {
        return $this->_model->get();
    }

    public function syncStore($request)
    {
        return $this->_model->create([
            'temperature' => $request->temperature ?? null,
            'humidity' => $request->humidity ?? null,
            'acquy' => $request->acquy ?? null,
            'gateway_id' => $request->gateway_id ?? null,

        ]);
    }
    public function syncUpdate($request)
    {
        try {
            // $one = $this->_model->find($request->id);
            return $this->_model
                ->where('id', $request->id)
                ->update([
                    'temperature' => $request->temperature ?? null,
                    'humidity' => $request->humidity ?? null,
                    'acquy' => $request->acquy ?? null,
                    'gateway_id' => $request->gateway_id ?? null,

                ]);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getOne($id)
    {
        return $this->_model->find($id);
    }
    public function syncDelete($id)
    {
      $one = $this->_model->find($id);
      try {
        $one->delete();
        return true;
      } catch (\Exception $e) {
        return false;
      }
    }
}
