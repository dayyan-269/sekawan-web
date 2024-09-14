<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Manage\Order;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehicles';
    protected $fillable = [
        'no_kendaraan',
        'jenis_kendaraan',
        'kepemilikan',
        'status',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
