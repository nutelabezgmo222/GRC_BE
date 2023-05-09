<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlsResponsible extends Model
{
    use HasFactory;

    protected $fillable = [
        'cntrl_id',
        'u_id',
    ];

    public $timestamps = false;
}
