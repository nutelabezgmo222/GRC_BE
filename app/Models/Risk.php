<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Threat;
use App\Models\Vulnerability;
use App\Models\RisksPeriod;
use App\Models\RisksLevelOfThreats;

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

    public $timestamps = false;

    public function responsible() {
        return $this->belongsToMany(User::class, 'risks_responsibles', 'rsk_id', 'u_id');
    }

    public function threats() {
        return $this->belongsToMany(Threat::class, 'risks_threats', 'rsk_id', 'thr_id');
    }

    public function vulnerabilities() {
        return $this->belongsToMany(Vulnerability::class, 'risks_vulnerabilities', 'rsk_id', 'vul_id');
    }

    public function risksPeriod() {
        return $this->belongsTo(RisksPeriod::class, 'rsk_per_id');
    }

    public function riskThreatLevel() {
        return $this->belongsTo(RisksLevelOfThreats::class, 'rsk_thr_lvl_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'rsk_created_by');
    }

    public function approvedBy() {
        return $this->belongsTo(User::class, 'rsk_approved_by');
    }
}
