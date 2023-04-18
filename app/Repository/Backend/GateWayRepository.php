<?php


namespace App\Repository\Backend;

use App\Models\GateWay as Model;
use Illuminate\Support\Carbon;


class GateWayRepository implements Contracts\GateWayRepositoryInterface
{
    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function getListGateWay($request, $paginate)
    {
        $modelGateWay = $this->_model;
        if ($request->keyword) {
            $modelGateWay = $modelGateWay->where(function ($query) use ($request) {
                return $query->where('code', 'like', '%' . $request->keyword . '%');;
            });
        }
        return $modelGateWay
            ->paginate($paginate);
    }
    public function getAll()
    {
        return $this->_model->get();
    }
    public function syncStore($request)
    {
        return $this->_model->create([
            'name' => $request->name ?? null,
            'code' => $request->code ?? null,
            'rec' => $request->rec ?? null,
            'remote' => $request->remote ?? null,
            'note' => $request->note ?? null,
        ]);
    }
    public function syncUpdate($request)
    {
        try {
            // $one = $this->_model->find($request->id);
            return $this->_model
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name ?? null,
                    'code' => $request->code ?? null,
                    'rec' => $request->rec ?? null,
                    'remote' => $request->remote ?? null,
                    'note' => $request->note ?? null,
                ]);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getOne($id)
    {
        return $this->_model->find($id);
    }
    public function saveExcel($arr)
    {
        $one = $this->_model->where('code', $arr['code'])->first();
        if (!$one) {
            $one = $this->_model->create($arr);
        }
        return $one;
    }
    public function syncIsTrash($id)
    {
        try {
            $adv = $this->_model->find($id);
            if (!$adv) return false;
            $this->_model->where('id', $adv->id)->update(['status' => config('constant.adv_remove')]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
