<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'sensor';
    protected $fillable = [
        'temperature',
        'humidity',
        'acquy',
        'gateway_id',
        'node_id',
    ];

    public function node() {
        return $this->belongsTo(Node::class, 'node_id', 'id');
    }
}
