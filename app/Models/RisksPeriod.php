<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RisksLevelOfThreats;

class RisksPeriod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'probability_title',
        'consequence_title',
    ];

    public function threatOptions() {
        return $this->belongsToMany(RisksLevelOfThreats::class, 'risks_level_of_threats', 'rsk_per_id');
    }
}
