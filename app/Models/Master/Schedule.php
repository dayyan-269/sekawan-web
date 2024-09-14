<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'schedules';
    protected $fillable = [
        'vehicle_id',
        'jam',
        'hari',
    ];

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
