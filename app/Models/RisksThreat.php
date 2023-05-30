<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisksThreat extends Model
{
    use HasFactory;

    protected $fillable = [
        'rsk_id',
        'thr_id',
    ];

    public $timestamps = false;
}
