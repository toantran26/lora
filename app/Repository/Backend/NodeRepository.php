<?php


namespace App\Repository\Backend;

use App\Models\Node as Model;
use Illuminate\Support\Carbon;


class NodeRepository implements Contracts\NodeRepositoryInterface
{
    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function getListNode($request, $paginate)
    {
        $modelNode = $this->_model;
        if ($request->keyword) {
            $modelNode = $modelNode->where(function ($query) use ($request) {
                return $query->where('code', 'like', '%' . $request->keyword . '%');;
            });
        }
        return $modelNode
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
            'gateway_id' => $request->gateway_id ?? null,
            'remote' => $request->remote ?? null,
        ]);
    }
    public function syncUpdate($request)
    {
        try {
            return $this->_model
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name ?? null,
                    'code' => $request->code ?? null,
                    'rec' => $request->rec ?? null,
                    'gateway_id' => $request->gateway_id ?? null,
                    'remote' => $request->remote ?? null,
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
