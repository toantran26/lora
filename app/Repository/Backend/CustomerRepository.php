<?php


namespace App\Repository\Backend;

use App\Models\Customer as Model;
use Illuminate\Support\Carbon;


class CustomerRepository implements Contracts\CustomerRepositoryInterface
{
    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function getListCustomer($request,$paginate,$is_type)
    {
        $modelCustomer = $this->_model->where('is_type',$is_type);
        if ($request->keyword) {
            $modelCustomer = $modelCustomer->where(function ($query) use ($request){
               return $query->where('fullname', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }
        return $modelCustomer
            ->paginate($paginate);
    }
    public function getAll($is_type = 0)
    {
        return $this->_model->where('is_type',$is_type)->get();
    }

    public function syncStore($request){
        return $this->_model->create([
            'fullname' => $request->fullname ?? null,
            'sex' => $request->sex ?? 0,
            'avatar' => $request->path_file_name ?? null,
            'birth' =>$request->birth ?? null,
            'is_type' =>$request->is_type ?? 0,
            'phone' =>$request->phone ?? null,
            'email' =>$request->email ?? null,
            'address' =>$request->address ?? null,
            'password' =>$request->password ?? null,            
        ]);
    }
    public function saveExcel($fullname,$is_type = 0){
        $one = $this->_model->where('fullname',$fullname)->first();
        if(!$one){
            $one = $this->_model->create([
                'fullname' => $fullname ?? null,
                'is_type' =>$is_type ?? 0,          
            ]);
        }
        return $one;
    }
    public function syncUpdate($request)
    {
        try {
            $one = $this->_model->find($request->id);
            return $this->_model
            ->where('id', $request->id)
            ->update([
                'fullname' => $request->fullname ?? null,
                'sex' => $request->sex ?? 0,
                'avatar' => $request->path_file_name ?? $one->avatar,
                'is_type' =>$request->is_type ?? 0,
                'birth' =>$request->birth ?? null,
                'phone' =>$request->phone ?? null,
                'email' =>$request->email ?? null,
                'address' =>$request->address ?? null,
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getOne($id){
        return $this->_model->find($id);
    }
    public function syncIsTrash($id){
        try {
            $adv = $this->_model->find($id);
            if(!$adv) return false;
            $this->_model->where('id', $adv->id)->update(['status'=>config('constant.adv_remove')]);
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
