<?php

namespace App\Models\Manage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Account\Admin;
use App\Models\Master\Driver;
use App\Models\Master\Vehicle;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $fillable = [
        'admin_id',
        'driver_id',
        'vehicle_id',
        'status',
        'bbm',
        'tanggal_order',
        'tanggal_selesai'
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
}
