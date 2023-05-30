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
        'title',
        'description',
        'status',
        'thr_comment',
        'thr_lvl_comment',
        'vul_comment',
        'approve_date',
        'approved_by',
        'creation_date',
        'created_by',
        'rsk_per_id',
        'thr_lvl_id',
    ];

    protected $appends = ['objType', 'threat_ids', 'vulnerability_ids'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'rsk_per_id',
        'threats',
        'vulnerabilities',
        'created_by'
    ];

    public $timestamps = false;

    public function responsible() {
        return $this->belongsToMany(User::class, 'risks_responsibles', 'rsk_id', 'u_id');
    }

    public function threats() {
        return $this->belongsToMany(Threat::class, 'risks_threats', 'rsk_id', 'thr_id');
    }

    public function getThreatIdsAttribute() {
        return $this->threats->pluck('id');
    }

    public function vulnerabilities() {
        return $this->belongsToMany(Vulnerability::class, 'risks_vulnerabilities', 'rsk_id', 'vul_id');
    }

    public function getVulnerabilityIdsAttribute() {
        return $this->vulnerabilities->pluck('id');
    }

    public function risksPeriod() {
        return $this->belongsTo(RisksPeriod::class, 'rsk_per_id');
    }

    public function riskThreatLevel() {
        return $this->belongsTo(RisksLevelOfThreats::class, 'thr_lvl_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy() {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function getObjTypeAttribute() {
        return 'risk';
    }
}
