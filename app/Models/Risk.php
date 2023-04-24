<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $fillable = [
        'rsk_title',
        'rsk_description',
        'thr_comment',
        'rsk_thr_lvl_comment',
        'vul_comment',
        'rsk_approve_date',
        'rsk_approved_by',
        'rsk_creation_date',
        'rsk_created_by',
        'rsk_per_id',
        'rsk_thr_lvl_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'rsk_per_id',
        'rsk_thr_lvl_id',
        'rsk_created_by'
    ];
}
