<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supervisor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supervisors';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}
