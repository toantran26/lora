<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateWay extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'gateway';
    protected $fillable = [
        'name',
        'code',
        'rec',
        'remote',
        'note',
    ];
    public function node() {
        return $this->hasMany(Node::class,'gateway_id');
    }
}
