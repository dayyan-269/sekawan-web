<?php

namespace App\Models\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Account\Supervisor;
use App\Models\Manage\Order;

class Approval extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'approvals';
    protected $fillable = [
        'order_id',
        'supervisor_id',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
