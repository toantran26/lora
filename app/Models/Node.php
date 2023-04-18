<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'node';
    protected $fillable = [
        'name',
        'code',
        'gateway_id',
        'rec',
        'remote',
    ];
    public function gateway() {
        return $this->belongsTo(GateWay::class, 'gateway_id', 'id');
    }
    public function sensor() {
        return $this->hasMany(Sensor::class);
    }

}
